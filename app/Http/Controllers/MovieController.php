<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. N+1 Problemini engellemek için genre ilişkisini önceden yüklüyoruz (Eager Loading)
        $query = Movie::with('genre');
        // 2. Türe Göre Filtreleme
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }
        // 3. Film Adı veya Yönetmene Göre Arama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('director', 'like', "%{$search}%");
            });
        }
        // 4. Sıralama Seçenekleri
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'year_desc':
                    $query->orderBy('release_year', 'desc');
                    break;
                case 'year_asc':
                    $query->orderBy('release_year', 'asc');
                    break;
                case 'rating_desc':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'title_asc':
                    $query->orderBy('title', 'asc');
                    break;
            }
        } else {
            // Varsayılan: En son eklenenler en başta
            $query->latest();
        }
        // 5. Sayfalama (Her sayfada 8 film) + Filtre parametrelerini sayfalamada koru (withQueryString)
        $movies = $query->paginate(8)->withQueryString();
        // Filtre dropdown'u için tüm türleri çekiyoruz
        $genres = Genre::all();

        return view('movies.index', compact('movies', 'genres'));
    }

    public function create()
    {
        // Formdaki dropdown için tüm türleri çekiyoruz
        $genres = Genre::all();

        return view('movies.create', compact('genres'));
    }

    // 2. Formdan Gelen Veriyi Kaydeden Metot
    public function store(Request $request)
    {
        // A) Validasyon (Doğrulama) Kuralları
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'director' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:'.(date('Y') + 2),
            'rating' => 'required|numeric|min:0|max:10',
            'description' => 'required|string|min:10',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB görsel
        ], [
            // Özel Türkçe Hata Mesajları
            'title.required' => 'Film başlığı zorunludur.',
            'genre_id.required' => 'Lütfen bir film türü seçin.',
            'release_year.min' => 'Geçerli bir çıkış yılı giriniz.',
            'rating.max' => 'Puan en fazla 10 olabilir.',
            'poster_image.image' => 'Yüklenen dosya geçerli bir resim olmalıdır.',
            'poster_image.max' => 'Afiş boyutu en fazla 2MB olabilir.',
        ]);
        // B) Afiş Resmi Yüklenmişse Kaydet
        if ($request->hasFile('poster_image')) {
            // 'storage/app/public/posters' altına yükler ve yolunu döner
            $path = $request->file('poster_image')->store('posters', 'public');
            $validated['poster_image'] = $path;
        }
        // C) Veritabanına Kaydet
        Movie::create($validated);

        // D) Başarı Mesajıyla Listeye Yönlendir
        return redirect()->route('movies.index')->with('success', 'Film başarıyla eklendi! 🎬');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        // İlişkileri yüklüyoruz
        $movie->load(['genre', 'comments' => function ($query) {
            $query->latest();
        }]);

        // View'a 'movie' değişkenini gönderiyoruz
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 4. Film Düzenleme Formunu Gösteren Metot
    public function edit(Movie $movie)
    {
        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    // 5. Güncellenen Verileri Kaydeden Metot
    public function update(Request $request, Movie $movie)
    {
        // A) Validasyon
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'director' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:'.(date('Y') + 2),
            'rating' => 'required|numeric|min:0|max:10',
            'description' => 'required|string|min:10',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'title.required' => 'Film başlığı zorunludur.',
            'genre_id.required' => 'Lütfen bir film türü seçin.',
        ]);

        // B) Yeni bir afiş resmi yüklendiyse:
        if ($request->hasFile('poster_image')) {
            // Varsa eski yerel resmi storage'dan sil (sunucuda çöp dosya birikmesin)
            if ($movie->poster_image && Storage::disk('public')->exists($movie->poster_image)) {
                Storage::disk('public')->delete($movie->poster_image);
            }

            // Yeni resmi kaydet
            $validated['poster_image'] = $request->file('poster_image')->store('posters', 'public');
        }

        // C) Modeli Güncelle
        $movie->update($validated);

        // D) Detay Sayfasına Yönlendir
        return redirect()->route('movies.show', $movie)->with('success', 'Film bilgileri başarıyla güncellendi! ✨');
    }

    // 6. Filmi Silen Metot
    public function destroy(Movie $movie)
    {
        // Varsa filmin afiş resmini storage'dan sil
        if ($movie->poster_image && Storage::disk('public')->exists($movie->poster_image)) {
            Storage::disk('public')->delete($movie->poster_image);
        }

        // Filmi veritabanından sil (ilişkili yorumlar cascade sayesinde otomatik silinir)
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Film ve ilişkili tüm yorumlar başarıyla silindi. 🗑️');
    }
}

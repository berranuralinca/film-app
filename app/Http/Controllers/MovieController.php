<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

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
            $query->where(function($q) use ($search) {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}

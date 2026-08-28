@extends('layouts.app')

@section('content')
<div class="row g-4">
    <!-- Sol Kolon: Film Afişi ve Butonlar -->
    <div class="col-lg-4">
        <div class="card overflow-hidden shadow-lg mb-4">
            <div style="height: 450px; background-color: #000;">
                @if ($movie->poster_image)
                    <img src="{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}" 
                         class="w-100 h-100 object-fit-cover" 
                         alt="{{ $movie->title }}">
                @else
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                        <i class="bi bi-camera-reels display-1"></i>
                    </div>
                @endif
            </div>

            <!-- İşlem Butonları -->
            <div class="card-body d-flex gap-2">
                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-pencil-square me-1"></i>Düzenle
                </a>

                <!-- Silme Formu -->
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" 
                      onsubmit="return confirm('Bu filmi silmek istediğinize emin misiniz?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash3"></i> Sil
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-arrow-left me-1"></i>Film Listesine Dön
        </a>
    </div>

    <!-- Sağ Kolon: Film Bilgileri ve Yorumlar -->
    <div class="col-lg-8">
        <!-- Film Detay Kartı -->
        <div class="card shadow-lg p-4 mb-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                <div>
                    <h1 class="display-6 fw-bold text-warning mb-1">{{ $movie->title }}</h1>
                    <p class="text-secondary mb-0">
                        <i class="bi bi-calendar3 me-1"></i>{{ $movie->release_year }} &bull; 
                        <i class="bi bi-person me-1"></i>{{ $movie->director }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge badge-genre fs-6 px-3 py-2 align-self-center">{{ $movie->genre->name }}</span>
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2 align-self-center">
                        <i class="bi bi-star-fill me-1"></i>{{ $movie->rating }} / 10
                    </span>
                </div>
            </div>

            <hr class="border-secondary">

            <h5 class="fw-bold text-light mb-2">Film Özeti</h5>
            <p class="text-light opacity-75 fs-6 lh-base mb-0">
                {{ $movie->description }}
            </p>
        </div>

        <!-- Yorumlar Bölümü -->
        <div class="card shadow-lg p-4">
            <h4 class="fw-bold text-warning mb-3">
                <i class="bi bi-chat-left-text me-2"></i>Kullanıcı Yorumları ({{ $movie->comments->count() }})
            </h4>

            <!-- Yorum Ekleme Formu -->
            <div class="bg-dark bg-opacity-50 p-3 rounded border border-secondary mb-4">
                <h6 class="fw-bold text-light mb-3"><i class="bi bi-pencil-fill me-1"></i>Yorum Yaz & Puanla</h6>
                
                <form action="{{ route('comments.store', $movie) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-7">
                            <input type="text" name="author_name" class="form-control form-control-sm @error('author_name') is-invalid @enderror" 
                                   placeholder="Adınız Soyadınız" value="{{ old('author_name') }}">
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <select name="rating" class="form-select form-select-sm @error('rating') is-invalid @enderror">
                                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Yıldız - Harika)</option>
                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Yıldız - Çok İyi)</option>
                                <option value="3" {{ old('rating', 3) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Yıldız - Ortalama)</option>
                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 Yıldız - Zayıf)</option>
                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 Yıldız - Kötü)</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <textarea name="content" rows="3" class="form-control form-control-sm @error('content') is-invalid @enderror" 
                                      placeholder="Film hakkındaki düşünceleriniz...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-warning btn-sm fw-semibold">
                                <i class="bi bi-send-fill me-1"></i>Yorumu Gönder
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Yorumlar Listesi -->
            <div class="d-flex flex-column gap-3">
                @forelse ($movie->comments as $comment)
                    <div class="p-3 rounded bg-dark border border-secondary border-opacity-50 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong class="text-light"><i class="bi bi-person-circle me-1 text-secondary"></i>{{ $comment->author_name }}</strong>
                                <small class="text-secondary ms-2">&bull; {{ $comment->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <span class="text-warning small">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $comment->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </span>

                                <!-- Yorum Silme -->
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" 
                                      onsubmit="return confirm('Bu yorumu silmek istiyor musunuz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Yorumu Sil">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="text-light opacity-75 mb-0 small">{{ $comment->content }}</p>
                    </div>
                @empty
                    <div class="text-center text-secondary py-4">
                        <i class="bi bi-chat-square-dots display-6 d-block mb-2"></i>
                        <p class="mb-0">Henüz yorum yapılmamış. İlk yorumu sen yap!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
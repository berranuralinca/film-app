@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <!-- Arama ve Filtreleme Formu -->
    <div class="col-12">
        <div class="card p-3 shadow-sm">
            <form action="{{ route('movies.index') }}" method="GET" class="row g-3 align-items-center">
                <!-- Arama Kutusu -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-secondary"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Film adı veya yönetmen ara..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Tür Filtresi -->
                <div class="col-md-3">
                    <select name="genre" class="form-select">
                        <option value="">Tüm Türler</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sıralama -->
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="">Sıralama Seçin</option>
                        <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Yıla Göre (Yeniden Eskiye)</option>
                        <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>Yıla Göre (Eskiden Yeniye)</option>
                        <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Puana Göre (En Yüksek)</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>İsme Göre (A-Z)</option>
                    </select>
                </div>

                <!-- Butonlar -->
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i>Filtrele</button>
                    @if(request()->hasAny(['search', 'genre', 'sort']))
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary" title="Filtreleri Temizle"><i class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Film Kartları Listesi -->
<div class="row g-4">
    @forelse ($movies as $movie)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 overflow-hidden">
                <!-- Film Afişi -->
                <div class="position-relative" style="height: 300px; background-color: #000;">
                    @if ($movie->poster_image)
                        <img src="{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}" 
                             class="card-img-top w-100 h-100 object-fit-cover" 
                             alt="{{ $movie->title }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                            <i class="bi bi-camera-reels display-4"></i>
                        </div>
                    @endif

                    <!-- Puan Rozeti -->
                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark fs-6 shadow">
                        <i class="bi bi-star-fill text-dark me-1"></i>{{ $movie->rating }}
                    </span>

                    <!-- Tür Rozeti -->
                    <span class="position-absolute bottom-0 start-0 m-2 badge badge-genre shadow">
                        {{ $movie->genre->name }}
                    </span>
                </div>

                <!-- Kart Gövdesi -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-truncate" title="{{ $movie->title }}">{{ $movie->title }}</h5>
                    <p class="card-text text-secondary small mb-2">
                        <i class="bi bi-person me-1"></i>{{ $movie->director }} &bull; <i class="bi bi-calendar3 me-1"></i>{{ $movie->release_year }}
                    </p>
                    <p class="card-text text-light opacity-75 small flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $movie->description }}
                    </p>

                    <!-- Detay Butonu -->
                    <div class="mt-3">
                        <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-warning btn-sm w-100">
                            <i class="bi bi-eye me-1"></i>Detayları İncele
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="text-secondary mb-3">
                <i class="bi bi-film display-1"></i>
            </div>
            <h4 class="text-secondary">Aradığınız kriterlere uygun film bulunamadı.</h4>
            <a href="{{ route('movies.index') }}" class="btn btn-primary mt-2">Tüm Filmleri Göster</a>
        </div>
    @endforelse
</div>

<!-- Sayfalama (Pagination) Linkleri -->
<div class="d-flex justify-content-center mt-5">
    {{ $movies->links('pagination::bootstrap-5') }}
</div>
@endsection
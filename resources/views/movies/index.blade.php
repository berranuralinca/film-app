@extends('layouts.app')

@section('content')
<!-- Hero / Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="glass-panel p-4 p-md-5 mb-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(36, 16, 44, 0.8) 0%, rgba(16, 8, 22, 0.85) 100%); border-color: rgba(244, 63, 94, 0.2);">
            <div class="position-absolute end-0 top-0 bottom-0 d-none d-lg-flex align-items-center pe-5 opacity-10 pointer-events-none text-danger">
                <i class="bi bi-film" style="font-size: 14rem;"></i>
            </div>
            
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-danger bg-opacity-10 border border-danger border-opacity-30 small fw-semibold mb-3" style="color: #fb7185;">
                        <i class="bi bi-stars"></i> Özel Sinema Koleksiyonu
                    </div>
                    <h1 class="display-5 fw-extrabold text-white mb-2">
                        Sinema Dünyasını <span style="background: linear-gradient(135deg, #fda4af, #f43f5e, #ec4899, #e11d48); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Keşfet</span>
                    </h1>
                    <p class="text-light opacity-75 fs-5 mb-4" style="max-width: 600px;">
                        En seçkin filmleri keşfedin, puanları inceleyin, topluluk yorumlarına katılın ve sinema arşivinizi genişletin.
                    </p>

                    <!-- Hızlı Kategori Etiketleri (Quick Genre Pills) -->
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <span class="text-secondary small fw-bold me-1"><i class="bi bi-tags me-1" style="color: #fb7185;"></i>Hızlı Filtre:</span>
                        <a href="{{ route('movies.index') }}" 
                           class="badge text-decoration-none px-3 py-2 rounded-pill {{ !request('genre') ? 'btn-glow-rose text-white shadow' : 'btn-glass text-light' }}">
                           Tümü ({{ $movies->total() }})
                        </a>
                        @foreach ($genres as $genre)
                            <a href="{{ route('movies.index', ['genre' => $genre->id]) }}" 
                               class="badge text-decoration-none px-3 py-2 rounded-pill {{ request('genre') == $genre->id ? 'btn-glow-rose text-white shadow' : 'btn-glass text-light' }}">
                               {{ $genre->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                    <div class="d-inline-flex flex-column p-3 rounded-4 glass-panel border-danger border-opacity-25 text-start" style="box-shadow: 0 0 25px rgba(244, 63, 94, 0.15);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-danger bg-opacity-20 text-danger p-3 rounded-circle border border-danger border-opacity-40">
                                <i class="bi bi-play-circle-fill fs-3" style="color: #fb7185;"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold text-white">{{ $movies->total() }} Film</div>
                                <small class="text-secondary">Arşivde Yayında</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Arama ve Filtreleme Paneli -->
<div class="row mb-4">
    <div class="col-12">
        <div class="glass-panel p-3 shadow-lg" style="border-color: rgba(244, 63, 94, 0.15);">
            <form action="{{ route('movies.index') }}" method="GET" class="row g-3 align-items-center">
                <!-- Arama Kutusu -->
                <div class="col-lg-4 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text border-end-0">
                            <i class="bi bi-search" style="color: #fb7185;"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Film adı veya yönetmen ara..." 
                               value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Tür Filtresi -->
                <div class="col-lg-3 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text border-end-0">
                            <i class="bi bi-grid-fill" style="color: #ec4899;"></i>
                        </span>
                        <select name="genre" class="form-select border-start-0">
                            <option value="">Tüm Türler</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Sıralama -->
                <div class="col-lg-3 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text border-end-0">
                            <i class="bi bi-sort-down" style="color: #fda4af;"></i>
                        </span>
                        <select name="sort" class="form-select border-start-0">
                            <option value="">Sıralama Seçin</option>
                            <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>📅 Yıla Göre (Yeniden Eskiye)</option>
                            <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>📅 Yıla Göre (Eskiden Yeniye)</option>
                            <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>⭐ Puana Göre (En Yüksek)</option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>🔤 İsme Göre (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Butonlar -->
                <div class="col-lg-2 col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-glow-rose w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-funnel-fill"></i>
                        <span>Filtrele</span>
                    </button>
                    @if(request()->hasAny(['search', 'genre', 'sort']))
                        <a href="{{ route('movies.index') }}" class="btn btn-glass px-3 d-flex align-items-center justify-content-center" title="Filtreleri Temizle">
                            <i class="bi bi-x-lg"></i>
                        </a>
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
            <div class="glass-card h-100 d-flex flex-column">
                <!-- Film Afişi Alanı -->
                <div class="position-relative overflow-hidden" style="height: 340px; background-color: #060911;">
                    @if ($movie->poster_image)
                        <img src="{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}" 
                             class="w-100 h-100 object-fit-cover transition-all" 
                             style="transition: transform 0.5s ease;"
                             alt="{{ $movie->title }}"
                             onmouseover="this.style.transform='scale(1.08)'"
                             onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-secondary bg-dark bg-opacity-50">
                            <i class="bi bi-camera-reels display-4 mb-2 text-muted"></i>
                            <span class="small text-muted">Afiş Yok</span>
                        </div>
                    @endif

                    <!-- Karartma Gradyanı (Metin Okunabilirliği İçin) -->
                    <div class="position-absolute bottom-0 start-0 end-0" 
                         style="height: 50%; background: linear-gradient(to top, rgba(10, 6, 14, 0.95) 0%, rgba(10, 6, 14, 0) 100%); pointer-events: none;"></div>

                    <!-- Puan Rozeti (Sağ Üst) -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="rating-badge d-flex align-items-center gap-1 shadow-sm">
                            <i class="bi bi-star-fill" style="color: #fb7185;"></i>
                            <span>{{ number_format($movie->rating, 1) }}</span>
                        </span>
                    </div>

                    <!-- Tür Rozeti (Sol Alt) -->
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="badge-genre-tag genre-{{ $movie->genre->slug ?? 'default' }}">
                            <i class="bi bi-tag-fill me-1"></i>{{ $movie->genre->name }}
                        </span>
                    </div>
                </div>

                <!-- Kart Gövdesi -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <h5 class="fw-bold text-white mb-1 text-truncate" title="{{ $movie->title }}">
                        <a href="{{ route('movies.show', $movie) }}" class="text-white text-decoration-none hover-rose" style="transition: color 0.2s;">
                            {{ $movie->title }}
                        </a>
                    </h5>

                    <div class="d-flex align-items-center text-secondary small gap-3 mb-2">
                        <span><i class="bi bi-person me-1" style="color: #fb7185;"></i>{{ $movie->director }}</span>
                        <span>&bull;</span>
                        <span><i class="bi bi-calendar-event me-1" style="color: #ec4899;"></i>{{ $movie->release_year }}</span>
                    </div>

                    <p class="text-light opacity-75 small flex-grow-1 mb-3" 
                       style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5;">
                        {{ $movie->description }}
                    </p>

                    <!-- Detay Butonu -->
                    <div class="mt-auto pt-2 border-top border-white border-opacity-10">
                        <a href="{{ route('movies.show', $movie) }}" class="btn btn-glass w-100 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold" style="color: #fda4af;">
                            <span>Detayları İncele</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5">
            <div class="glass-panel text-center py-5 px-4 my-3" style="max-width: 600px; margin: auto;">
                <div class="bg-danger bg-opacity-10 text-danger d-inline-flex p-4 rounded-circle mb-3 border border-danger border-opacity-25">
                    <i class="bi bi-film display-4"></i>
                </div>
                <h3 class="fw-bold text-white mb-2">Film Bulunamadı</h3>
                <p class="text-secondary mb-4">Aradığınız kriterlere uygun herhangi bir film listelenmedi.</p>
                <a href="{{ route('movies.index') }}" class="btn btn-glow-rose px-4 py-2">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Filtreleri Sıfırla
                </a>
            </div>
        </div>
    @endforelse
</div>

<style>
    .hover-rose:hover {
        color: #fb7185 !important;
    }
</style>

<!-- Sayfalama (Pagination) Linkleri -->
<div class="d-flex justify-content-center mt-5">
    {{ $movies->links('pagination::bootstrap-5') }}
</div>
@endsection
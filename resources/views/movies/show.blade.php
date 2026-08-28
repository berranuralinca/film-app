@extends('layouts.app')

@section('content')
<!-- Dinamik Filme Göre Ambient Arka Plan Parlaması -->
<div id="movieBackdropAmbient" class="position-absolute top-0 start-0 w-100 overflow-hidden pointer-events-none" style="height: 650px; z-index: 1;">
    @if ($movie->poster_image)
        <div class="position-absolute w-100 h-100" 
             style="background-image: url('{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}'); 
                    background-size: cover; 
                    background-position: center 20%; 
                    filter: blur(95px) saturate(240%) brightness(0.7); 
                    opacity: 0.45; 
                    transform: scale(1.3); 
                    transition: opacity 0.8s ease;"></div>
    @endif
    <div id="dynamicColorOrb" class="position-absolute rounded-circle" 
         style="width: 600px; height: 600px; top: -100px; right: 10%; filter: blur(140px); opacity: 0.4; background: radial-gradient(circle, var(--movie-primary, #f43f5e) 0%, transparent 70%); transition: all 1s ease;"></div>
</div>

<div class="row g-4 position-relative" style="z-index: 3;" id="movieDetailContainer">
    <!-- Sol Kolon: Film Afişi ve İşlem Butonları -->
    <div class="col-lg-4">
        <div class="glass-card shadow-2xl mb-4 movie-accent-glow" style="border-radius: 20px;">
            <!-- Afiş Alanı -->
            <div class="position-relative overflow-hidden" style="height: 480px; background: #050811;">
                @if ($movie->poster_image)
                    <img id="moviePosterImg" 
                         src="{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}" 
                         crossorigin="anonymous"
                         class="w-100 h-100 object-fit-cover" 
                         alt="{{ $movie->title }}">
                @else
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-secondary bg-dark bg-opacity-60">
                        <i class="bi bi-camera-reels display-1 mb-2 text-muted"></i>
                        <span class="text-muted">Afiş Yüklenmemiş</span>
                    </div>
                @endif

                <!-- Afiş Üzeri Cam Parlama Efekti -->
                <div class="position-absolute top-0 start-0 end-0 bottom-0 pointer-events-none"
                     style="background: linear-gradient(180deg, rgba(251, 113, 133, 0.1) 0%, rgba(0,0,0,0) 40%, rgba(10,6,14,0.9) 100%);"></div>

                <!-- Puan Rozeti (Afiş Üstü) -->
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="rating-badge fs-6 px-3 py-2 d-flex align-items-center gap-1 shadow-lg">
                        <i class="bi bi-star-fill" style="color: #fb7185;"></i>
                        <span class="fw-bold text-white">{{ number_format($movie->rating, 1) }}</span> <small class="text-secondary opacity-75">/ 10</small>
                    </span>
                </div>
            </div>

            <!-- İşlem Butonları (Düzenle & Sil) -->
            <div class="p-3 d-flex gap-2 bg-dark bg-opacity-40 border-top border-white border-opacity-10">
                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-glow-primary flex-grow-1 d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="bi bi-pencil-square"></i>
                    <span>Filmi Düzenle</span>
                </a>

                <!-- Silme Formu -->
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" 
                      onsubmit="return confirm('Bu filmi ve tüm yorumlarını silmek istediğinize emin misiniz?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-glass-danger px-3 py-2 d-flex align-items-center gap-1" title="Filmi Sil">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('movies.index') }}" class="btn btn-glass w-100 py-2 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Tüm Filmlere Dön</span>
        </a>
    </div>

    <!-- Sağ Kolon: Film Detayları ve Yorumlar -->
    <div class="col-lg-8">
        <!-- Film Detay Kartı -->
        <div class="glass-panel p-4 p-md-5 mb-4 movie-accent-glow position-relative overflow-hidden" style="border-radius: 20px;">
            <!-- Dinamik Vurgu Işığı Çizgisi -->
            <div class="position-absolute top-0 start-0 end-0" style="height: 3px; background: linear-gradient(90deg, var(--movie-primary, #f43f5e), var(--movie-glow, #ec4899), transparent);"></div>

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <h1 class="display-5 fw-extrabold mb-2 movie-title-glow" style="color: #ffffff;">
                        {{ $movie->title }}
                    </h1>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3 text-secondary">
                        <span class="d-flex align-items-center gap-1">
                            <i class="bi bi-calendar3" style="color: #fb7185;"></i>
                            <strong class="text-light">{{ $movie->release_year }}</strong>
                        </span>
                        <span>&bull;</span>
                        <span class="d-flex align-items-center gap-1">
                            <i class="bi bi-person-badge" style="color: #ec4899;"></i>
                            <span class="text-light">{{ $movie->director }}</span>
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge-genre-tag genre-{{ $movie->genre->slug ?? 'default' }} fs-6 px-3 py-2">
                        <i class="bi bi-tag-fill me-1"></i>{{ $movie->genre->name }}
                    </span>
                    
                    <span class="rating-badge fs-6 px-3 py-2 d-flex align-items-center gap-1">
                        <i class="bi bi-star-fill" style="color: #fb7185;"></i>
                        <span>{{ number_format($movie->rating, 1) }} Puan</span>
                    </span>
                </div>
            </div>

            <div class="p-3 rounded-4 glass-panel border-white border-opacity-5 mb-4 bg-dark bg-opacity-30">
                <h6 class="fw-bold text-uppercase tracking-wider mb-2 d-flex align-items-center gap-2" style="color: var(--movie-primary, #fb7185); font-size: 0.85rem; letter-spacing: 0.08em;">
                    <i class="bi bi-file-text-fill"></i> Film Özeti & Konusu
                </h6>
                <p class="text-light opacity-90 fs-6 lh-lg mb-0" style="font-weight: 400;">
                    {{ $movie->description }}
                </p>
            </div>

            <!-- Hızlı Aksiyon / Bilgi Çubuğu -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top border-white border-opacity-10 text-secondary small">
                <div class="d-flex align-items-center gap-2">
                    <span class="d-inline-block p-1 rounded-circle" style="background-color: var(--movie-primary, #f43f5e);"></span>
                    <span>Dinamik Atmosfer: <strong class="text-light" id="themeStatusText">{{ $movie->genre->name }} Teması</strong></span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-chat-heart text-danger"></i>
                    <span><strong>{{ $movie->comments->count() }}</strong> Topluluk Yorumu</span>
                </div>
            </div>
        </div>

        <!-- Yorumlar Bölümü -->
        <div class="glass-panel p-4 p-md-5 shadow-2xl" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-white mb-0 d-flex align-items-center gap-2">
                    <span class="p-2 rounded-3 bg-danger bg-opacity-10 text-danger border border-danger border-opacity-30">
                        <i class="bi bi-chat-left-quote-fill" style="color: #fb7185;"></i>
                    </span>
                    <span>İzleyici Yorumları</span>
                    <span class="badge bg-danger bg-opacity-30 text-light rounded-pill fs-6 px-3 py-1">{{ $movie->comments->count() }}</span>
                </h4>
            </div>

            <!-- İnteraktif Yorum & Puan Ekleme Formu -->
            <div class="glass-panel p-4 mb-4 border-white border-opacity-10 position-relative overflow-hidden" style="background: rgba(18, 10, 24, 0.75);">
                <h5 class="fw-bold text-light mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-fill" style="color: #fb7185;"></i>
                    <span>Filmi Değerlendir & Yorum Yaz</span>
                </h5>
                
                <form action="{{ route('comments.store', $movie) }}" method="POST" id="commentForm">
                    @csrf
                    <div class="row g-3">
                        <!-- İsim Soyisim -->
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-semibold">Adınız Soyadınız <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-person text-secondary"></i></span>
                                <input type="text" name="author_name" class="form-control border-start-0 @error('author_name') is-invalid @enderror" 
                                       placeholder="Örn: Ahmet Yılmaz" value="{{ old('author_name') }}" required>
                            </div>
                            @error('author_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- İnteraktif Yıldız Puanı Seçici -->
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-semibold">Puanınız <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-2 p-2 rounded-3 glass-panel border-white border-opacity-10" style="height: 46px;">
                                <div class="star-rating-selector d-flex gap-1" id="starContainer">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-item cursor-pointer fs-5 text-secondary" 
                                           data-val="{{ $i }}" 
                                           style="cursor: pointer; transition: all 0.2s ease;"></i>
                                    @endfor
                                </div>
                                <span class="small fw-semibold ms-2" id="ratingText" style="color: #fb7185;">3 Yıldız (Ortalama)</span>
                                <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 3) }}">
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Yorum Metni -->
                        <div class="col-12">
                            <label class="form-label text-secondary small fw-semibold">Yorumunuz <span class="text-danger">*</span></label>
                            <textarea name="content" rows="3" class="form-control @error('content') is-invalid @enderror" 
                                      placeholder="Film hakkındaki samimi düşüncelerinizi, oyunculukları veya sahneleri paylaşın..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end pt-2">
                            <button type="submit" class="btn btn-glow-rose px-4 py-2 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-send-fill"></i>
                                <span>Yorumu Paylaş</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Yorumlar Listesi -->
            <div class="d-flex flex-column gap-3">
                @forelse ($movie->comments as $comment)
                    <div class="p-3 p-md-4 rounded-4 glass-panel border-white border-opacity-5 position-relative" style="background: rgba(18, 10, 24, 0.6);">
                        <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Avatar Baş Harfleri (Pink/Red Gradient) -->
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white shadow-sm"
                                     style="width: 42px; height: 42px; background: linear-gradient(135deg, var(--movie-primary, #f43f5e) 0%, #ec4899 100%); font-size: 1rem; border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 0 15px rgba(244, 63, 94, 0.3);">
                                    {{ strtoupper(mb_substr($comment->author_name, 0, 1)) }}
                                </div>

                                <div>
                                    <strong class="text-white fs-6 d-block">{{ $comment->author_name }}</strong>
                                    <small class="text-secondary d-flex align-items-center gap-1">
                                        <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <!-- Yıldız Puanı -->
                                <div class="d-flex align-items-center gap-1 px-2 py-1 rounded-pill bg-dark bg-opacity-60 border border-danger border-opacity-30 small" style="color: #fb7185;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $comment->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                    <span class="ms-1 fw-bold text-light">{{ $comment->rating }}/5</span>
                                </div>

                                <!-- Yorum Silme Butonu -->
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" 
                                      onsubmit="return confirm('Bu yorumu silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-secondary hover-danger p-1" title="Yorumu Sil" style="transition: color 0.2s;">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p class="text-light opacity-90 mb-0 ps-md-5 pt-1" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ $comment->content }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-5 glass-panel border-dashed border-white border-opacity-10">
                        <div class="text-secondary mb-3">
                            <i class="bi bi-chat-square-quote display-4 text-muted"></i>
                        </div>
                        <h5 class="text-white">Henüz Yorum Yapılmamış</h5>
                        <p class="text-secondary small mb-3">Bu filme ilk değerlendirmeyi ve yorumu sen bırak!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    /* Dinamik Vurgu Parlamaları */
    .movie-accent-glow {
        border-color: var(--movie-border, rgba(244, 63, 94, 0.25)) !important;
        box-shadow: 0 15px 40px -10px var(--movie-glow, rgba(244, 63, 94, 0.35)) !important;
        transition: border-color 0.6s ease, box-shadow 0.6s ease;
    }

    .movie-title-glow {
        text-shadow: 0 0 35px var(--movie-glow, rgba(244, 63, 94, 0.5));
        transition: text-shadow 0.6s ease;
    }

    .hover-danger:hover {
        color: #ef4444 !important;
    }
</style>

<!-- Dinamik Renk Algılama & İnteraktif Yıldız Scripti (Pink & Red Base) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Dinamik Filme Göre Renk Çıkarma Motoru
    const genreSlug = "{{ $movie->genre->slug ?? 'default' }}";
    
    // Pembe & Kırmızı Ağırlıklı Tür Neon Renkleri
    const genrePalettes = {
        'bilim-kurgu': { primary: '#ec4899', glow: 'rgba(236, 72, 153, 0.45)', name: 'Cyberpunk Pembe' },
        'aksiyon': { primary: '#e11d48', glow: 'rgba(225, 29, 72, 0.45)', name: 'Yakut Kırmızısı' },
        'dram': { primary: '#f43f5e', glow: 'rgba(244, 63, 94, 0.45)', name: 'Gül Kurusu & Bordo' },
        'komedi': { primary: '#fb7185', glow: 'rgba(251, 113, 133, 0.45)', name: 'Şeker Pembesi' },
        'korku': { primary: '#be123c', glow: 'rgba(190, 18, 60, 0.45)', name: 'Kan Kırmızısı' },
        'animasyon': { primary: '#d946ef', glow: 'rgba(217, 70, 239, 0.45)', name: 'Fuşya & Magenta' },
        'macera': { primary: '#fda4af', glow: 'rgba(253, 164, 175, 0.45)', name: 'Mercan & Pembe' },
        'default': { primary: '#f43f5e', glow: 'rgba(244, 63, 94, 0.45)', name: 'Neon Rose' }
    };

    function applyMovieTheme(primaryColor, glowColor, themeName) {
        document.documentElement.style.setProperty('--movie-primary', primaryColor);
        document.documentElement.style.setProperty('--movie-glow', glowColor);
        document.documentElement.style.setProperty('--movie-border', primaryColor + '50');
        
        const orb = document.getElementById('dynamicColorOrb');
        if (orb) {
            orb.style.background = `radial-gradient(circle, ${primaryColor} 0%, transparent 70%)`;
        }

        const statusEl = document.getElementById('themeStatusText');
        if (statusEl && themeName) {
            statusEl.textContent = themeName;
        }
    }

    // Başlangıçta türe göre ayarla
    const basePalette = genrePalettes[genreSlug] || genrePalettes['default'];
    applyMovieTheme(basePalette.primary, basePalette.glow, basePalette.name + ' (' + "{{ $movie->genre->name }}" + ')');

    // Görsel yüklendiğinde afişten canlı renk çıkarma
    const posterImg = document.getElementById('moviePosterImg');
    if (posterImg) {
        const analyzePoster = function() {
            try {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 50;
                canvas.height = 50;
                ctx.drawImage(posterImg, 0, 0, 50, 50);
                
                const imgData = ctx.getImageData(0, 0, 50, 50).data;
                let r = 0, g = 0, b = 0, count = 0;
                let maxSat = 0, bestR = 244, bestG = 63, bestB = 94;

                for (let i = 0; i < imgData.length; i += 16) {
                    const cr = imgData[i];
                    const cg = imgData[i+1];
                    const cb = imgData[i+2];
                    
                    const max = Math.max(cr, cg, cb);
                    const min = Math.min(cr, cg, cb);
                    const sat = max === 0 ? 0 : (max - min) / max;
                    const brightness = (cr + cg + cb) / 3;

                    if (sat > 0.25 && brightness > 40 && brightness < 230) {
                        if (sat > maxSat) {
                            maxSat = sat;
                            bestR = cr;
                            bestG = cg;
                            bestB = cb;
                        }
                        r += cr; g += cg; b += cb;
                        count++;
                    }
                }

                if (maxSat > 0.25) {
                    const finalColor = `rgb(${bestR}, ${bestG}, ${bestB})`;
                    const glowColor = `rgba(${bestR}, ${bestG}, ${bestB}, 0.5)`;
                    applyMovieTheme(finalColor, glowColor, 'Afişten Dinamik Renk');
                }
            } catch (e) {
                console.log('Afiş dinamik renk modu (Genre fallback):', basePalette.name);
            }
        };

        if (posterImg.complete) {
            analyzePoster();
        } else {
            posterImg.addEventListener('load', analyzePoster);
        }
    }

    // 2. İnteraktif Yıldız Puanlama Sistemi (Pink & Red Glow)
    const starContainer = document.getElementById('starContainer');
    const ratingInput = document.getElementById('ratingInput');
    const ratingText = document.getElementById('ratingText');
    const stars = starContainer ? starContainer.querySelectorAll('.star-item') : [];

    const ratingDescriptions = {
        1: '⭐ 1 Yıldız (Kötü)',
        2: '⭐⭐ 2 Yıldız (Zayıf)',
        3: '⭐⭐⭐ 3 Yıldız (Ortalama)',
        4: '⭐⭐⭐⭐ 4 Yıldız (Çok İyi)',
        5: '⭐⭐⭐⭐⭐ 5 Yıldız (Harika!)'
    };

    function updateStars(val) {
        stars.forEach(star => {
            const sVal = parseInt(star.getAttribute('data-val'));
            if (sVal <= val) {
                star.classList.remove('text-secondary');
                star.style.color = '#fb7185';
                star.style.transform = 'scale(1.15)';
                star.style.filter = 'drop-shadow(0 0 8px rgba(244, 63, 94, 0.75))';
            } else {
                star.style.color = '#64748b';
                star.classList.add('text-secondary');
                star.style.transform = 'scale(1)';
                star.style.filter = 'none';
            }
        });
        if (ratingText) {
            ratingText.textContent = ratingDescriptions[val] || (val + ' Yıldız');
        }
    }

    if (starContainer && ratingInput) {
        updateStars(parseInt(ratingInput.value) || 3);

        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const hoverVal = parseInt(this.getAttribute('data-val'));
                updateStars(hoverVal);
            });

            star.addEventListener('click', function() {
                const chosenVal = parseInt(this.getAttribute('data-val'));
                ratingInput.value = chosenVal;
                updateStars(chosenVal);
            });
        });

        starContainer.addEventListener('mouseleave', function() {
            updateStars(parseInt(ratingInput.value) || 3);
        });
    }
});
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="glass-panel p-4 p-md-5 shadow-2xl position-relative overflow-hidden" style="border-radius: 24px; border-color: rgba(244, 63, 94, 0.2);">
            <!-- Üst Başlık Işıltısı -->
            <div class="position-absolute top-0 start-0 end-0" style="height: 3px; background: linear-gradient(90deg, #f43f5e, #ec4899, #e11d48);"></div>

            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-white border-opacity-10 pb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-circle bg-danger bg-opacity-10 text-danger border border-danger border-opacity-30">
                        <i class="bi bi-film fs-3" style="color: #fb7185;"></i>
                    </div>
                    <div>
                        <h2 class="fw-extrabold text-white mb-0">Yeni Film Ekle</h2>
                        <small class="text-secondary">Arşive yeni bir sinema eseri kaydedin</small>
                    </div>
                </div>
                <a href="{{ route('movies.index') }}" class="btn btn-glass btn-sm px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Listeye Dön</span>
                </a>
            </div>

            <!-- Form: Resim yüklemek için enctype="multipart/form-data" -->
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" id="createMovieForm">
                @csrf

                <div class="row g-4">
                    <!-- Film Başlığı -->
                    <div class="col-md-8">
                        <label for="title" class="form-label text-light small fw-bold">
                            <i class="bi bi-type-h1 me-1" style="color: #fb7185;"></i>Film Adı <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="Örn: Inception, Interstellar..." required>
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Film Türü -->
                    <div class="col-md-4">
                        <label for="genre_id" class="form-label text-light small fw-bold">
                            <i class="bi bi-tags-fill me-1" style="color: #ec4899;"></i>Film Türü <span class="text-danger">*</span>
                        </label>
                        <select name="genre_id" id="genre_id" class="form-select @error('genre_id') is-invalid @enderror" required>
                            <option value="">Tür Seçiniz</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('genre_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Yönetmen -->
                    <div class="col-md-6">
                        <label for="director" class="form-label text-light small fw-bold">
                            <i class="bi bi-person-fill me-1" style="color: #f43f5e;"></i>Yönetmen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="director" id="director" class="form-control @error('director') is-invalid @enderror" 
                               value="{{ old('director') }}" placeholder="Örn: Christopher Nolan" required>
                        @error('director')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Çıkış Yılı -->
                    <div class="col-md-3">
                        <label for="release_year" class="form-label text-light small fw-bold">
                            <i class="bi bi-calendar-event me-1" style="color: #fb7185;"></i>Çıkış Yılı <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" 
                               value="{{ old('release_year', date('Y')) }}" min="1900" max="{{ date('Y') + 2 }}" required>
                        @error('release_year')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- IMDb Puanı -->
                    <div class="col-md-3">
                        <label for="rating" class="form-label text-light small fw-bold d-flex justify-content-between">
                            <span><i class="bi bi-star-fill me-1" style="color: #fb7185;"></i>Puan (0-10) <span class="text-danger">*</span></span>
                            <span class="badge bg-danger" id="ratingDisplay">8.0</span>
                        </label>
                        <input type="number" step="0.1" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" 
                               value="{{ old('rating', '8.0') }}" min="0" max="10" required>
                        @error('rating')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Film Afişi ve Canlı Önizleme Alanı -->
                    <div class="col-12">
                        <label for="poster_image" class="form-label text-light small fw-bold">
                            <i class="bi bi-image-fill me-1" style="color: #ec4899;"></i>Film Afişi (Görsel Yükleme)
                        </label>
                        
                        <div class="p-3 rounded-4 glass-panel border-dashed border-white border-opacity-20 d-flex flex-column flex-md-row align-items-center gap-4">
                            <!-- Önizleme Kutusu -->
                            <div id="posterPreviewContainer" class="position-relative overflow-hidden rounded-3 border border-white border-opacity-10 d-flex align-items-center justify-content-center"
                                 style="width: 110px; height: 150px; background: rgba(8, 12, 22, 0.8); flex-shrink: 0;">
                                <img id="posterPreviewImg" src="" alt="Afiş Önizleme" class="w-100 h-100 object-fit-cover d-none">
                                <div id="posterPlaceholder" class="text-center text-secondary p-2">
                                    <i class="bi bi-cloud-arrow-up display-6 d-block text-muted"></i>
                                    <small class="text-muted" style="font-size: 0.7rem;">Önizleme</small>
                                </div>
                            </div>

                            <div class="flex-grow-1">
                                <input type="file" name="poster_image" id="poster_image" class="form-control @error('poster_image') is-invalid @enderror" accept="image/*">
                                <div class="form-text text-secondary mt-2">
                                    <i class="bi bi-info-circle me-1"></i>JPG, PNG, WEBP formatları desteklenir. (Maksimum 2MB)
                                </div>
                                @error('poster_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Açıklama / Film Özeti -->
                    <div class="col-12">
                        <label for="description" class="form-label text-light small fw-bold">
                            <i class="bi bi-card-text me-1" style="color: #fb7185;"></i>Film Özeti & Konusu <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Filmin konusunu, ana temasını ve etkileyici detaylarını buraya yazın..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top border-white border-opacity-10">
                    <a href="{{ route('movies.index') }}" class="btn btn-glass px-4 py-2">İptal</a>
                    <button type="submit" class="btn btn-glow-rose px-4 py-2 fw-bold d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Filmi Kaydet</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Canlı Görsel Önizleme
    const fileInput = document.getElementById('poster_image');
    const previewImg = document.getElementById('posterPreviewImg');
    const placeholder = document.getElementById('posterPlaceholder');

    if (fileInput && previewImg) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Puan Rozetini Güncelleme
    const ratingInput = document.getElementById('rating');
    const ratingDisplay = document.getElementById('ratingDisplay');
    if (ratingInput && ratingDisplay) {
        ratingInput.addEventListener('input', function() {
            ratingDisplay.textContent = parseFloat(this.value || 0).toFixed(1);
        });
    }
});
</script>
@endsection
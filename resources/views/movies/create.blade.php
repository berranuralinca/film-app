@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
                <h3 class="fw-bold text-warning mb-0">
                    <i class="bi bi-film me-2"></i>Yeni Film Ekle
                </h3>
                <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Geri Dön
                </a>
            </div>

            <!-- Form: Resim yüklemek için enctype="multipart/form-data" ZORUNLUDUR -->
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Laravel CSRF Güvenlik Kalkanı -->

                <div class="row g-3">
                    <!-- Film Başlığı -->
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-semibold">Film Adı <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="Örn: Inception">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Film Türü -->
                    <div class="col-md-4">
                        <label for="genre_id" class="form-label fw-semibold">Film Türü <span class="text-danger">*</span></label>
                        <select name="genre_id" id="genre_id" class="form-select @error('genre_id') is-invalid @enderror">
                            <option value="">Tür Seçiniz</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('genre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Yönetmen -->
                    <div class="col-md-6">
                        <label for="director" class="form-label fw-semibold">Yönetmen <span class="text-danger">*</span></label>
                        <input type="text" name="director" id="director" class="form-control @error('director') is-invalid @enderror" 
                               value="{{ old('director') }}" placeholder="Örn: Christopher Nolan">
                        @error('director')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Çıkış Yılı -->
                    <div class="col-md-3">
                        <label for="release_year" class="form-label fw-semibold">Çıkış Yılı <span class="text-danger">*</span></label>
                        <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" 
                               value="{{ old('release_year', date('Y')) }}" min="1900" max="{{ date('Y') + 2 }}">
                        @error('release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Puan (Rating) -->
                    <div class="col-md-3">
                        <label for="rating" class="form-label fw-semibold">IMDb / Puan <span class="text-danger">*</span></label>
                        <input type="number" step="0.1" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" 
                               value="{{ old('rating', '8.0') }}" min="0" max="10">
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Film Afişi (Dosya Yükleme) -->
                    <div class="col-12">
                        <label for="poster_image" class="form-label fw-semibold">Film Afişi (Opsiyonel)</label>
                        <input type="file" name="poster_image" id="poster_image" class="form-control @error('poster_image') is-invalid @enderror" accept="image/*">
                        <div class="form-text text-secondary">Desteklenen formatlar: JPG, PNG, WEBP (Maks. 2MB)</div>
                        @error('poster_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Açıklama / Özet -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Film Özeti / Açıklama <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Filmin konusunu kısaca anlatın...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top border-secondary">
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary">İptal</a>
                    <button type="submit" class="btn btn-warning fw-semibold px-4">
                        <i class="bi bi-check-lg me-1"></i>Filmi Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
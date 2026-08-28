@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
                <h3 class="fw-bold text-warning mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Filmi Düzenle: {{ $movie->title }}
                </h3>
                <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Detaya Dön
                </a>
            </div>

            <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Film Başlığı -->
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-semibold">Film Adı <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $movie->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Film Türü -->
                    <div class="col-md-4">
                        <label for="genre_id" class="form-label fw-semibold">Film Türü <span class="text-danger">*</span></label>
                        <select name="genre_id" id="genre_id" class="form-select @error('genre_id') is-invalid @enderror">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id', $movie->genre_id) == $genre->id ? 'selected' : '' }}>
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
                               value="{{ old('director', $movie->director) }}">
                        @error('director')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Çıkış Yılı -->
                    <div class="col-md-3">
                        <label for="release_year" class="form-label fw-semibold">Çıkış Yılı <span class="text-danger">*</span></label>
                        <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" 
                               value="{{ old('release_year', $movie->release_year) }}" min="1900" max="{{ date('Y') + 2 }}">
                        @error('release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Puan -->
                    <div class="col-md-3">
                        <label for="rating" class="form-label fw-semibold">IMDb / Puan <span class="text-danger">*</span></label>
                        <input type="number" step="0.1" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" 
                               value="{{ old('rating', $movie->rating) }}" min="0" max="10">
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Afiş -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Film Afişi</label>
                        @if ($movie->poster_image)
                            <div class="mb-2 d-flex align-items-center gap-3 p-2 rounded bg-dark border border-secondary">
                                <img src="{{ Str::startsWith($movie->poster_image, 'http') ? $movie->poster_image : asset('storage/' . $movie->poster_image) }}" 
                                     alt="Mevcut Afiş" style="height: 80px; width: 60px; object-fit: cover; border-radius: 4px;">
                                <div class="small text-secondary">
                                    Mevcut afiş yüklü. Değiştirmek istemiyorsanız yeni dosya seçmeyin.
                                </div>
                            </div>
                        @endif

                        <input type="file" name="poster_image" id="poster_image" class="form-control @error('poster_image') is-invalid @enderror" accept="image/*">
                        @error('poster_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Açıklama -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Film Özeti <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $movie->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top border-secondary">
                    <a href="{{ route('movies.show', $movie) }}" class="btn btn-secondary">İptal</a>
                    <button type="submit" class="btn btn-warning fw-semibold px-4">
                        <i class="bi bi-save me-1"></i>Değişiklikleri Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
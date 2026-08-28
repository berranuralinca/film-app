<?php

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('movies index page renders with glassmorphic cards and hero section', function () {
    $genre = Genre::firstOrCreate(['name' => 'Bilim Kurgu', 'slug' => 'bilim-kurgu']);
    $movie = Movie::firstOrCreate([
        'title' => 'Inception',
        'genre_id' => $genre->id,
        'director' => 'Christopher Nolan',
        'release_year' => 2010,
        'rating' => 8.8,
        'description' => 'Dom Cobb çok yetenekli bir hırsızdır.',
    ]);

    $response = $this->get(route('movies.index'));

    $response->assertStatus(200);
    $response->assertSee('Filmolog');
    $response->assertSee('Sinema Dünyasını');
    $response->assertSee($movie->title);
    $response->assertSee('Detayları İncele');
});

test('movies show page renders with dynamic theme and comments section', function () {
    $genre = Genre::firstOrCreate(['name' => 'Aksiyon', 'slug' => 'aksiyon']);
    $movie = Movie::firstOrCreate([
        'title' => 'The Dark Knight',
        'genre_id' => $genre->id,
        'director' => 'Christopher Nolan',
        'release_year' => 2008,
        'rating' => 9.0,
        'description' => 'Batman Gotham şehrini suç örgütlerinden temizlemeye başlar.',
    ]);

    $response = $this->get(route('movies.show', $movie));

    $response->assertStatus(200);
    $response->assertSee($movie->title);
    $response->assertSee($movie->director);
    $response->assertSee('movieBackdropAmbient');
    $response->assertSee('İzleyici Yorumları');
});

test('movies create page renders with live preview structure', function () {
    $response = $this->get(route('movies.create'));

    $response->assertStatus(200);
    $response->assertSee('Yeni Film Ekle');
    $response->assertSee('posterPreviewImg');
});

test('movies edit page renders with current movie data and live preview', function () {
    $genre = Genre::firstOrCreate(['name' => 'Dram', 'slug' => 'dram']);
    $movie = Movie::firstOrCreate([
        'title' => 'Fight Club',
        'genre_id' => $genre->id,
        'director' => 'David Fincher',
        'release_year' => 1999,
        'rating' => 8.8,
        'description' => 'Uykusuzluk çeken bir ofis çalışanı...',
    ]);

    $response = $this->get(route('movies.edit', $movie));

    $response->assertStatus(200);
    $response->assertSee('Filmi Düzenle');
    $response->assertSee($movie->title);
});

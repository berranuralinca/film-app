<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Aksiyon',
            'Bilim Kurgu',
            'Dram',
            'Komedi',
            'Korku',
            'Animasyon',
            'Macera',
        ];

        foreach ($genres as $name) {
            Genre::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}

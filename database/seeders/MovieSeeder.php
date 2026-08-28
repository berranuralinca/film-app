<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
       $sciFi=Genre::where("slug","bilim-kurgu")->first();
       $action=Genre::where("slug","aksiyon")->first();
       $drama=Genre::where("slug","dram")->first();

       Movie::create([
        "genre_id"=>$sciFi->id,
        "title"=>"Inception",
        'description' => 'Dom Cobb çok yetenekli bir hırsızdır. Uzmanlık alanı, zihnin en savunmasız olduğu rüya görme anında bilinçaltının derinliklerindeki değerli sırları çekip çıkarmaktır.',
        'director' => 'Christopher Nolan',
        'release_year' => 2010,
        'rating' => 8.8,
        'poster_image' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=600&auto=format&fit=crop&q=80'
        ]);

        Movie::create([
            'genre_id' => $sciFi->id,
            'title' => 'Interstellar',
            'description' => 'İnsanlığın Dünya üzerindeki zamanı sona ererken, bir grup kaşif insanlık tarihinin en önemli görevini üstlenir: İnsanlığın yıldızların arasında bir geleceği olup olmadığını keşfetmek.',
            'director' => 'Christopher Nolan',
            'release_year' => 2014,
            'rating' => 8.7,
            'poster_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&auto=format&fit=crop&q=80'
        ]);

        Movie::create([
            'genre_id' => $action->id,
            'title' => 'The Dark Knight',
            'description' => 'Batman, Teğmen James Gordon ve Bölge Savcısı Harvey Dent in yardımıyla Gotham şehrini saran suç örgütlerinden temizlemeye başlar.',
            'director' => 'Christopher Nolan',
            'release_year' => 2008,
            'rating' => 9.0,
            'poster_image' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=600&auto=format&fit=crop&q=80'
        ]);

        Movie::create([
            'genre_id' => $drama->id,
            'title' => 'Fight Club',
            'description' => 'Uykusuzluk çeken bir ofis çalışanı ve tasasız bir sabun üreticisi, çok daha fazlasına dönüşen bir yeraltı dövüş kulübü kurarlar.',
            'director' => 'David Fincher',
            'release_year' => 1999,
            'rating' => 8.8,
            'poster_image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=600&auto=format&fit=crop&q=80'
        ]);
    }
}

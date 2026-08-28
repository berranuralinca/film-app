<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $sciFi = Genre::where('slug', 'bilim-kurgu')->first();
        $action = Genre::where('slug', 'aksiyon')->first();
        $drama = Genre::where('slug', 'dram')->first();
        $comedy = Genre::where('slug', 'komedi')->first();
        $horror = Genre::where('slug', 'korku')->first();
        $animation = Genre::where('slug', 'animasyon')->first();
        $adventure = Genre::where('slug', 'macera')->first();

        // 1. Inception
        $m1 = Movie::create([
            'genre_id' => $sciFi->id,
            'title' => 'Inception',
            'description' => 'Dom Cobb çok yetenekli bir hırsızdır. Uzmanlık alanı, zihnin en savunmasız olduğu rüya görme anında bilinçaltının derinliklerindeki değerli sırları çekip çıkarmaktır.',
            'director' => 'Christopher Nolan',
            'release_year' => 2010,
            'rating' => 8.8,
            'poster_image' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m1->id, 'author_name' => 'Caner Demir', 'rating' => 5, 'content' => 'Sinema tarihinin en iyi kurgulanmış başyapıtlarından biri. Hans Zimmer müzikleri büyüleyici!']);
        Comment::create(['movie_id' => $m1->id, 'author_name' => 'Elif Kaya', 'rating' => 5, 'content' => 'Rüya içinde rüya katmanları ve son sahnedeki topaç detayı hala aklımda.']);

        // 2. Interstellar
        $m2 = Movie::create([
            'genre_id' => $sciFi->id,
            'title' => 'Interstellar',
            'description' => 'İnsanlığın Dünya üzerindeki zamanı sona ererken, bir grup kaşif insanlık tarihinin en önemli görevini üstlenir: İnsanlığın yıldızların arasında bir geleceği olup olmadığını keşfetmek.',
            'director' => 'Christopher Nolan',
            'release_year' => 2014,
            'rating' => 8.7,
            'poster_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m2->id, 'author_name' => 'Murat Aksoy', 'rating' => 5, 'content' => 'Gözyaşlarımı tutamadım. Bilim ile sevginin boyutlar arası bağını harika işlemiş.']);

        // 3. The Dark Knight
        $m3 = Movie::create([
            'genre_id' => $action->id,
            'title' => 'The Dark Knight',
            'description' => 'Batman, Teğmen James Gordon ve Bölge Savcısı Harvey Dent in yardımıyla Gotham şehrini saran suç örgütlerinden temizlemeye başlar. Fakat Joker ortaya çıkınca her şey kaosa sürüklenir.',
            'director' => 'Christopher Nolan',
            'release_year' => 2008,
            'rating' => 9.0,
            'poster_image' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m3->id, 'author_name' => 'Serkan Yıldız', 'rating' => 5, 'content' => 'Heath Ledger performansı sinema tarihine altın harflerle geçti. Kusursuz bir aksiyon.']);

        // 4. Fight Club
        $m4 = Movie::create([
            'genre_id' => $drama->id,
            'title' => 'Fight Club',
            'description' => 'Uykusuzluk çeken bir ofis çalışanı ve tasasız bir sabun üreticisi, çok daha fazlasına dönüşen bir yeraltı dövüş kulübü kurarlar.',
            'director' => 'David Fincher',
            'release_year' => 1999,
            'rating' => 8.8,
            'poster_image' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m4->id, 'author_name' => 'Burak Çelik', 'rating' => 5, 'content' => 'İlk kural: Dövüş kulübü hakkında konuşma! Ters köşe sonuyla unutulmaz.']);

        // 5. Blade Runner 2049
        $m5 = Movie::create([
            'genre_id' => $sciFi->id,
            'title' => 'Blade Runner 2049',
            'description' => 'Genç bir Blade Runner olan K, insanlık ile replikantlar arasındaki dengeleri kökten değiştirebilecek uzun süredir saklanan bir sırrı açığa çıkarır.',
            'director' => 'Denis Villeneuve',
            'release_year' => 2017,
            'rating' => 8.0,
            'poster_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m5->id, 'author_name' => 'Zeynep Aydın', 'rating' => 5, 'content' => 'Görsel efektler, neon pembe ve turuncu ışıklandırma atmosferi tek kelimeyle muazzam.']);

        // 6. Pulp Fiction
        $m6 = Movie::create([
            'genre_id' => $action->id,
            'title' => 'Pulp Fiction',
            'description' => 'İki mafya tetikçisi, bir boksör, bir gangster ve karısının hayatları şiddet ve kurtuluş dolu dört masalda iç içe geçer.',
            'director' => 'Quentin Tarantino',
            'release_year' => 1994,
            'rating' => 8.9,
            'poster_image' => 'https://images.unsplash.com/photo-1594909122845-11baa439b7bf?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m6->id, 'author_name' => 'Oğuzhan Koç', 'rating' => 5, 'content' => 'Tarantino nun diyalog yazmadaki ustalığı ve ikonik dans sahnesi efsane.']);

        // 7. The Matrix
        $m7 = Movie::create([
            'genre_id' => $sciFi->id,
            'title' => 'The Matrix',
            'description' => 'Güzel bir yabancı, bilgisayar korsanı Neo yu karanlık bir yeraltı dünyasına götürür ve burada şok edici bir gerçeği keşfeder: bildiği hayat kötü niyetli bir yapay zekanın ayrıntılı aldatmacasıdır.',
            'director' => 'Lana & Lilly Wachowski',
            'release_year' => 1999,
            'rating' => 8.7,
            'poster_image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m7->id, 'author_name' => 'Deniz Kurt', 'rating' => 5, 'content' => 'Kırmızı hapı mı seçeceksin, mavi hapı mı? Bilim kurgunun dönüm noktası.']);

        // 8. La La Land
        $m8 = Movie::create([
            'genre_id' => $drama->id,
            'title' => 'La La Land',
            'description' => 'Los Angeles ta yolları kesişen tutkulu bir caz piyanisti ile hevesli bir oyuncu, hayallerini kovalarken aşk ve kariyer arasında zorlu seçimlerle karşılaşır.',
            'director' => 'Damien Chazelle',
            'release_year' => 2016,
            'rating' => 8.0,
            'poster_image' => 'https://images.unsplash.com/photo-1514306191717-452ec28c7814?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m8->id, 'author_name' => 'Selin Güneş', 'rating' => 5, 'content' => 'Renk paleti, şarkıları ve final sahnesindeki paralel evren sekansı kalbimi fethetti.']);

        // 9. Oppenheimer
        $m9 = Movie::create([
            'genre_id' => $drama->id,
            'title' => 'Oppenheimer',
            'description' => 'Amerikalı bilim insanı J. Robert Oppenheimer ın Manhattan Projesi kapsamında ilk nükleer silahı geliştirmesi ve ardından yaşadığı ahlaki hesaplaşmalar.',
            'director' => 'Christopher Nolan',
            'release_year' => 2023,
            'rating' => 8.9,
            'poster_image' => 'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m9->id, 'author_name' => 'Kaan Öztürk', 'rating' => 5, 'content' => 'Cillian Murphy tek kelimeyle devleşmiş. Trinity test sahnesindeki sessizlik nefes kesti.']);

        // 10. Spider-Man: Into the Spider-Verse
        $m10 = Movie::create([
            'genre_id' => $animation->id,
            'title' => 'Spider-Man: Into the Spider-Verse',
            'description' => 'Genç Miles Morales, kendi evreninin yeni Örümcek Adamı olur ve tüm gerçeklikleri tehdit eden bir tehlikeyi durdurmak için diğer boyutlardan gelen beş örümcek kahramanla güçlerini birleştirir.',
            'director' => 'Bob Persichetti, Peter Ramsey',
            'release_year' => 2018,
            'rating' => 8.4,
            'poster_image' => 'https://images.unsplash.com/photo-1635805737707-575885ab0820?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m10->id, 'author_name' => 'Emre Şahin', 'rating' => 5, 'content' => 'Çizgi roman estetiğini sinemaya bu kadar yaratıcı aktaran başka bir yapım yok.']);

        // 11. Dune: Part Two
        $m11 = Movie::create([
            'genre_id' => $adventure->id,
            'title' => 'Dune: Part Two',
            'description' => 'Paul Atreides, ailesini yok eden komploculara karşı intikam arayışındayken Chani ve Fremenlerle birleşir. Hayatının aşkı ile bilinen evrenin kaderi arasında bir seçim yapmak zorunda kalır.',
            'director' => 'Denis Villeneuve',
            'release_year' => 2024,
            'rating' => 8.6,
            'poster_image' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m11->id, 'author_name' => 'Tolga Arslan', 'rating' => 5, 'content' => 'Sinemada izlediğim en epik bilim kurgu deneyimiydi. Çöl sahneleri nefes kesici.']);

        // 12. The Grand Budapest Hotel
        $m12 = Movie::create([
            'genre_id' => $comedy->id,
            'title' => 'The Grand Budapest Hotel',
            'description' => 'Ünlü bir Avrupa otelinin efsanevi kapıcısı Gustave H ile genç komi Zero Moustafa nın paha biçilmez bir Rönesans tablosunun çalınması etrafında dönen eğlenceli maceraları.',
            'director' => 'Wes Anderson',
            'release_year' => 2014,
            'rating' => 8.1,
            'poster_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m12->id, 'author_name' => 'Ayşe Vural', 'rating' => 5, 'content' => 'Pembe ve pastel renk paleti, simetri ve mizah harika bir uyum içinde.']);

        // 13. Parasite
        $m13 = Movie::create([
            'genre_id' => $drama->id,
            'title' => 'Parasite',
            'description' => 'Yoksul Kim ailesi fertleri, zengin Park ailesinin evinde teker teker iş bularak onların hayatına sızar. Ancak beklenmedik bir olay iki ailenin kaderini alt üst eder.',
            'director' => 'Bong Joon-ho',
            'release_year' => 2019,
            'rating' => 8.5,
            'poster_image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m13->id, 'author_name' => 'Gamze Akın', 'rating' => 5, 'content' => 'Sınıf farkını ve gerilimi bu denli zekice anlatan nadir filmlerden. Oscar ı sonuna kadar hak etti.']);

        // 14. The Shining
        $m14 = Movie::create([
            'genre_id' => $horror->id,
            'title' => 'The Shining',
            'description' => 'Kış aylarında kapalı olan Overlook Oteli ne bakıcı olarak yerleşen yazar Jack Torrance ve ailesi, oteldeki doğaüstü güçlerin etkisiyle akıl sağlığını yitirmeye başlar.',
            'director' => 'Stanley Kubrick',
            'release_year' => 1980,
            'rating' => 8.4,
            'poster_image' => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m14->id, 'author_name' => 'Metin Ersoy', 'rating' => 5, 'content' => 'Jack Nicholson ın efsanevi performansı ve koridor sahnelerindeki kırmızı renk kullanımı gerilimin zirvesi.']);

        // 15. Spirited Away
        $m15 = Movie::create([
            'genre_id' => $animation->id,
            'title' => 'Spirited Away (Ruhların Kaçışı)',
            'description' => 'Ailesiyle yeni bir kasabaya taşınırken ruhlar dünyasına adım atan küçük Chihiro, domuzlara dönüşen anne babasını kurtarmak için gizemli bir hamamda çalışmak zorunda kalır.',
            'director' => 'Hayao Miyazaki',
            'release_year' => 2001,
            'rating' => 8.6,
            'poster_image' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m15->id, 'author_name' => 'İrem Sönmez', 'rating' => 5, 'content' => 'Miyazaki nin hayal gücü sınır tanımıyor. Büyülü ve derin bir masal.']);

        // 16. Whiplash
        $m16 = Movie::create([
            'genre_id' => $drama->id,
            'title' => 'Whiplash',
            'description' => 'Genç ve hırslı bir baterist olan Andrew, ülkenin en prestijli müzik okulunda acımasız ve mükemmeliyetçi bir eğitmenin öğrencisi olduğunda sınırlarını zorlar.',
            'director' => 'Damien Chazelle',
            'release_year' => 2014,
            'rating' => 8.5,
            'poster_image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&auto=format&fit=crop&q=80',
        ]);
        Comment::create(['movie_id' => $m16->id, 'author_name' => 'Hakan Çetin', 'rating' => 5, 'content' => 'Finaldeki bateri solosu sırasında adeta nefesimi tuttum. Tutkunun ve deliliğin sınırında bir başyapıt.']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use Faker\Factory as Faker;
use Faker\Provider\Youtube;
use Illuminate\Database\Seeder;
use Xylis\FakerCinema\Provider\Movie;
use Xylis\FakerCinema\Provider\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $creator_id = User::where('role', 'author')->pluck('id')->toArray();

        $films = [
            [
                'id' => Str::uuid(),
                'title' => 'Laskar Pelangi',
                'description' => 'Film ini mengisahkan tentang perjuangan sekelompok anak di Belitung yang bersekolah di sebuah sekolah miskin bernama SD Muhammadiyah.',
                'release_year' => 2008,
                'age_rating' => 'PG',
                'duration' => 125,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=8ZYOqARRTng',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/8/8e/Laskar_pelangi_sampul.jpg',
                'slug' => Str::slug('Laskar Pelangi'),
                
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Ada Apa dengan Cinta?',
                'description' => 'Film ini menceritakan tentang kisah cinta antara Cinta dan Rangga, dua remaja dengan latar belakang yang berbeda.',
                'release_year' => 2002,
                'age_rating' => 'PG-13',
                'duration' => 112,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=8BE8Qq56WA0',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/d/d5/Ada-apa-dengan-cinta.jpg',
                'slug' => Str::slug('Ada Apa dengan Cinta?'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Dilan 1990',
                'description' => 'Film ini mengisahkan tentang kisah cinta antara Dilan dan Milea di tahun 1990-an.',
                'release_year' => 2018,
                'age_rating' => 'PG-13',
                'duration' => 110,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=X_b-wNkz4DU',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/1/19/Dilan_1990_%28poster%29.jpg',
                'slug' => Str::slug('Dilan 1990'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Pengabdi Setan',
                'description' => 'Film horor ini menceritakan tentang sebuah keluarga yang ditinggalkan oleh sang ibu dan kemudian mengalami kejadian-kejadian mistis.',
                'release_year' => 2017,
                'age_rating' => 'R',
                'duration' => 107,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=0hSptYxWB3E',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/e/e1/Pengabdi_Setan_poster.jpg',
                'slug' => Str::slug('Pengabdi Setan'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Warkop DKI Reborn: Jangkrik Boss!',
                'description' => 'Film komedi ini menceritakan tentang trio Warkop DKI yang kembali dengan petualangan baru mereka.',
                'release_year' => 2016,
                'age_rating' => 'PG-13',
                'duration' => 107,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=lmuNabammwk',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/5/55/WDKI_reborn.jpg',
                'slug' => Str::slug('Warkop DKI Reborn: Jangkrik Boss!'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Habibie & Ainun',
                'description' => 'Film ini mengisahkan kisah cinta inspiratif antara Rudy Habibie, seorang jenius ahli pesawat terbang, dan Hasri Ainun, seorang dokter muda cerdas.',
                'release_year' => 2012,
                'age_rating' => 'PG-13',
                'duration' => 125,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=DlU_FyHXS7M',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/7/74/Habibie_Ainun_Poster.jpg',
                'slug' => Str::slug('Habibie & Ainun'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Ayat-Ayat Cinta',
                'description' => 'Film ini menceritakan kisah cinta dan perjuangan seorang mahasiswa Indonesia yang menempuh pendidikan di Mesir.',
                'release_year' => 2008,
                'age_rating' => 'PG-13',
                'duration' => 120,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=0wLLD16zAts',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/thumb/c/c8/Ayat-Ayat_Cinta.jpg/330px-Ayat-Ayat_Cinta.jpg',
                'slug' => Str::slug('Ayat-Ayat Cinta'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'KKN di Desa Penari',
                'description' => 'Film horor ini menceritakan sekelompok mahasiswa yang mengalami kejadian mistis saat menjalani program KKN di sebuah desa terpencil.',
                'release_year' => 2022,
                'age_rating' => 'R',
                'duration' => 130,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=01BPk6M37qs',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/thumb/b/b7/KKN_di_Desa_Penari.jpg/330px-KKN_di_Desa_Penari.jpg',
                'slug' => Str::slug('KKN di Desa Penari'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Imperfect',
                'description' => 'Film ini mengisahkan perjalanan seorang wanita dalam menerima dan mencintai dirinya sendiri di tengah tekanan sosial tentang standar kecantikan.',
                'release_year' => 2019,
                'age_rating' => 'PG-13',
                'duration' => 113,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=f4Sc26vQHcU',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/9/98/Imperfect_Karier%2C_Cinta_%26_Timbangan_poster.jpeg',
                'slug' => Str::slug('Imperfect'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Marlina Si Pembunuh dalam Empat Babak',
                'description' => 'Film ini menceritakan seorang janda di Sumba yang membalas dendam setelah mengalami perampokan dan pemerkosaan.',
                'release_year' => 2017,
                'age_rating' => 'R',
                'duration' => 93,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=Ikgy2Xukwng',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/1/14/Marlina_%28cover%29.jpg',
                'slug' => Str::slug('Marlina Si Pembunuh dalam Empat Babak'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Keluarga Cemara',
                'description' => 'Film drama keluarga yang mengisahkan perjuangan sebuah keluarga dalam menghadapi kesulitan ekonomi dan tetap menjaga keharmonisan.',
                'release_year' => 2018,
                'age_rating' => 'PG',
                'duration' => 110,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=sGaeDzD_3o0',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/7/74/Keluarga_Cemara_%28poster%29.jpg',
                'slug' => Str::slug('Keluarga Cemara'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Perempuan Tanah Jahanam',
                'description' => 'Film horor yang menceritakan Maya dan temannya yang kembali ke desa asalnya untuk mencari warisan, namun menemukan rahasia kelam.',
                'release_year' => 2019,
                'age_rating' => 'R',
                'duration' => 106,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=XY7falovJiI',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/thumb/0/0e/PTJ_%282019%29.jpg/330px-PTJ_%282019%29.jpg',
                'slug' => Str::slug('Perempuan Tanah Jahanam'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Gundala',
                'description' => 'Film superhero Indonesia yang mengisahkan Sancaka, seorang pria yang mendapatkan kekuatan petir dan menjadi pahlawan bernama Gundala.',
                'release_year' => 2019,
                'age_rating' => 'PG-13',
                'duration' => 123,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=8rauD1vxMCw',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/d/de/Gundala_%282019%29_poster.jpg',
                'slug' => Str::slug('Gundala'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Ancika: Dia yang Bersamaku 1995',
                'description' => 'Film romantis yang mengisahkan cinta Dilan dengan sosok perempuan bernama Ancika.',
                'release_year' => 2024,
                'age_rating' => 'PG-13',
                'duration' => 100,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=DbOa2bGLNWA',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/2/2b/Poster_Ancika_-_Dia_yang_Bersamaku_1995_%282024%29.jpg',
                'slug' => Str::slug('Ancika: Dia yang Bersamaku 1995'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Sehidup Semati',
                'description' => 'Film horor dan thriller yang mengisahkan tentang Renata yang mengalami pernikahan rumit.',
                'release_year' => 2024,
                'age_rating' => 'R',
                'duration' => 108,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=3SPDmv9J6a0',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/8/8a/Poster_Sehidup_Semati_%282024%29.jpg',
                'slug' => Str::slug('Sehidup Semati'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Bila Esok Ibu Telah Tiada',
                'description' => 'Drama keluarga yang menampilkan Christine Hakim sebagai seorang ibu yang membesarkan 4 anak.',
                'release_year' => 2024,
                'age_rating' => 'PG',
                'duration' => 115,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=UQURtWvSt9o',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/d/dc/Poster_BEIT.jpg',
                'slug' => Str::slug('Bila Esok Ibu Telah Tiada'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Home Sweet Loan',
                'description' => 'Film komedi tentang pasangan muda yang berjuang memiliki rumah impian.',
                'release_year' => 2024,
                'age_rating' => 'PG-13',
                'duration' => 98,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=rWsnLS0Q7G0',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/0/0f/Poster_Home_Sweet_Loan.jpg',
                'slug' => Str::slug('Home Sweet Loan'),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Kuasa Gelap',
                'description' => 'Film horor yang mengisahkan tentang kekuatan gelap yang mengancam sebuah desa.',
                'release_year' => 2024,
                'age_rating' => 'R',
                'duration' => 102,
                'creator_id' => $faker->randomElement($creator_id),
                'trailer' => 'https://www.youtube.com/watch?v=sMkUS1wqr8Q',
                'poster' => 'https://upload.wikimedia.org/wikipedia/id/a/aa/Poster_Kuasa_Gelap.jpg',
                'slug' => Str::slug('Kuasa Gelap'),
            ],
        ];

        foreach ($films as $film) {
            Film::create($film);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Book;
use App\Models\Collection;
use App\Models\Circulation;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Hilman Fauzi',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make("password")
        ]);

        Member::create([
            'kode_member' => 'KM0001',
            'nama' => 'Hilman Fauzi Herdiana',
            'nomor' => '085295338350'
        ]);

        Book::create([
            'kode_buku' => 'KB0001',
            'judul' => 'The Elder Scroll V: Skyrim',
            'author' => 'Bethesda',
            'publisher' => 'Bethesda',
            'tahun_terbit' => '2011',
            'isbn' => '0-021-69073-5',
            'kategori' => 'Fiksi',
            'image' => 'book-images/LlQz1bQgAHx7KmPyNbEZAkARloEcnJ6mbcC4ae4h.png',
        ]);

        Collection::create([
            'kode_koleksi' => 'KK0001',
            'buku_id' => '1',
            'noreg' => 'NR0001',
            'lokasi' => 'R.01',
            'kondisi' => 'Baik',
            'status' => 'Tersedia'
        ]);

        Collection::create([
            'kode_koleksi' => 'KK0002',
            'buku_id' => '1',
            'noreg' => 'NR0002',
            'lokasi' => 'R.02',
            'kondisi' => 'Baik',
            'status' => 'Tersedia'
        ]);
    }

}

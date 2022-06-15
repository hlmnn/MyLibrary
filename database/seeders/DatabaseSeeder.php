<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Book;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
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
            'judul' => 'Ieu Ngetes Judul Buku nu Kahiji',
            'author' => 'Mang Dadang',
            'publisher' => 'Nalaktak',
            'tahun_terbit' => '2002',
            'isbn' => '	0-021-69073-5',
            'kategori' => 'Fiksi',
            'image' => 'SMoVGUxYl11Wj9e4eo8uP9LAlBmKVitajtJTSYdA.jpg',
        ]);
    }

}

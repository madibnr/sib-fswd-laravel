<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $kategori = Kategori::all()->pluck('id')->toArray();
        $produk = Produk::all()->pluck('name')->toArray();

        for ($i=0; $i < 50 ; $i++) {
            $produk = Produk::create([
                'kategori_id' => $faker->randomElement($kategori),
                'name' => $faker->sentence(3),
                'caption' => $faker->randomElement($kategori),
                'harga' => $faker->numberBetween(100000, 1000000),
                'caption' => $faker->randomElement($kategori),
                'status' => $faker->randomElement($kategori),
                'image' => 'Produk_1686767057.jpg',
            ]);
        }
    }
}
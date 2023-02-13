<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::create(
            [
                'name' => 'Sample Donasi Untuk Kegiatan Bakti Sosaial',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus inventore cupiditate fugiat exercitationem ut, veniam doloremque dicta autem voluptates odio impedit? Facere est doloribus nostrum fugit nemo a, fugiat hic!',
                'slug'  => 'sample-donasi-kegiatan-amal',
                'image' => 'default.png',
                'status'    => '1'
            ]
        );

        Campaign::create(
            [
                'name' => 'Sample Donasi Kegiatan Reuni Akbar',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus inventore cupiditate fugiat exercitationem ut, veniam doloremque dicta autem voluptates odio impedit? Facere est doloribus nostrum fugit nemo a, fugiat hic!',
                'slug'  => 'sample-donasi-kegiatan-reuni-akbar',
                'image' => 'default.png',
                'status'    => '1'
            ]
        );

        Campaign::create(
            [
                'name' => 'Sample Penggalangan Dana untuk Korban Gempa',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus inventore cupiditate fugiat exercitationem ut, veniam doloremque dicta autem voluptates odio impedit? Facere est doloribus nostrum fugit nemo a, fugiat hic!',
                'slug'  => 'sample-penggalangan-dana-untuk-korban-gempa',
                'image' => 'default.png',
                'status'    => '1'
            ]
        );
    }
}

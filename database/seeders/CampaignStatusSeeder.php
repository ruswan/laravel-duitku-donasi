<?php

namespace Database\Seeders;

use App\Models\CampaignStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampaignStatus::create([
            'name' => 'Aktif',
        ]);

        CampaignStatus::create([
            'name' => 'Draft',
        ]);

        CampaignStatus::create([
            'name' => 'Tidak Aktif',
        ]);
    }
}

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
        // Define the number of records you want to insert
        $numberOfRecords = 10;

        // Use the Campaign factory to create records
        Campaign::factory()->count($numberOfRecords)->create();
    }
}

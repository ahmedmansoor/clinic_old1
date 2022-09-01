<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Specialty::factory(10)->create();
        // Specialty::truncate();

        $path = storage_path('seeders') . DIRECTORY_SEPARATOR . 'specialties.csv';
        $csvFile = fopen($path, "r");

        $firstline = true;
        while (($data = fgetcsv(
            $csvFile,
            1000,
            ","
        )) !== FALSE) {
            if (!$firstline) {
                Specialty::create([
                    'line_id' => $data['0'],
                    'name' => $data['1'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
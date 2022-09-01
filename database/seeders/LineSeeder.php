<?php

namespace Database\Seeders;

use App\Models\Line;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Line::factory(10)->create();
        // Line::truncate();

        $path = storage_path('seeders') . DIRECTORY_SEPARATOR . 'lines.csv';
        $csvFile = fopen($path, "r");

        $firstline = true;
        while (($data = fgetcsv(
            $csvFile,
            1000,
            ","
        )) !== FALSE) {
            if (!$firstline) {
                Line::create([
                    'name' => $data['0'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
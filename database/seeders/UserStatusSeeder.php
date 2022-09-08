<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UserStatus::factory(3)->create();
        $statuses = [
            ['name' => 'new'], //1
            ['name' => 'active'], //2
            ['name' => 'inactive'], //3
            ['name' => 'dismissed'], //4
            ['name' => 'unset'], //5
        ];

        foreach ($statuses as $status) {
            UserStatus::create($status);
        }
    }
}

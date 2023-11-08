<?php

namespace Database\Seeders;

use App\Models\{Admin, Store};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(1)->create();

        Store::factory(10)->create();
    }
}

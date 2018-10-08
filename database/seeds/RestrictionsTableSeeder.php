<?php

use Illuminate\Database\Seeder;
use FormBuilder\Models\Restriction;

class RestrictionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Restriction::class, 40)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(App\Template::class, 10)->create();
    }
}
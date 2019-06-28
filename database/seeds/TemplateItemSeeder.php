<?php

use Illuminate\Database\Seeder;

class TemplateItemSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(App\TemplateItem::class, 10)->create();
    }
}
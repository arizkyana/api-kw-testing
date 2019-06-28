<?php

use Illuminate\Database\Seeder;

class TemplateChecklistSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        factory(App\TemplateChecklist::class, 1)->create();
    }
}
<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert(
          [
              [
                  'index'=>'about_us',
                  'value_en'=>'Test Text',
                  'value_ar'=>'Test Text',
              ],[
                  'index'=>'terms',
                  'value_en'=>'Test Text',
                  'value_ar'=>'Test Text',
              ],
          ]
        );
    }
}

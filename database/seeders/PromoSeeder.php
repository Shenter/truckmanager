<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0;$i<10;$i++)
        {
            $promo = new Promo(
              [
                  'code' =>Str::upper(Str::random('8')),
              ]
            );
            $promo->save();
        }
    }
}

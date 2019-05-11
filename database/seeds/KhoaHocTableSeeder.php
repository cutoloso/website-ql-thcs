<?php

use Illuminate\Database\Seeder;

class KhoaHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($khoaHoc=2014; $khoaHoc <= 2019; $khoaHoc++) { 
            DB::table('KhoaHoc')->insert(['kh_khoaHoc'=>$khoaHoc]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ThuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i = 2; $i <= 7; $i++) {
        	DB::table('Thu')->insert([
                't_ma'=>"T".$i,
                't_moTa'=>"Thứ ".$i,
            ]);
    	}
    }
}

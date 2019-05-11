<?php

use Illuminate\Database\Seeder;

class PhongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=1;$i<=4;$i++){
    		for ($j=1; $j <= 9; $j++) { 
		        DB::table('Phong')->insert(['p_ma'=>($i*100)+$j,'p_sucChua'=>40,'p_ghiChu'=>'Phòng học']);
			}
	    }
    }
}

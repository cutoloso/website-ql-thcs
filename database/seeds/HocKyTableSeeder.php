<?php

use Illuminate\Database\Seeder;

class HocKyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$khoaHocBD = 2016;
    	$khoaHocHienTai = 2019;
    	for ($khoaHoc = $khoaHocBD; $khoaHoc <= $khoaHocHienTai; $khoaHoc++) { 
			$namHoc =  $khoaHoc.'-'.($khoaHoc+1);
    		for ($hocKy=1; $hocKy <=2 ; $hocKy++) {
	    		DB::table('HocKy')->insert(['hk_hocKy'=>$hocKy,'hk_namHoc'=>$namHoc]);
    		}
    	}
    }
}

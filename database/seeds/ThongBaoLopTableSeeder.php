<?php

use Illuminate\Database\Seeder;

class ThongBaoLopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('vi_VN');
    	$limit = 10;
	    for ($i=0; $i < $limit; $i++) { 
	    	DB::table('ThongBaoLop')->insert([
	        	'tbl_ma'=>$faker->(100+$i),
	        	'tbl_ngayBD'=>,
	        	'tbl_ngayKT'=>,
	        	'tbl_noiDung'=>,
	        	'l_ma'=>,
	        	'gv_ma'=>
	        ]);
	    }
    }
}

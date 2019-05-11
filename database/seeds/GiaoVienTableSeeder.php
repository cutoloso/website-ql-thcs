<?php

use Illuminate\Database\Seeder;

class GiaoVienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('vi_VN');
        $limit = 50;
        $ToCM = array('T','VL','HH','SH','CN','NV','LS','DL','CD','NN','TD','AN','MT','TH');
        for ($i=0; $i < $limit; $i++) {
        	DB::table('GiaoVien')->insert([
        		'gv_ma'=>'GV'.(100+$i),
        		'gv_hoTen'=>$faker->lastName .' '. $faker->firstName,
        		'gv_ngaySinh'=>$faker->date('Y-m-d'),
        		'gv_phai'=>$faker->randomElement($array = array(0,1)),
        		'gv_diaChi'=>$faker->address,
        		'gv_email'=>$faker->unique()->email,
        		'gv_dienThoai'=>'0'.$faker->numberBetween(100000000,999999999),
        		'cm_ma'=>$faker->randomElement($ToCM)
        	]); 
        }

    }
}

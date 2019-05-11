<?php

use Illuminate\Database\Seeder;

class HocSinhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('vi_VN');
      $ma_lop = array('A','B','C','D');
      $stt_hs = 0; //số thứ tự học sinh
      $limit = 30;
      //lớp 9 đã tốt nghiệp
      for ($i=0; $i < sizeof($ma_lop); $i++) {
        $l_ma = $ma_lop[$i];
        for ($j=0; $j < $limit; $j++) { 
          DB::table('HocSinh')->insert([
            'hs_ma'=>'HS'.(100+$stt_hs),
            'hs_hoTen'=>$faker->lastName .' '. $faker->firstName,
            'hs_ngaySinh'=>$faker->date('Y-m-d'),
            'hs_phai'=>$faker->randomElement($array = array(0,1)),
            'hs_diaChi'=>$faker->address,
            'l_ma'=>$l_ma,
            'kh_khoaHoc'=>'2014'
            // 'ph_ma'=>'PH'.$faker->numberBetween(100,120)
          ]);
          $stt_hs ++;
        }
      }
      // chưa tốt nghiệp
    	$khoaHoc = array('2018','2017','2016','2015');
	    $tang = 1; // tầng 1,2,3,4

	    foreach ($khoaHoc as $kh) {
	      for ($i=0; $i < sizeof($ma_lop); $i++) {
	        $l_ma = $ma_lop[$i];
	        for ($j=0; $j < $limit; $j++) { 
	        	DB::table('HocSinh')->insert([
  						'hs_ma'=>'HS'.(100+$stt_hs),
  						'hs_hoTen'=>$faker->lastName .' '. $faker->firstName,
  						'hs_ngaySinh'=>$faker->date('Y-m-d'),
  						'hs_phai'=>$faker->randomElement($array = array(0,1)),
  						'hs_diaChi'=>$faker->address,
  						'l_ma'=>$l_ma,
  						'kh_khoaHoc'=>$kh
	        		// 'ph_ma'=>'PH'.$faker->numberBetween(100,120)
  					]);
  					$stt_hs ++;
	        }
	      }
	      $tang ++;
	    }
    }
  }

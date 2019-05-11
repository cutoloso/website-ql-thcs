<?php

use Illuminate\Database\Seeder;

class LopTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $stt_gv = 0; //số thứ tự giáo viên
    $ma_lop = array('A','B','C','D');
      for ($i=0; $i < sizeof($ma_lop); $i++) {
        $l_ma = $ma_lop[$i];
        DB::table('Lop')->insert([
          'l_ma'=>$l_ma,
          'kh_khoaHoc'=>'2014',
          'p_ma'=>((4*100)+$i+1),
          'gv_ma'=>'GV'.(100 + $stt_gv),
        ]);
        $stt_gv ++;
      }

    $khoaHoc = array('2018','2017','2016','2015');

    $tang = 1; // tầng 1,2,3,4

    foreach ($khoaHoc as $kh) {
      for ($i=0; $i < sizeof($ma_lop); $i++) {
        $l_ma = $ma_lop[$i];
        DB::table('Lop')->insert([
          'l_ma'=>$l_ma,
          'kh_khoaHoc'=>$kh,
          'p_ma'=>(($tang*100)+$i+1),
          'gv_ma'=>'GV'.(100 + $stt_gv),
        ]);
        $stt_gv ++;
      }
      $tang ++;

    }
  }
}

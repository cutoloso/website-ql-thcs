<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	// Admin
  	DB::table('users')->insert(
  		['name' => 'QT100', 'password' => Hash::make('12345678'), 'level' => 1]
  	);

  	// Giáo viên
  	for ($i=0; $i<50 ; $i++) { 
  		DB::table('users')->insert(
  			['name' => 'GV'.(100+$i), 'password' => Hash::make('12345678'), 'level' => 2]
  		);
  	}

		// Phụ huynh
  	for ($j=0; $j<100 ; $j++) { 
  		DB::table('users')->insert(
  			['name' => 'PH'.(100+$j), 'password' => Hash::make('12345678'), 'level' => 3]
  		);
  	}

		// Học sinh
  	for ($k=0; $k<700 ; $k++) { 
  		DB::table('users')->insert(
  			['name' => 'HS'.(100+$k), 'password' => Hash::make('12345678'), 'level' => 4]
  		);
  	}
  }
}

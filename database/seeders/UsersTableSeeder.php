<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
        User::truncate();
        // DB::table('role_user')->truncate();
        // $adminRole = Role::where('name', 'admin')->first();
        // $userRole = Role::where('name', 'user')->first();
        $admin = User::create([
        	'username' => '4dm1n',
        	'fname' => 'Aymen',
        	'lname' => 'Bahar',
        	'email' => 'admin@covidz19.dz',
			'password' => Hash::make('ycef5411@gmail.com'),
			'wilaya_id' => 13,
			'job_id' => 5,
			"role" => '1',
		]);
        $user1 = User::create([
        	'username' => 'temabens',
        	'fname' => 'Fatema Zohra',
        	'lname' => 'Bensayah',
        	'email' => 'tema@gmail.com',
        	'password' => Hash::make('password'),
			'gender' => '1',
			'bio' => $faker->realText(rand(10,20)),
			'birth_date' => '1997-8-5',
			'wilaya_id' => 13,
			'job_id' => 14,
			// 'disease_id' => 2,
			"role" => '0',
			"avatar" => $faker->imageUrl($width = 500, $height = 500),

        ]);

        $user2 = User::create([
        	'username' => 'octothorpe21',
        	'fname' => 'Youssouf',
        	'lname' => 'Kacemi',
			'email' => 'ycef5411@gmail.com',
			'bio' => $faker->realText(rand(10,20)),
        	'password' => Hash::make('1HRMBD99DYH'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			'wilaya_id' => 45,
			'job_id' => 5,
			// 'disease_id' => 6,
			"role" => '0',
			"avatar" => $faker->imageUrl($width = 500, $height = 500)

        ]);

        $user3 = User::create([
        	'username' => 'dritch21',
        	'fname' => 'Mouh',
        	'lname' => 'Berradia',
			'email' => 'mouh@gmail.com',
			'bio' => $faker->realText(rand(10,20)),
        	'password' => Hash::make('password'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			'wilaya_id' => 13,
			'job_id' => 9,
			// 'disease_id' => 6,
			"role" => '0',
			"avatar" => $faker->imageUrl($width = 500, $height = 500)

        ]);

        $user4 = User::create([
        	'username' => 'dritch12',
        	'fname' => 'Sofiane',
			'lname' => 'Haicha',
			'bio' => $faker->realText(rand(10,20)),
        	'email' => 'sofiane@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			'wilaya_id' => 13,
			'job_id' => 3,
			// 'disease_id' => 3,
			"role" => '0',
			"avatar" => $faker->imageUrl($width = 500, $height = 500)

        ]);

        $user5 = User::create([
        	'username' => 'dritch1995',
        	'fname' => 'Jallile',
			'lname' => 'Ayad',
			'bio' => $faker->realText(rand(10,20)),
        	'email' => 'jallile@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '0',
			// 'birth_date' => '1997-8-5',
			'wilaya_id' => 13,
			'job_id' => 13,
			// 'disease_id' => 10,
			"role" => '0',
			"avatar" => $faker->imageUrl($width = 500, $height = 500)
        ]);
        
		
		User::factory()->count(15)->create();


        // $admin->role()->attach($adminRole);
        // $user1->role()->attach($userRole);
        // $user2->role()->attach($userRole);
        // $user3->role()->attach($userRole);
        // $user4->role()->attach($userRole);
        // $user5->role()->attach($userRole);
    }
}

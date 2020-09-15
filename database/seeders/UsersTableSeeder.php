<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        
        $user1 = User::create([
        	'username' => 'temabens',
        	'fname' => 'Fatema Zohra',
        	'lname' => 'Bensayah',
        	'email' => 'tema@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '1',
			'birth_date' => '1997-8-5',
			
        ]);

        $user2 = User::create([
        	'username' => 'octothorpe21',
        	'fname' => 'Youssouf',
        	'lname' => 'Kacemi',
        	'email' => 'ycef5411@gmail.com',
        	'password' => Hash::make('1HRMBD99DYH'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			
        ]);

        $user3 = User::create([
        	'username' => 'dritch21',
        	'fname' => 'Mouh',
        	'lname' => 'Berradia',
        	'email' => 'mouh@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			
        ]);

        $user4 = User::create([
        	'username' => 'dritch12',
        	'fname' => 'Sofiane',
        	'lname' => 'Haicha',
        	'email' => 'sofiane@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			
        ]);

        $user5 = User::create([
        	'username' => 'dritch1995',
        	'fname' => 'Jallile',
        	'lname' => 'Ayad',
        	'email' => 'jallile@gmail.com',
        	'password' => Hash::make('password'),
        	'gender' => '0',
			'birth_date' => '1997-8-5',
			
        ]);
        $admin = User::create([
        	'username' => '4dm1n',
        	'fname' => 'Aymen',
        	'lname' => 'Bahar',
        	'email' => 'admin@covidz19.dz',
            'password' => Hash::make('ycef5411@gmail.com'),
            
        ]);

        $admin->role()->attach($adminRole);
        $user1->role()->attach($userRole);
        $user2->role()->attach($userRole);
        $user3->role()->attach($userRole);
        $user4->role()->attach($userRole);
        $user5->role()->attach($userRole);
    }
}

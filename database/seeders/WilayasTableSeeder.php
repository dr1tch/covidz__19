<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wilaya::truncate();
        $wilaya = Wilaya::create([ 'name' => 'Adrar' ]);
        $wilaya1 = Wilaya::create([ 'name' => 'Chlef' ]);
        $wilaya2 = Wilaya::create([ 'name' => 'Laghouat' ]);
        $wilaya3 = Wilaya::create([ 'name' => 'Oum el-Bouaghi' ]);
        $wilaya4 = Wilaya::create([ 'name' => 'Batna' ]);
        $wilaya5 = Wilaya::create([ 'name' => 'Bejaia' ]);
        $wilaya6 = Wilaya::create([ 'name' => 'Biskra' ]);
        $wilaya7 = Wilaya::create([ 'name' => 'Bechar' ]);
        $wilaya8 = Wilaya::create(['name' => 'Blida']);
        $wilaya9 = Wilaya::create([ 'name' => 'Bouira' ]);
        $wilaya10 = Wilaya::create([ 'name' => 'Tamanghasset' ]);
        $wilaya11 = Wilaya::create([ 'name' => 'Tebessa' ]);
        $wilaya12 = Wilaya::create([ 'name' => 'Tlemcen' ]);
        $wilaya13 = Wilaya::create([ 'name' => 'Tiaret' ]);
        $wilaya14 = Wilaya::create([ 'name' => 'Tizi Ouzou' ]);
        $wilaya15 = Wilaya::create([ 'name' => 'Alger' ]);
        $wilaya16 = Wilaya::create([ 'name' => 'Djelfa' ]);
        $wilaya17 = Wilaya::create([ 'name' => 'Jijel' ]);
        $wilaya18 = Wilaya::create([ 'name' => 'Setif' ]);
        $wilaya19 = Wilaya::create([ 'name' => 'Saida' ]);
        $wilaya20 = Wilaya::create([ 'name' => 'Skikda' ]);
        $wilaya21= Wilaya::create([ 'name' => 'Sidi Bel Abbes' ]);
        $wilaya22 = Wilaya::create([ 'name' => 'Annaba' ]);
        $wilaya23 = Wilaya::create([ 'name' => 'Guelma' ]);
        $wilaya24 = Wilaya::create([ 'name' => 'Constantine' ]);
        $wilaya25 = Wilaya::create([ 'name' => 'Medea' ]);
        $wilaya26 = Wilaya::create([ 'name' => 'Mostaganem' ]);
        $wilaya27 = Wilaya::create([ 'name' => "M''sila" ]);
        $wilaya28 = Wilaya::create([ 'name' => 'Mascara' ]);
        $wilaya29 = Wilaya::create([ 'name' => 'Ouargla' ]);
        $wilaya30 = Wilaya::create([ 'name' => 'Oran' ]);
        $wilaya31 = Wilaya::create([ 'name' => 'El Bayadh' ]);
        $wilaya32 = Wilaya::create([ 'name' => 'Illizi' ]);
        $wilaya33 = Wilaya::create([ 'name' => 'Bordj Bou Arreridj' ]);
        $wilaya34 = Wilaya::create([ 'name' => 'Boumerdes' ]);
        $wilaya35 = Wilaya::create([ 'name' => 'El Taref' ]);
        $wilaya36 = Wilaya::create([ 'name' => 'Tindouf' ]);
        $wilaya37 = Wilaya::create([ 'name' => 'Tissemsilet' ]);
        $wilaya38 = Wilaya::create([ 'name' => 'El Oued' ]);
        $wilaya39 = Wilaya::create([ 'name' => 'Khenchela' ]);
        $wilaya40 = Wilaya::create([ 'name' => 'Souk Ahras' ]);
        $wilaya41 = Wilaya::create([ 'name' => 'Tipaza' ]);
        $wilaya42 = Wilaya::create([ 'name' => 'Mila' ]);
        $wilaya43 = Wilaya::create([ 'name' => 'Ain Defla' ]);
        $wilaya44 = Wilaya::create([ 'name' => 'Naama' ]);
        $wilaya45 = Wilaya::create([ 'name' => 'Ain Temouchent' ]);
        $wilaya46 = Wilaya::create([ 'name' => 'Ghardaia' ]);
        $wilaya47 = Wilaya::create([ 'name' => 'Relizane' ]);
    }
}

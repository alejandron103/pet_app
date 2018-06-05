<?php

use Illuminate\Database\Seeder;
use App\Type;
use App\Breed;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       /* $perro= Type::create([
        	'name' => 'Perro'
        ]);

        $gato= Type::create([
        	'name' => 'Gato'
        ]);*/

        $perro = Type::find(1);
        $gato = Type::find(2);

        $perro->breeds()->createMany([
        	['name'=> 'huskee siberiano'],
        	// ['name'=> 'pitbull'],
            ['name'=> 'bull terrier'],
            ['name'=> 'golden'],
            ['name'=> 'labrador'],
        ]);

        $gato->breeds()->createMany([
        	// ['name'=> 'persa'],
        	// ['name'=> 'siames'],
            ['name'=> 'bengala'],
            ['name'=> 'burmés'],
            ['name'=> 'ragdoll'],
            ['name'=> 'siberiano'],
        ]);
    }
}

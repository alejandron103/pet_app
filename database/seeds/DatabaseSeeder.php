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
        $perro= Type::create([
        	'name' => 'Perro'
        ]);

        $gato= Type::create([
        	'name' => 'gato'
        ]);

        $perro->breeds()->createMany([
        	['name'=> 'siberiano'],
        	['name'=> 'pitbull'],
        ]);

        $gato->breeds()->createMany([
        	['name'=> 'persa'],
        	['name'=> 'siames'],
        ]);
    }
}

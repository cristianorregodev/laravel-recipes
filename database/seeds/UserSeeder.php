<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Cristian Orrego',
            'email' => 'cristian@correo.com',
            'password' => Hash::make('12345678'),
            'webpage' => 'https://cristianorrego.dev',
        ]);
        
        

        $user2 = User::create([
            'name' => 'Fernando Duque',
            'email' => 'fernando@correo.com',
            'password' => Hash::make('12345678'),
            'webpage' => 'https://fernandoduque.dev',
        ]);
        
        
       
    }
}

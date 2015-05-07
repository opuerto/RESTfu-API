<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Fabricante;
use App\Vehiculo;
use App\Oauth_clients;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        
        $this->call('FabricanteSeeder');
        $this->call('VehiculoSeeder');
        User::truncate();
        $this->call('UserSeeder');
        $this->call('Oauth_clientsSeeder');
    }
}

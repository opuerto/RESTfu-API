<?php

use Illuminate\Database\Seeder;
use App\Oauth_clients;
use Faker\Factory as Faker;

class Oauth_clientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FAker::create();
        
                         
                $clients = 
                [
                    [
                       'id'=>Hash::make('api_id_1'),
                        'secret'=>Hash::make('secreto'),
                        'name'=>'api'  

                    ],

                    [
                       'id'=>Hash::make('elfrente'),
                        'secret'=>Hash::make('afram'),
                        'name'=>'frontend'
                    ]
                ];

                foreach ($clients as $client) {
                   Oauth_clients::create($client);
                }
               

                       
    }
}

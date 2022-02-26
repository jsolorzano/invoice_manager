<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'solorzano202009@gmail.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
            'is_client' => false,
        ]);
        
        // Create products with random stock 
        $taxes_prices = [
			'5' => 123.45,
			'15' => 45.65,
			'12' => 39.73,
			'8' => 250.00,
			'10' => 59.35,
        ];
        
        $i = 1;
        foreach($taxes_prices as $k => $v){
			Product::create([
				'name' => 'Producto '.$i,
				'price' => $v,
				'tax' => (int)$k,
				'stock' => (int)rand(10, 100),
			]);
			
			$i++;
		}
    }
}

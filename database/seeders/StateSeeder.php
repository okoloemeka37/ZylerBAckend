<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryData = [
            ['state' => 'Abia', 'days' => 3, 'price' => 3000],
            ['state' => 'Adamawa', 'days' => 5, 'price' => 5000],
            ['state' => 'Akwa Ibom', 'days' => 3, 'price' => 3000],
            ['state' => 'Anambra', 'days' => 3, 'price' => 3000],
            ['state' => 'Bauchi', 'days' => 5, 'price' => 5000],
            ['state' => 'Bayelsa', 'days' => 3, 'price' => 3500],
            ['state' => 'Benue', 'days' => 4, 'price' => 4000],
            ['state' => 'Borno', 'days' => 6, 'price' => 6000],
            ['state' => 'Cross River', 'days' => 4, 'price' => 4000],
            ['state' => 'Delta', 'days' => 3, 'price' => 3000],
            ['state' => 'Ebonyi', 'days' => 3, 'price' => 3000],
            ['state' => 'Edo', 'days' => 2, 'price' => 2500],
            ['state' => 'Ekiti', 'days' => 2, 'price' => 2000],
            ['state' => 'Enugu', 'days' => 3, 'price' => 3000],
            ['state' => 'Gombe', 'days' => 5, 'price' => 5000],
            ['state' => 'Imo', 'days' => 3, 'price' => 3000],
            ['state' => 'Jigawa', 'days' => 6, 'price' => 6000],
            ['state' => 'Kaduna', 'days' => 5, 'price' => 5000],
            ['state' => 'Kano', 'days' => 5, 'price' => 5000],
            ['state' => 'Katsina', 'days' => 6, 'price' => 6000],
            ['state' => 'Kebbi', 'days' => 6, 'price' => 6000],
            ['state' => 'Kogi', 'days' => 3, 'price' => 3000],
            ['state' => 'Kwara', 'days' => 2, 'price' => 2500],
            ['state' => 'Lagos', 'days' => 1, 'price' => 1000],
            ['state' => 'Nasarawa', 'days' => 4, 'price' => 4000],
            ['state' => 'Niger', 'days' => 4, 'price' => 4000],
            ['state' => 'Ogun', 'days' => 1, 'price' => 1500],
            ['state' => 'Ondo', 'days' => 2, 'price' => 2000],
            ['state' => 'Osun', 'days' => 2, 'price' => 2000],
            ['state' => 'Oyo', 'days' => 2, 'price' => 2000],
            ['state' => 'Plateau', 'days' => 5, 'price' => 4500],
            ['state' => 'Rivers', 'days' => 3, 'price' => 3500],
            ['state' => 'Sokoto', 'days' => 6, 'price' => 6000],
            ['state' => 'Taraba', 'days' => 5, 'price' => 5000],
            ['state' => 'Yobe', 'days' => 6, 'price' => 6000],
            ['state' => 'Zamfara', 'days' => 6, 'price' => 6000],
        ];

        DB::table('states')->insert($deliveryData);   
    }
}

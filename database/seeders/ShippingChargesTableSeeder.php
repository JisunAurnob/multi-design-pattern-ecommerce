<?php

namespace Database\Seeders;

use App\Models\ShippingCharge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingCharge::create([
            'location'=>'Inside Dhaka',
            'slug'=>'inside-dhaka',
            'amount'=>'70',
        ]);
        ShippingCharge::create([
            'location'=>'Outside Dhaka',
            'slug'=>'outside-dhaka',
            'amount'=>'100',
        ]);
    }
}

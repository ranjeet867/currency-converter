<?php

use Illuminate\Database\Seeder;

class CurrencyRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency_rates')->insert([
            [
                'name' => 'Rupees',
                'code' => 'INR',
                'rate' => '0.016',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Dollar',
                'code' => 'USD',
                'rate' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'Kuwaiti Dinar',
                'code' => 'KWD',
                'rate' => '3.29',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'EURO',
                'code' => 'EUR',
                'rate' => '1.11',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'YEN',
                'code' => 'JPY',
                'rate' => '0.0088',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]
        ]);
    }
}

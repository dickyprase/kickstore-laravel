<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create([
            'bank_name' => 'BCA',
            'account_name' => 'KICKSTORE OFFICIAL',
            'account_number' => '8690345678',
        ]);

        Bank::create([
            'bank_name' => 'BNI',
            'account_name' => 'KICKSTORE OFFICIAL',
            'account_number' => '0123456789',
        ]);

        Bank::create([
            'bank_name' => 'MANDIRI',
            'account_name' => 'KICKSTORE OFFICIAL',
            'account_number' => '1457890123',
        ]);
    }
}
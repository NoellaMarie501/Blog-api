<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PassportClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => 2, 
            'user_id' => null,
            'name' => 'Test Personal Access Client',
            'secret' => Hash::make('W5bqDGZVptLIwXJGuUTYKpJZwrdQ8Ug1iEaSMZJH'),
            'redirect' => 'http://localhost',
            'personal_access_client' => true,
            'password_client' => false,
            'revoked' => false,
        ]);
    }
}



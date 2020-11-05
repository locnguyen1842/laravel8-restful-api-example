<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class OAuth2ClientAnotherApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install --force');
        Artisan::call('passport:client --password --name="' . config('app.name') . ' Password Grant Client another-api guard" --provider=another_users');
    }
}

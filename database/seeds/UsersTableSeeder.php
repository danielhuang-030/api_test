<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 2;
        for ($i = 1; $i <= $total; $i++) {
            $name = sprintf('tester%s', $i);
            $email = sprintf('%s@email.com', $name);
            $password = sprintf('password%s', $i);
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'api_token' => User::getApiToken(),
            ]);
            $this->command->info(sprintf('user: %s, api_token: %s', $user->name, $user->api_token));
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // .envがlocalだったらMemoSeederクラスを呼ぶ(config内のapp.envではなかった)
        // 本番環境(=productのこと。localじゃないときに)テストデータが呼ばれるのを防ぐ
        if (config('app.env') === 'local') {
            $this->call(MemoSeeder::class);
        }
    }
}

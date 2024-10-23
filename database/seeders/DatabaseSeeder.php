<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\traffic;
use App\Models\type_traffic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user1 = User::firstOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        $user2 = User::firstOrCreate(['email' => 'admin1@gmail.com'], [
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123123123'),
        ]);
        $type_traffics = [
            ["name" => "Xe máy"],
            ["name" => "Xe 16 chỗ"],
            ["name" => "Xe giường nằm"],
            ["name" => "Xe 32 chỗ"],
            ["name" => "Xe 7 chỗ"]
        ];
        foreach ($type_traffics as $value) {
            type_traffic::firstOrCreate($value);
        };
        $traffic = [
            [
                'name_car' => 'xe hàng hóa',
                "avatar_car" => "https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg?auto=compress&cs=tinysrgb&w=600",
                'note' => 'chỉ chở hàng',
                "user_id" => $user1->id,
                'type_traffic_id' => rand(1, 5),
            ],
            [
                'name_car' => 'xe khách',
                "avatar_car" => "https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg?auto=compress&cs=tinysrgb&w=600",
                'note' => 'chỉ chở khách',
                "user_id" => $user2->id,
                'type_traffic_id' => rand(1, 5),
            ],
            [
                'name_car' => 'xe đi lại',
                "avatar_car" => "https://images.pexels.com/photos/170811/pexels-photo-170811.jpeg?auto=compress&cs=tinysrgb&w=600",
                'note' => 'xe dành cho khách đi trong tp',
                "user_id" => $user1->id,
                'type_traffic_id' => rand(1, 5),

            ],



        ];
        foreach ($traffic as $value) {
            traffic::firstOrCreate(['name_car' => $value['name_car']], $value);
        };
    }
}

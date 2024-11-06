<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\traffic;
use App\Models\CustomerType;
use App\Models\CustumerType;
use App\Models\type_traffic;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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


        $customer_type=[
            [
                'name_type'=>'người bình thường',
                'discount'=>0

            ],
            [
                'name_type'=>'trẻ em',
                'discount'=>50

            ],
            [
                'name_type'=>'người khuyết tật',
                'discount'=>80
            ]
        ];
        foreach($customer_type as $value){
            CustomerType::firstOrCreate(
                ['name_type' => $value['name_type']]
                ,$value
            );
        }




        // fake role
        $role = [
            ["name" => "admin"],
            ["name" => "kế toán"],
            ["name" => "quản lí"],
            ["name" => "trưởng phòng"],
            ["name" => "nhân viên"]
        ];
        foreach($role as $value){
            Role::firstOrCreate(
                ['name' => $value['name'] ],
                $value
            );
        }
        $arr_permissions = [
            [
                "name" => "dashboard.statistical",
                "title" => "Thống kê",
                "group_name" => 0,
            ],
            [
                "name" => "dashboard.chart",
                "title" => "Biểu đồ",
                "group_name" => 0,
            ],
            [
                "name" => "dashboard.login",
                "title" => "Đăng nhập trang quản trị",
                "group_name" => 0,
            ],
            [
                "name" => "users.index",
                "title" => "Xem tài khoản",
                "group_name" => 1,
            ],
            [
                "name" => "users.create",
                "title" => "Thêm tài khoản",
                "group_name" => 1,
            ],
            [
                "name" => "users.update",
                "title" => "Sửa tài khoản",
                "group_name" => 1,
            ],
            [
                "name" => "users.delete",
                "title" => "Xóa tài khoản",
                "group_name" => 1,
            ],
            [
                "name" => "users.lock",
                "title" => "Khóa tài khoản",
                "group_name" => 1,
            ],

            [
                "name" => "report.users",
                "title" => "Báo cáo người dùng",
                "group_name" => 2,
            ],
        ];

        foreach($arr_permissions as $value) {
            $permission = Permission::firstOrCreate(['name' => $value['name'] ], $value);
        }

    }
}

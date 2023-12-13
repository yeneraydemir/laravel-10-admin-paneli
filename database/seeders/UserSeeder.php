<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// Yönetici Rolü                
        $role = Role::updateOrCreate([
                'name'=> 'yonetici',
        ],
        [
            'name' => 'yonetici',
            'title' =>'Yönetici',
            'description'=> 'Sitenin genel yönetimini sağlar',
        ]);

// Blog Rolü
                $roleBlog = Role::updateOrCreate([
                'name'=> 'blog-yoneticisi',
        ],
        [   
            'name' => 'blog-yoneticisi',
            'title' =>'Blog Yöneticisi',
            'description'=> 'Blog Yönetimini Sağlar',
        ]);

// E-Ticaret Rolü
        $roleECommerce = Role::updateOrCreate([
            "name"=> "e-ticaret-yoneticisi",
    ],
    [
        'name' => 'e-ticaret-yoneticisi',
        'title' =>'E-Ticaret Yöneticisi',
        'description'=> 'E-Ticaret Yönetimini Sağlar',
    ]);
// Yetkiler Blog
        $permissions['blog-yoneticisi'] = [
            [
                'title'=> 'Yazilari Goruntuleyebilir',
                'description'=> 'Tum Yazilari Goruntuleyebilir',                
            ],
            [
                'title'=> 'Yazilari Duzenleyebilir',
                'description'=> 'Tum Yazilari Goruntuleyebilir',                
            ],
            [
                'title'=> 'Yazi Kategorilerini Goruntuleyebilir',
                'description'=> 'Tum Yazilari Goruntuleyebilir',                
            ],
            [
                'title'=> 'Yazi Kategorilerini Duzenleyebilir',
                'description'=> 'Tum Yazilari Goruntuleyebilir',                
            ],
              ];
// Yetkiler E-Ticaret
        $permissions['e-ticaret-yoneticisi'] = [
            [
                'title'=> 'Siparisleri Goruntuleyebilir',
                'description'=> 'Tum Siparisleri Goruntuleyebilir',                
            ],
            [
                'title'=> 'Siparisleri Duzenleyebilir',
                'description'=> 'Tum Siparisleri Goruntuleyebilir',                
            ],
            [
                'title'=> 'Urunleri gorebilir',
                'description'=> 'Tum Urunleri Goruntuleyebilir',                
            ],
            [
                'title'=> 'Urunleri Duzenleyebilir',
                'description'=> 'Tum Urunleri Goruntuleyebilir',                
            ],
              ];

              foreach ($permissions as $key =>&$permission) {
                $role = Role::where('name', $key)-> first();
                foreach ($permission as $p) {
                    $newPermission = Permission::updateOrCreate (
                        ['name'=> Str::slug($p['title'])],
                        [
                        'name'=> Str::slug($p['title']),
                        'title'=> $p['title'],
                        'description'=> $p['description'],
                        ]
                    );

                    $role->givePermissionTo($newPermission);
                }
              }

      $user =  User::updateOrCreate(
            [
                "email"=> "iletisim@yeneraydemir.com",
            ],
            [
            "name"=> "Yener",
            "email"=> "iletisim@yeneraydemir.com",
            "password"=> bcrypt("12371327"),
        ]);
        
        $user->assignRole($role);

        if(User::count() == 1 ){
            $users = User::factory(100)->create();
            foreach($users as $user){
                $user->assignRole(rand(0,1) == 1 ? $roleBlog : $roleECommerce);
            }
        }
    }
}

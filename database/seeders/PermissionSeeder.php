<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crudPermissionNames = [
            'Manage admins' => ' أدراة المدراء',
            'Manage roles' => ' أدراة الأدوار والصلاحيات',
            'Manage categories' => 'أدراة الأقسام',
            'Manage dashboard' => 'ادارة لوحة التحكم',
            'Manage users' => 'أدراة المستخدمين',
            'Manage tasks' => 'أدراة المهام',
            'Manage libraries' => 'أدراة المكتبة',
            'Manage payback_requests' => 'أدارة تاريخ المعاملات',
            'Manage ads' => 'أدراة الاعلانات',
            'Manage contact_us' => 'أدراة تواصل معانا',
            'Manage pages' => 'أدراة الصفحات',
            'Manage discounts' => 'أدراة أكواد الخصم',
            'Manage partners' => 'أدراة الشركاء',
            'Manage settings' => 'أدارة الاعدادات',
            'Manage sliders' => 'أدارة السسلايدر',
            'Manage instructions' => 'أدارة التعليمات'
        ];

        foreach ($crudPermissionNames as $en_permission => $ar_permission) {
                Permission::updateOrCreate(
                    [
                        'name' => $en_permission,
                        'name_ar' =>$ar_permission,
                        'guard_name' => 'admin',
                    ],
                    [
                        'name' => $en_permission,
                        'name_ar' =>$ar_permission,
                        'guard_name' => 'admin',
                    ]
                );
        }

        $role = Role::where(['name' => 'super admin', 'guard_name' => 'admin'])->first();

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->pluck('id'));
    }
}

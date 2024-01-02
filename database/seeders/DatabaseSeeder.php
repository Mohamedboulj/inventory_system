<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /*\App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);*/
        $user = User::find('1');
        $user->assignRole('super_admin');
        // Reset cached roles and permissions
        /*app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::create(['name' => 'super_admin']);
        $permissionsByRole = [
            'super_admin' => ['create user','edit user','delete user', 'restore user','create order','create purchase','create category','edit category','delete category','create unit','edit unit','delete unit','create currency','edit currency','delete currency','create location','edit location','delete location','create society','edit society','delete society','create org','edit org','delete org','create costumer','edit costumer','delete costumer','create supplier','edit supplier','delete supplier','assign to user','associate to user','create product','edit product','delete product','dissociate to user']
        ];

        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => 'api']))
            ->toArray();

        $permissionIdsByRole = [
            'super_admin' => $insertPermissions('super_admin'),
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();
            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }*/
    }
}

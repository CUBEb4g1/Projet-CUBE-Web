<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedPermissionTable extends Migration
{


    const DEVELOPER = 'developer';
    const ADMIN     = 'admin';
    const MODERATOR = 'moderator';

    const DEV_TOOLS         = 'dev';
    const ADMIN_TOOLS       = 'admin-tools';
    const MOD_TOOLS         = 'mod-tools';

    const ACCESS_BACKOFFICE = 'access-backoffice';
    const SWITCH_AUTH       = 'switch-auth';

    protected $roles = [
        self::DEVELOPER => [
            'name' => self::DEVELOPER,
            'readable_name' => 'Super Administrateur',
        ],
        self::ADMIN => [
            'name' => self::ADMIN,
            'readable_name' => 'Administrateur',
        ],
        self::MODERATOR => [
            'name' => self::MODERATOR,
            'readable_name' => 'Modérateur',
        ],
    ];

    protected $permissions = [
        self::DEV_TOOLS => [
            'name' => self::DEV_TOOLS,
            'readable_name' => 'Accès aux outils de super admin.',
        ],
        self::ADMIN_TOOLS => [
            'name' => self::ADMIN_TOOLS,
            'readable_name' => 'Accès aux outils d\'admin.',
        ],
        self::MOD_TOOLS => [
            'name' => self::MOD_TOOLS,
            'readable_name' => 'Accès aux outils de modération',
        ],
        self::ACCESS_BACKOFFICE => [
            'name' => self::ACCESS_BACKOFFICE,
            'readable_name' => 'Accès au backoffice',
        ],
        self::SWITCH_AUTH => [
            'name' => self::SWITCH_AUTH,
            'readable_name' => 'Accès aux comptes utilisateurs',
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // === PERMISSIONS ===

        foreach ($this->permissions as $key => $permission) {
            $data                          = ['guard_name' => 'web', 'created_at' => now()];
            $this->permissions[$key]['id'] = DB::table('permissions')->insertGetId($permission + $data);
        }

        // === ROLES ===

        foreach ($this->roles as $key => $role) {
            $data                    = ['guard_name' => 'web', 'created_at' => now()];
            $this->roles[$key]['id'] = DB::table('roles')->insertGetId($role + $data);
        }

        // === RELATION DES ROLES & PERMISSIONS ===

        $relations = [
            self::DEVELOPER => [self::ACCESS_BACKOFFICE, self::SWITCH_AUTH, self::ADMIN_TOOLS, self::MOD_TOOLS, self::DEV_TOOLS],
            self::ADMIN     => [self::ACCESS_BACKOFFICE, self::SWITCH_AUTH, self::ADMIN_TOOLS, self::MOD_TOOLS],
            self::MODERATOR  => [self::ACCESS_BACKOFFICE, self::MOD_TOOLS],
        ];

        foreach ($relations as $role => $permissions) {
            foreach ($permissions as $permission) {
                DB::table('role_has_permissions')->insertGetId([
                    'permission_id' => $this->permissions[$permission]['id'],
                    'role_id'       => $this->roles[$role]['id'],
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->permissions as $permission) {
            DB::table('permissions')->where('name', $permission['name'])->delete();
        }

        foreach ($this->roles as $role) {
            DB::table('roles')->where('name', $role['name'])->delete();
        }
    }
}

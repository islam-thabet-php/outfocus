<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreatePermissionsSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        collect(Route::getRoutes())->map(function ($route) {
            $routeName = $route->getName();
            if ($routeName) {
                $explode = explode('.', $routeName);
                //Skip this routes
                if (!in_array($explode[0], [
                    'ignition',
                    'login',
                    'logout',
                    'register',
                    'password',
                    'home',
                    'passport',
                    'debugbar',
                    'lockedscreen',
                ]) && !in_array($routeName, [
                //
                ])) {
                    Permission::updateOrCreate(
                        [
                            'name' => $routeName,
                            'module' => Str::title($explode[0]),
                            'title' => $this->renamePermissionTitle($routeName),
                        ]
                    );
                }
            }
        });
    }

    private function renamePermissionTitle($title)
    {
        $title = Str::replace('.', ' ', $title);
        return Str::title($title);
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class GateService
{
    /**
     * To defines the role and permisions to auth user
     *
     */
   public function defines()
   {
        $this->checkSuperAdmin();
   }

    /**
     * Implicitly grant "Super Admin" role all permissions
     * This works in the app by using gate-related functions like auth()->user->can() and @can()
     *
     */
    private function checkSuperAdmin()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}

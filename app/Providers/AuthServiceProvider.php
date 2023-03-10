<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

//use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot()
	{
		$this->registerPolicies();

		// Implicitly grant "System" role all permissions
		// This works in the app by using gate-related functions like auth()->user->can() and @can()

		Gate::before(static function (User $user) {
			return $user->isAdmin();
		});

		//        Passport::routes();
	}
}

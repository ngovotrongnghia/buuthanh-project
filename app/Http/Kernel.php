<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRolePermission;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\LanguageSwitcher;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\ThrottleRequest;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\UserMustBeActive;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
	/**
	 * The application's global HTTP middleware stack.
	 *
	 * These middleware are run during every request to your application.
	 *
	 * @var array
	 */
	protected $middleware = [
		TrustProxies::class,
		CheckForMaintenanceMode::class,
		ValidatePostSize::class,
		TrimStrings::class,
		ConvertEmptyStringsToNull::class,
	];

	/**
	 * The application's route middleware groups.
	 *
	 * @var array
	 */
	protected $middlewareGroups = [
		'web' => [
			EncryptCookies::class,
			AddQueuedCookiesToResponse::class,
			StartSession::class,
			// \Illuminate\Session\Middleware\AuthenticateSession::class,
			ShareErrorsFromSession::class,
			VerifyCsrfToken::class,
			SubstituteBindings::class,
		],

		'api' => [
			'throttle:60,1',
			\Illuminate\Routing\Middleware\SubstituteBindings::class,
		],
	];

	/**
	 * The application's route middleware.
	 *
	 * These middleware may be assigned to groups or used individually.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth'             => Authenticate::class,
		'auth.basic'       => AuthenticateWithBasicAuth::class,
		'bindings'         => SubstituteBindings::class,
		'cache.headers'    => SetCacheHeaders::class,
		'can'              => Authorize::class,
		'guest'            => RedirectIfAuthenticated::class,
		'signed'           => ValidateSignature::class,
		'throttle'         => ThrottleRequest::class,
		'verified'         => EnsureEmailIsVerified::class,
		'password.confirm' => RequirePassword::class,

		'rolepermission' => CheckRolePermission::class,
		'active'         => UserMustBeActive::class,
		'language'       => LanguageSwitcher::class,
		//        'redirect'       => RedirectShowToEdit::class,
	];

	/**
	 * The priority-sorted list of middleware.
	 *
	 * This forces non-global middleware to always be in the given order.
	 *
	 * @var array
	 */
	protected $middlewarePriority = [
		StartSession::class,
		ShareErrorsFromSession::class,
		Authenticate::class,
		\Illuminate\Session\Middleware\AuthenticateSession::class,
		SubstituteBindings::class,
		Authorize::class,
	];
}

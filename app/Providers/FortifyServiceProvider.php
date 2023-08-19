<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Domains\User\Models\User;
use Exception;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse;
use function PHPUnit\Framework\throwException;
use function Termwind\render;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();

        $this->app->instance(LoginResponse::class, new class extends LoginResponse {
            /**
             * @throws Exception
             */
            public function toResponse($request)
            {
                $user = $request->user();

                if($user->hasRole('Super Admin')){
                    return redirect()->route('dashboard');
                }
                else if($user->companies()->count() >= 2 ) {
                    return redirect()->route('user.navigate', ['user' => $user]);
                }
                else if($user->companies()->count() === 1){
                    return redirect()->route('user.dashboard', ['company' => $user->companies()->first()]);
                }
                else throw new Exception('User has no companies set up');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::resetPasswordView(function ($request) {
            return Inertia::render('../Components/ForgottenPassword', ['request' => $request]);
        });
    }
}

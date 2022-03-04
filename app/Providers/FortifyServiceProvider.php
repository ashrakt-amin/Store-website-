<?php

namespace App\Providers;
use App\Models\User;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
        Fortify::authenticateUsing(function (Request $request)
        {
            $request->validate([
                config('fortify.email')=>'required',
                'password'=>'required',
            ]);
    
           /* 
           this in laravel to check and login together
           Auth::attempt([
               'username' => $request->post('username'),
               'password' => $request->post('password')
            ],true);
            */
    
            $username =$request->post('email');
            $password =$request->post('password');
    
            $user =User::where('user_name',$username)
            ->orWhere('email',$username)
            ->orWhere('phone',$username)->first();
    
           if($user && Hash::check($password ,$user->password)){
            Auth::login($user ,true);

            return $user;
            /* 'true' =>this mean make remmember tpken */
           }
    
           
        });

       

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}

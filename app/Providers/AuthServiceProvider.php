<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
         
        Gate::before(function($user){
            if($user->type == 'super_admin'){
                return true ;
            }
         });

        Gate::define('categories.create',function($user){
           if($user->type == 'super_admin'){
               return true ;
           }else {
               return false ;
           }
        });

        /*Gate::define('categories.edit',function($user){
            if($user->type == 'super_admin'){
                return true ;
            }else {
                return false ;
            }
        });*/
        foreach(config('permission') as $code => $label){
            Gate::define($code,function(User $user) use($code){
                return $user->role->permissions()->where('permissions' , '=' ,$code)->exists();
             });
        }
        

            Gate::define('categories.destroy',function($user){
                if($user->type == 'super_admin'){
                    return true ;
                }else {
                    return false ;
                }
         });

        }
    
}

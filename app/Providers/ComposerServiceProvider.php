<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NotificationModel;
use Illuminate\Http\Request;
use Session;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*echo $user_id = Session::get('user_id');
        $count12 = NotificationModel::where('created_by',$user_id)->where('is_seen',0)->count();
        dd($count12);*/
        /*View::composer('common.header', function ($view) {
            $view->with('currentUser', 1);
        });*/
        /*$user_id = Session::all();
        print_r($user_id);

        die('sdsd');*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

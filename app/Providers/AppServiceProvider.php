<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Friend;
use Session;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer('*', function ($view) {
            $uid = Session::get('user_id');

           // $id = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);

            //$friend_count = Friend::find(1)->where('friend_id',$uid);
            ///$view->with('friendCount', $friend_count);
            $friend_count = DB::table('tbl_friend_requests')
            ->where('friend_id', $uid )
            ->where('status',0) 
            ->count();

            $view->with('friendCount', $friend_count);
       });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

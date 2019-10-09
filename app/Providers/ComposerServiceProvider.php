<?php

namespace App\Providers;

use App\Models\Patient;
use App\Models\AdminPermission;
use App\Models\Session as SessionModel;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Auth;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.admin.admin-app', function($view){
            $patients = new Patient();
            
            $sessions_per_week = SessionModel::whereBetween('session_date', [
                Carbon::now()->startOfWeek(Carbon::MONDAY),
                Carbon::now()->addDays(1)
            ])->count();

            $access = AdminPermission::where('admin_id', Auth::user()->id)->first();
            
            $view->with(['patients_variable' => $patients, 'sessions_variable' => $sessions_per_week, 'access' => $access]);
        });
    }
}

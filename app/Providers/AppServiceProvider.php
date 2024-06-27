<?php

namespace App\Providers;

use App\Models\User;
use App\Models\View;
use App\Models\Reply;
use App\Models\Views;
use App\Models\Thread;
use App\Contracts\ViewsContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use App\View\Components\HeroiconSChat; // Tambahkan ini untuk import component


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Perbaikan: Sesuaikan binding dengan benar
        $this->app->bind(ViewsContract::class, Views::class);
        $this->app->bind(ViewContract::class, View::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootEloquentMorphsRelations();
        
        // Perbaikan: Registrasi Blade component dengan nama yang benar
        Blade::component('heroicon-s-chat', HeroiconSChat::class);
    }

    /**
     * Boot Eloquent morphs relations.
     *
     * @return void
     */
    public function bootEloquentMorphsRelations()
    {
        Relation::morphMap([
            Thread::TABLE => Thread::class,
            Reply::TABLE => Reply::class,
            User::TABLE => User::class,
        ]);
    }
}
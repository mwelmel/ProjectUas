<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Dapatkan jalur yang harus diarahkan pengguna ketika mereka tidak terautentikasi
     * 
     * @param \Illuminate\Http\Request
     * @return string|null
    */
    protected function redirectTo($request)
    {
        // Jika permintaan tidak mengharapkan respon JSON, arahkan ke rute login
        if(! $request->expectsJson()){
            return route('login');
        }
    }
}
<?php

namespace App\Jobs;

use App\Models\Thread;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Requests\ThreadStoreRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateThread implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $thread;
    private $attributes;
    
    /**
     * Create a new job instance.
     * 
     * @return void
     */
    
     public function __construct(Thread $thread, array $attributes = [])
     {
        $this->thread = $thread;
        $this->attributes = Arr::only($attributes, [
            'title', 'slug', 'body', 'category_id', 'tags'
        ]);
     }

     
}
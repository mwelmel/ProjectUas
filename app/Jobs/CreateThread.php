<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Support\Str;
use App\Events\ThreadWasCreated;
use News\Purifier\Facades\Purifier;
use App\Http\Request\ThreadStoreRequest;

class CreatedThread
{
    private $title;
    private $body;
    private $category;
    private $tags;
    private $author;

    /**
     * Create a new job instance.
     * 
     * @return void
     */

    public function __construct(string $title, string $body, string $category, array $tags, User $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->category = $category;
        $this->tags = $tags;
        $this->author = $author;
    }
    
}
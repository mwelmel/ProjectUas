<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reply;
use App\Exceptions\CannotLikeItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LikeReplyJob
{
    use Dispatchable;

    private $reply;
    private $user;

    public function __construct(Reply $reply, User $user)
    {
        $this->reply = $reply;
        $this->user = $user;
    }

    public function handle()
    {
        if ($this->reply->isLikedBy($this->user)) {
            throw CannotLikeItem::alreadyLiked('reply');
        }

        $this->reply->likedBy($this->user);
    }
}
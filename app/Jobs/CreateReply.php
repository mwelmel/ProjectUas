<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reply;
use App\Models\ReplyAble;
use App\Events\ReplyWasCreated;
use App\Http\Requests\CreateReplyRequest;

class CreateReplyRequest
{
    private $body;
    private $author;
    private $replyAble;

    public function __construct(string $body, User $author, ReplyAble $replyAble)
    {
        $this->body = $body;
        $this->author = $author;
        $this->replyAble = $replyAble;
    }

    public static function fromRequest(CreateReplyRequest $request): self
    {
        return new static(
            $request->body(),
            $request->author(),
            $request->replyAble(),
        );
    }
}
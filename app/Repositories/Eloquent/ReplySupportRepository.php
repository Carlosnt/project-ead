<?php
namespace App\Repositories\Eloquent;

use App\Events\SupportReplied;
use App\Models\ReplySupport;
use App\Repositories\ReplySupportRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository implements ReplySupportRepositoryInterface
{
    use RepositoryTrait;
    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    public function createReplyToSupport(array $data)
    {
        $replySupport = $this->entity->create($data);

        event(new SupportReplied($replySupport));

        return $replySupport;
    }

}

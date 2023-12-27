<?php

namespace App\Observers;

use App\Models\ReplySupport;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "creating" event.
     *
     * @param  \App\Models\ReplySupport $admin
     * @return void
     */
    public function creating(ReplySupport $reply)
    {
        $reply->admin_id = auth()->user()->id;
    }
}

<?php

namespace App\Observers;

use App\Models\Deal;
use Orchid\Attachment\Models\Attachment;

class DealObserver
{
    public function updating(Deal $deal)
    {
        if($deal->isDirty('thumbnail_id')) {
            $prevId = $deal->getOriginal('thumbnail_id');
            if ($prevId && $prevId != $deal->thumbnail_id) {
                Attachment::find($prevId)?->delete();
            }
        }
    }

    public function deleting(Deal $deal)
    {
        $deal->thumbnail?->delete();
        $deal->documents->each->delete();
        $deal->images->each->delete();
        $deal->attachment->each->delete();
    }
}

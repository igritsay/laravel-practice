<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VideoFormat extends Model
{
    use HasFactory;

    public function deals(): BelongsToMany
    {
        return $this->belongsToMany(Deal::class);
    }
}

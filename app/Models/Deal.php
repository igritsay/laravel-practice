<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deal extends Model
{
    protected $table = 'new_deals';

    protected $fillable = ['name', 'content'];

    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function videoFormats(): BelongsToMany
    {
        return $this->belongsToMany(VideoFormat::class);
    }
}

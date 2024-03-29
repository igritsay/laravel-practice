<?php

namespace App\Models;

use App\Orchid\Filters\Types\WhereHas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDate;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Filters\Types\WhereIn;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;

class Deal extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $table = 'new_deals';

    protected $fillable = ['name', 'content'];

    protected $allowedFilters = [
        'id'            => Where::class,
        'name'          => Like::class,
        'created_at'    => WhereDateStartEnd::class,
        'updated_at'    => WhereDateStartEnd::class,
        'user'          => WhereHas::class,
        'videoFormats'  => WhereHas::class,
    ];

    protected $allowedSorts = [
        'id',
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function videoFormats(): BelongsToMany
    {
        return $this->belongsToMany(VideoFormat::class);
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'thumbnail_id');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'deal_document', 'deal_id', 'attachment_id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, 'deal_image', 'deal_id', 'attachment_id');
    }
}

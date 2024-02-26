<?php

namespace App\Orchid\Filters\Types;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Orchid\Filters\BaseHttpEloquentFilter;


class WhereHas extends BaseHttpEloquentFilter
{
    public function run(Builder $builder): Builder
    {
        $query = $this->getHttpValue();

        $value = is_array($query) ? $query : Str::of($query)->explode(',');

        return $builder
            ->whereHas($this->column, function (Builder $query) use ($value) {
                $query->whereIn('id', $value);
            });
    }
}


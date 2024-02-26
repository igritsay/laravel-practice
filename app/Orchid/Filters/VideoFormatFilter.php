<?php

namespace App\Orchid\Filters;

use App\Models\VideoFormat;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class VideoFormatFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Video Format';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [
            'videoFormats'
        ];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        $videoFormats = $this->request->get('videoFormats');

        return $builder
            ->whereHas('videoFormats', function (Builder $query) use ($videoFormats) {
                $query->whereIn('id', $videoFormats);
            });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('videoFormats')
                ->fromModel(VideoFormat::class, 'name')
                ->multiple()
                ->title('Video Formats'),
        ];
    }
}

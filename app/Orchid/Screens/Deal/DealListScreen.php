<?php

namespace App\Orchid\Screens\Deal;

use App\Models\Deal;
use App\Models\User;
use App\Models\VideoFormat;
use App\Orchid\Filters\VideoFormatFilter;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTime;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DealListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'deals' => Deal::with(['user', 'videoFormats'])
            ->filtersApply([
                VideoFormatFilter::class,
            ])
            ->filters()
            ->latest()
            ->paginate(20),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Deals';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {

        return [
            Layout::selection([
                VideoFormatFilter::class,
            ]),
            //Layout::m
            Layout::table('deals', [
                TD::make('id', 'ID')->filter(),
                TD::make('name', 'Name')->filter(),
                TD::make('created_at', 'Created')
                    ->filter(TD::FILTER_DATE_RANGE)
                    ->usingComponent(DateTime::class,
                        format: 'Y-m-d H:i:s',
                        tz:'UTC'
                    ),
                TD::make('updated_at', 'Updated')
                    ->filter(TD::FILTER_DATE_RANGE)
                    ->usingComponent(DateTime::class,
                        format: 'Y-m-d H:i:s',
                        tz:'UTC'
                    ),
                TD::make('user', 'User')
                    ->filter(TD::FILTER_SELECT)
                    ->filterOptions(User::all()->mapWithKeys(fn(User $user) => [$user->id => $user->name]))
                    ->render(fn(Deal $deal) =>
                        Link::make($deal->user->name)->route('platform.index')
                    )
                ,
                TD::make('videoFormats', 'Video Formats')
                    ->filter(TD::FILTER_SELECT)
                    ->filterOptions(VideoFormat::all()->mapWithKeys(fn(VideoFormat $format) => [$format->id => $format->name]))
                    ->render(fn(Deal $deal) => $deal->videoFormats->pluck('name')->implode(', ') )
                ,
            ]),
        ];
    }
}

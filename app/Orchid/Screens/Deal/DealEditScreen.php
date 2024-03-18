<?php

namespace App\Orchid\Screens\Deal;

use App\Models\Deal;
use App\Models\VideoFormat;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DealEditScreen extends Screen
{
    protected ?Deal $deal = null;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Deal $deal): iterable
    {
        $this->deal = $deal;

        return [
            'deal' => $deal,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return sprintf('Edit "%s" deal', $this->deal?->name ?? '');
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
            Layout::rows([
                Input::make('deal.name')
                    ->type('text')
                    ->title('Name:'),

                Select::make('deal.videoFormats')
                    ->fromModel(VideoFormat::class, 'name')
                    ->multiple(),

                Quill::make('deal.content')
                    ->title('Content:'),

                Button::make('Save')
                    ->class('btn btn-primary')
                    ->method('save'),
            ]),
        ];
    }

    public function save(Request $request, Deal $deal): void {
        $request->validate([
            'deal.name' => 'required|max:50',
            'deal.content' => 'required',
            'deal.videoFormats' => 'required',
        ]);

        $deal->name = $request->input('deal.name');
        $deal->content = $request->input('deal.content');

        $deal->save();

        $deal->videoFormats()->sync($request->input('deal.videoFormats'));
    }
}

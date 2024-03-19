<?php

namespace App\Orchid\Screens\Deal;

use App\Models\Deal;
use App\Models\VideoFormat;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
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
                    ->title('Video Formats:')
                    ->fromModel(VideoFormat::class, 'name')
                    ->multiple(),

                Quill::make('deal.content')
                    ->title('Content:'),

                Picture::make('deal.thumbnail_id')
                    ->title('Thumbnail:')
                    ->storage('public')
                    ->maxFileSize(5)
                    ->groups('thumbnails')
                    ->targetId(),


                Upload::make('deal.documents')
                    ->title('Documents:')
                    ->storage('public')
                    ->maxFileSize(10)
                    ->parallelUploads(5)
                    ->maxFiles(5)
                    ->groups('documents')
                    ->acceptedFiles('application/pdf'),

                Upload::make('deal.images')
                    ->title('Images:')
                    ->storage('public')
                    ->maxFileSize(10)
                    ->parallelUploads(5)
                    ->maxFiles(5)
                    ->groups('images')
                    ->acceptedFiles('image/*'),

                Upload::make('deal.attachment')
                    ->title('Attachments:')
                    ->storage('public')
                    ->maxFileSize(10)
                    ->parallelUploads(5)
                    ->maxFiles(5)
                    ->groups('attachments')
                    ->acceptedFiles('application/pdf,image/*'),


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
        $deal->thumbnail_id = $request->input('deal.thumbnail_id');

        $deal->save();

        $deal->videoFormats()->sync($request->input('deal.videoFormats'));

        $deal->documents()->syncWithoutDetaching($request->input('deal.documents', []));
        $deal->images()->syncWithoutDetaching($request->input('deal.images', []));
        $deal->attachment()->syncWithoutDetaching($request->input('deal.attachment', []));
    }
}

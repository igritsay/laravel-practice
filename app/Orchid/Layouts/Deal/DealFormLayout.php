<?php

namespace App\Orchid\Layouts\Deal;

use App\Models\VideoFormat;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class DealFormLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * @var string|null
     */
    protected $prefix;

    /**
     * ReusableEditLayout constructor.
     *
     * @param string $prefix
     * @param string $title
     */
    public function __construct(string $prefix, string $title = null)
    {
        $this->prefix = $prefix;
        $this->title = $title;
    }

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make($this->prefix . '.name')
                ->type('text')
                ->title('Name:'),

            Select::make($this->prefix . '.videoFormats')
                ->title('Video Formats:')
                ->fromModel(VideoFormat::class, 'name')
                ->multiple(),

            Quill::make($this->prefix . '.content')
                ->title('Content:'),

            Picture::make($this->prefix . '.thumbnail_id')
                ->title('Thumbnail:')
                ->storage('public')
                ->maxFileSize(5)
                ->groups('thumbnails')
                ->targetId(),


            Upload::make($this->prefix . '.documents')
                ->title('Documents:')
                ->storage('public')
                ->maxFileSize(10)
                ->parallelUploads(5)
                ->maxFiles(5)
                ->groups('documents')
                ->acceptedFiles('application/pdf'),

            Upload::make($this->prefix . '.images')
                ->title('Images:')
                ->storage('public')
                ->maxFileSize(10)
                ->parallelUploads(5)
                ->maxFiles(5)
                ->groups('images')
                ->acceptedFiles('image/*'),

            Upload::make($this->prefix . '.attachment')
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
        ];
    }
}

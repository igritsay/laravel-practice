<?php

namespace App\Livewire;

use App\Models\Deal;
use App\Models\VideoFormat;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class DealsList extends Component
{
    public $search = '';
    public $videoFormats = [];

    public function render()
    {
        $query = Deal::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        if ($this->videoFormats) {
            $query->whereHas('videoFormats', function (Builder $query) {
                $query->whereIn('id', $this->videoFormats);
            });
        }

        $dealsList = $query->get();

        $allVideoFormats = VideoFormat::all();

        return view('livewire.deals-list', [
            'dealsList' => $dealsList,
            'allVideoFormats' => $allVideoFormats,
        ]);
    }

    public function clear()
    {
        $this->search = '';
        $this->videoFormats = [];
    }

    public function delete(Deal $deal)
    {
        $deal->delete();
    }
}

<?php

namespace App\View\Components;

use App\Models\Deal;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class DealsList extends Component
{
    public Collection $deals;
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->deals = Deal::all();
        $this->title = '!!!!!!!!!';
    }

    public function userList(): Collection
    {
        return User::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.deals-list');
    }
}

<?php

namespace App\Orchid\Screens\Deal;

use App\Models\Deal;
use App\Orchid\Layouts\Deal\DealFormLayout;
use Orchid\Screen\Screen;

class DealEditScreen extends Screen
{
    use SaveDeal;

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
            new DealFormLayout('deal'),
        ];
    }
}

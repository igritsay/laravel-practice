<?php

namespace App\Orchid\Screens\Deal;

use App\Models\Deal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait SaveDeal
{
    public function save(Request $request, Deal $deal = null): RedirectResponse {
        $request->validate([
            'deal.name' => 'required|max:50',
            'deal.content' => 'required',
            'deal.videoFormats' => 'required',
        ]);

        $deal = $deal ?? new Deal();

        $deal->name = $request->input('deal.name');
        $deal->content = $request->input('deal.content');
        $deal->thumbnail_id = $request->input('deal.thumbnail_id');

        $deal->save();

        $deal->videoFormats()->sync($request->input('deal.videoFormats'));

        $deal->documents()->syncWithoutDetaching($request->input('deal.documents', []));
        $deal->images()->syncWithoutDetaching($request->input('deal.images', []));
        $deal->attachment()->syncWithoutDetaching($request->input('deal.attachment', []));


        return redirect()->route('admin.deal.edit', ['deal' => $deal->id ]);
    }
}

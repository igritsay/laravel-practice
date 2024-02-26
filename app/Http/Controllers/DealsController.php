<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\View\View;
use function Laravel\Prompts\search;
use function Laravel\Prompts\table;

class DealsController extends Controller
{
    public function deals(Request $request)
    {
//        Deal::all();

//        $deals = Deal::where('name', 'like', 'M%')
//            ->get()
//            ->pluck('name')
//            ->toArray();

//        $deals = Deal::where('name', 'like', 'M%')
//            ->orderBy('name', 'ASC')
//            ->limit(10)
//            ->get()->toArray();

//        dump($deals);

//        $deal = Deal::create([
//            'name' => 'Test Name',
//            'content' => 'Test Content',
//        ]);
//
//        dump($deal);

        $users = User::with(['address', 'deals'])->get();

//        foreach ($users as $user) {
//            $user->deals;
//            $user->address->street;
//        }

//        $users = User::with(['deals'])->get();
//
//        dump($users[0]->deals()->get());

//        return $users;

        return view('welcome', [
            'deals' => [],
            'users' => $users,
        ]);
    }
}

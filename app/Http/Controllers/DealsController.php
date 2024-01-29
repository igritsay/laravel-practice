<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DealsController extends Controller
{
    public function deals(): View
    {
//        $deals = DB::table('deals')
//            ->where('name', 'Mayra Sawayn')->first();
            //->update(['content' =>'Test']);


//        $deals = Deal::where('name', 'like', 'M%')
//            ->orderBy('name', 'ASC')
//            ->limit(10)
//            ->get()->toArray();

//        dd($deals);


//        $deal = Deal::where('id', 1)->firstOrFail();
//
//        $deal->name = 'Test Name';
//        $deal->save();

//        $users = User::with(['deals'])->get();
//
//        dump($users[0]->deals()->get());


        return view('welcome', [
            'deals' => [],
            'users' => [],
        ]);
    }
}

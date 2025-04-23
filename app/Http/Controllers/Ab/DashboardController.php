<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $user = auth()->user();

        $getUserStores = Store::where('user_id', $user->id)
            ->withCount('products')
            ->orderBy('id', 'desc')
            ->get();

        return view('ab.dashboard.index', compact('getUserStores', 'user'));
    }
}

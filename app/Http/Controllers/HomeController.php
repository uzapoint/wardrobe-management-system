<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserClothe;
use Illuminate\Http\Request;
use App\Models\UserClothType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userClothes = UserClothe::whereUserId(Auth::id())->get();
        $userClothTypes = UserClothType::whereUserId(Auth::id())->get();

        return view('portal.index', ['userClothes' => $userClothes, 'userClothTypes' => $userClothTypes]);
    }
}

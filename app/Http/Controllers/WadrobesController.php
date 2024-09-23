<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\WadrobeResource;
use App\Models\Wadrobes;
use Illuminate\Support\Facades\Log;

class WadrobesController extends Controller
{
    public function index(Request $req)
    {
        Log::info($req->all());
        $user_id = $req->user_id;
        $wadrobes = Wadrobes::where('user_id', $user_id)->paginate(10) ?? null;

        return WadrobeResource::collection($wadrobes);
    }
}

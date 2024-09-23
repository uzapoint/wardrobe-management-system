<?php

namespace App\Http\Controllers;

use App\Http\Resources\WadrobeCategoryResource;
use App\Models\WadrobeClothingCategory;
use App\Models\Wadrobes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WadrobesCategoriesController extends Controller
{
    public function index(Request $req)
    {
        Log::info($req->all());
        $wadrobe_id = $req->wadrobe_id;
        $wadrobes = WadrobeClothingCategory::where('wadrobe_id', $wadrobe_id)->paginate(10) ?? null;

        return WadrobeCategoryResource::collection($wadrobes);
    }
}

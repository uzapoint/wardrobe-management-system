<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Item::class);

        $items = Item::query()->whereRelation('users', 'id', $request->user()->id)->when(!is_null($request->query('name')), function (Builder $query) use ($request) {
            $query->where('name', 'like', "%{$request->query('name')}%");
        })->when(!is_null($request->query('category')), function (Builder $query) use ($request) {
            $query->where("category", $request->query('category'));
        })->when(!is_null($request->query('size')), function (Builder $query) use ($request) {
            $query->where("size", $request->query('size`'));
        })->when(!is_null($request->query('color')), function (Builder $query) use ($request) {
            $query->where("color", $request->query('color'));
        })->orderBy('updated_at', 'DESC');

        return new ItemResource($items->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $this->authorize("create", Item::class);

        $validated = $request->validated();

        $item = Item::create($validated);

        if ($request->file('image')) {
            $item->addMediaFromRequest('image')->toMediaCollection();
        }

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $this->authorize("view", $item);
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize("update", $item);

        $validated = $request->validated();

        if ($request->file('image')) {
            $item->clearMediaCollection();
            $item->addMediaFromRequest('image')->toMediaCollection();
        }

        $item->update($validated);

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize("delete", $item);

        $item->delete();

        return response(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->items as $item)
        {
            Item::create($request->all() + [
                'name' => $item
            ]);
        }
        return response()->json(['message' => 'Items added']);
    }

    public function delete($id)
    {
        Item::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed']);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return response()->json(['message' => 'Item updated', 'item' => $item]);
    }
}

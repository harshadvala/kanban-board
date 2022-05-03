<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function save(Request $request)
    {
        $card = null;
        if ($request->get('id')) {
            $card = Card::find($request->get('id'));
        }

        if (!$card) {
            $card = new Card();
        }
        $card->fill($request->all());
        $card->save();

        return response()->json(['status' => 1, 'message' => 'Success', 'data' => $card]);
    }

    public function delete($id)
    {
        Card::where('id', $id)->delete();

        return response()->json(['status' => 1, 'message' => 'Success']);
    }
}

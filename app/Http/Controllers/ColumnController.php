<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ColumnController extends Controller
{
    public function index()
    {
        $columns = Column::with(['cards'])->get();

        return response()->json($columns);
    }

    public function get($id)
    {
        $columns = Column::with(['cards'])->find($id);

        return response()->json($columns);
    }

    public function create(Request $request)
    {
        $column = new Column();
        $column->fill($request->all());
        $column->save();

        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function delete($id)
    {
        Column::where('id', $id)->delete();
        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function updateSequences(Request $request)
    {
        $columns = $request->all();
        if (is_array($columns) && count($columns) > 0) {
            foreach ($columns as $column) {
                if (isset($column['cards']) && $column['cards']) {
                    foreach ($column['cards'] as $cardIn => $card) {
                        Card::where('id', $card['id'])->update(
                            [
                                'column_id' => $column['id'],
                                'seq' => $cardIn
                            ]);
                    }
                }
            }
        }
        return response()->json(['status' => 1, 'message' => 'success']);
    }
}

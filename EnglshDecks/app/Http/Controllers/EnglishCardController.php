<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnglishCardController extends Controller
{

    public function cards(Request $request, $id)
    {
        $items = DB::table('cards')->where('deck_id', $id)->get();
        return view('groups.cards', ['items' => $items, 'id' => $id]);
    }


    public function updatecard(Request $request, $deck_id, $card_id)
    {
        DB::table('cards')->where('id', $card_id)->update(
            array(
                'name' => $request->get('name'),
                'translate' => $request->get('translate'),
                'tense' => $request->get('tense'),
            )
        );
        $items = DB::table('cards')->where('deck_id', $deck_id)->get();

        return view('groups.cards', ['items' => $items, 'id' => $deck_id]);
    }

    public function newcard(Request $request, $id)
    {
        $exist = DB::table('cards')->where('name', $request->get('name'))->exists();
        if ($exist){
            return view('new.card', ['error' => 'This card already exist', 'id' => $id]);
        }
        DB::table('cards')->insert(
            array(
                'name' => $request->get('name'),
                'translate' => $request->get('translate'),
                'tense' => $request->get('tense'),
                'deck_id' => $id,
                'created_at' => now()
            )
        );
        return view('groups.cards', ['items' => DB::table('cards')->where('deck_id', $id)->get(), 'id' => $id]);
    }

    public function show_form_new_card($id)
    {
        return view('new.card', ['id' => $id]);
    }

    public function show_form_edit_card($id)
    {
        $item = DB::table('cards')->where('id', $id)->first();
        return view('edit.card', ['item' => $item]);
    }
}

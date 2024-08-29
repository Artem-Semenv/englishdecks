<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnglishDecksController extends Controller
{
    public function newdeck(Request $request)
    {
        $exist = DB::table('decks')->where('name', $request->get('name'))->exists();
        if ($exist) {
            return view('new.deck', ['error' => 'This deck already exist']);
        }
        DB::table('decks')->insert(array('name' => $request->get('name')));
        return view('groups.decks', ['items' => Deck::all()]);
    }

    public function deck(Request $request)
    {
        return view('groups.decks', ['items' => Deck::all()]);
    }

    public function deletedeck($id)
    {
        DB::table('decks')->where('id', $id)->delete();
        DB::table('cards')->where('deck_id', $id)->delete();
        return redirect('/decks');
    }

    public function updatedeck(Request $request, $id)
    {
        DB::table('decks')->where('id', $id)->update(
            array(
                'name' => $request->get('name')
            )
        );
        return redirect('/decks');
    }
}

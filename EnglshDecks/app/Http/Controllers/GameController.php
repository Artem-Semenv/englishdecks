<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function game( $id)
    {
        $cards = DB::table('cards')->where('deck_id', $id)->get();
        $weightedCards = [];

        foreach ($cards as $card) {
            $weight = 6 - $card->importantly;

            for ($i = 0; $i < $weight; $i++) {
                $weightedCards[] = $card;
            }
        }
        $deck = [];
        for ($i = 0; $i < 10; $i++) {
            $randomCard = $weightedCards[array_rand($weightedCards)];
            $deck[] = $randomCard;

            $index = array_search($randomCard, $weightedCards);
            if ($index !== false) {
                unset($weightedCards[$index]);
                $weightedCards = array_values($weightedCards);
            }
        }

        return view('game', ['items' => $deck, 'id' => $id]);
    }

    public function finish(Request $request, $id){
        $responses = json_decode($request->get('responses'), true);


        foreach ($responses as $word => $status) {
            $item = DB::table('cards')->where('name', $word)->first();
            if ($status == "know" && $item->importantly != 5){
                    DB::table('cards')->update(
                        array(
                            'importantly' => $item->importantly + 1
                        )
                    );
            }elseif ($status == "unknow" && $item->importantly != 1){
                DB::table('cards')->update(
                    array(
                        'importantly' => $item->importantly - 1
                    )
                );
            }

        }

        return redirect('/deck/'.$id.'/cards');
    }
}

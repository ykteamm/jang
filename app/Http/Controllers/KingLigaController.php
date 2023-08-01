<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KingLigaController extends Controller
{
    public function incKingLiga($yes)
    {
        try {
            if($yes == 1) {
                $userLiga = DB::table('user_king_liga')->where('user_id', Auth::id())->first();
                if(($userLiga->king_liga_id - 1) >= 1) {
                    DB::table('user_king_liga')->where('user_id', Auth::id())->update([
                        'king_liga_id' => $userLiga->king_liga_id - 1,
                        'inc' => false
                    ]);
                }
            } else {
                DB::table('user_king_liga')->where('user_id', Auth::id())->update([
                    'inc' => false
                ]);
            }
            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }
}

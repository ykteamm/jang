<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsLikeController extends Controller
{
    public function getAllNews()
    {
        $news = News::with([
        'emojies' => function($q) {
            $q->selectRaw('ne.icon, ne.id, count(ne.id) as count, news_reactions.news_id')
            ->leftJoin('news_emojies AS ne', 'ne.id', 'news_reactions.emoji_id')
            ->groupBy('ne.id', 'news_reactions.news_id')
            ->orderBy('ne.id', "ASC");
        },
        'shows' => function ($q) {
            return $q->selectRaw('count(id) as show, news_id')
            ->groupBy('news_id');
        }])
        ->where('publish', true)
        ->orderBy('id', "DESC")
        ->get();

        
        return $news;
    }

    public function getEmojies($id)
    {
        return DB::table('news_emojies AS ne')
            ->select('ne.icon', 'ne.id', DB::raw("count(ne.id) as count"))
            ->leftJoin('news_reactions AS nr', 'nr.emoji_id', 'ne.id')
            ->leftJoin('news AS nw', 'nw.id', 'nr.news_id')
            ->where('nw.id', $id)
            ->groupBy('ne.id')
            ->orderBy('ne.id', "ASC")
            ->get();
    }

    // public function like($id)
    // {
    //     try {
    //         $news = News::find($id);
    //         $like = NewsLike::where('news_id', $id)
    //             ->where('user_id', Auth::id())
    //             ->where('positive', true)
    //             ->first();
    //         $dislike = NewsLike::where('news_id', $id)
    //             ->where('user_id', Auth::id())
    //             ->where('positive', false)
    //             ->first();
    //         if ($like) {
    //             $this->delete($id, true);
    //             $news->like = $news->like - 1;
    //         } else {
    //             if ($dislike) {
    //                 $this->delete($id, false);
    //                 $news->dislike = $news->dislike - 1;
    //             }
    //             $this->create($id, true);
    //             $news->like = $news->like + 1;
    //         }
    //         $news->save();
    //         return response()->json($news);
    //     } catch (\Throwable $th) {
    //         return response()->json($th->getMessage());
    //     }
    // }

    // public function dislike($id)
    // {
    //     try {
    //         $news = News::find($id);
    //         $like = NewsLike::where('news_id', $id)
    //             ->where('user_id', Auth::id())
    //             ->where('positive', true)
    //             ->first();
    //         $dislike = NewsLike::where('news_id', $id)
    //             ->where('user_id', Auth::id())
    //             ->where('positive', false)
    //             ->first();
    //         if ($dislike) {
    //             $this->delete($id, false);
    //             $news->dislike = $news->dislike - 1;
    //         } else {
    //             if ($like) {
    //                 $this->delete($id, true);
    //                 $news->like = $news->like - 1;
    //             }
    //             $this->create($id, false);
    //             $news->dislike = $news->dislike + 1;

    //         }
    //         $news->save();
    //         return response()->json($news);
    //     } catch (\Throwable $th) {
    //         return response()->json($th->getMessage());
    //     }
    // }

    // private function delete($id, $positive)
    // {
    //     NewsLike::where('news_id', $id)
    //         ->where('user_id', Auth::id())
    //         ->where('positive', $positive)
    //         ->delete();
    // }

    // private function create($id, $positive)
    // {
    //     return NewsLike::create([
    //         'user_id' => Auth::id(),
    //         'news_id' => $id,
    //         'positive' => $positive
    //     ]);
    // }
}

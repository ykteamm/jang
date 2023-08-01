<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            return auth()->user()->unreadNotifications()->count();  
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
    
    public function read($id)
    {
        try {
            $notif = auth()->user()->notifications()->where('data->id', $id)->first();
            if($notif){
                auth()->user()->notifications()->find($notif->id)->markAsRead();
            }
            return auth()->user()->unreadNotifications()->count();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function readAll()
    {
        try {
            return auth()->user()->notifications->markAsRead();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            return auth()->user()->notifications()->find($id)->delete();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }


    public function destroyAll()
    {
        try {
            return auth()->user()->notifications()->delete();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}

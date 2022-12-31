<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Notifications\MessageSent;
use App\Models\Notifications;

class Notifications_Coontroller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function notify(){
        return view('notifications.index', [
            'unreadNotifications' => auth()->user()->unreadNotifications,
            'readNotifications' => auth()->user()->readNotifications
        ]);
    }

    public function read($id){
        DatabaseNotification::find($id)->markAsRead();
        return back()->with(';)', 'Read Notification');
    }

    public function destroy($id){
        DatabaseNotification::find($id)->delete();
        return back()->with('flash', 'Deleted Notification');
    }

}
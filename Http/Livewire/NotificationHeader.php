<?php

namespace Modules\CentreNotification\Http\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationHeader extends Component
{


    public function redirectNotif($notif_id){
        $notification = DatabaseNotification::find($notif_id);
        $notification->markAsRead();

        return redirect($notification->data['url'] ?? '');
    }

    public function markAsRead($notif_id){
        $notification = DatabaseNotification::find($notif_id);
        $notification->markAsRead();
    }

    public function markAllRead(){
        Auth::user()->unreadNotifications->markAsRead();
    }


    /**
     * Get the views / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $notifications = Auth::user()->unreadNotifications;

        return view('centrenotification::livewire.notification-header', compact('notifications'));
    }
}

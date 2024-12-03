<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Mark all notifications as read.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead()
    {
        // Clear all notifications
        Notification::truncate();

        return redirect()->back()->with('message', 'All notifications marked as read!');
    }
}

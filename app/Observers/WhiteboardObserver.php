<?php

namespace App\Observers;

use App\Models\Whiteboard;
use Illuminate\Support\Facades\Auth;

class WhiteboardObserver
{

    public function creating(Whiteboard $whiteboard)
    {
        $whiteboard->created_by = Auth::id();
        $whiteboard->updated_by = Auth::id();
    }

    public function updating(Whiteboard $whiteboard)
    {
        $whiteboard->updated_by = Auth::id();
    }
    /**
     * Handle the Whiteboard "created" event.
     */
    public function created(Whiteboard $whiteboard): void
    {
        //
    }

    /**
     * Handle the Whiteboard "updated" event.
     */
    public function updated(Whiteboard $whiteboard): void
    {
        //
    }

    /**
     * Handle the Whiteboard "deleted" event.
     */
    public function deleted(Whiteboard $whiteboard): void
    {
        //
    }

    /**
     * Handle the Whiteboard "restored" event.
     */
    public function restored(Whiteboard $whiteboard): void
    {
        //
    }

    /**
     * Handle the Whiteboard "force deleted" event.
     */
    public function forceDeleted(Whiteboard $whiteboard): void
    {
        //
    }
}

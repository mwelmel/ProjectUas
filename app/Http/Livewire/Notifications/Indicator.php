<?php

namespace App\Http\Livewire\notications;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class Indicator extends Component
{
    public $hasNotifications;

    protected $listeners = [
        'markedAsRead' => 'setHasNotification',
    ];

    public function render(): view
    {
        $this->hasNotifications = $this->setHasNotification(
            Auth::user()->unreadNotifications()->count()
        );

        return view('livewire.notifications.indicator', [
            'hasNotification' => $this->hasNotification,
        ]);
    }

    public function setHasNotification(int $count): bool
    {
        return $count > 0;
    }
}
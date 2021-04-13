<?php

namespace Stats4sd\KoboLink\Events;

use Stats4sd\KoboLink\Models\Xlsform;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class KoboUploadReturnedError implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Xlsform $form;
    public string $errorType;
    public string $errorMessage;


    /**
     * Create a new event instance
     *
     * @param User $user
     * @param Xlsform $form
     * @param String $errorType
     * @param String $errorMessage
     */
    public function __construct(User $user, Xlsform $form, string $errorType, string $errorMessage)
    {
        $this->user = $user;
        $this->form = $form;
        $this->errorType = $errorType;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel("App.User.{$this->user->id}");
    }
}
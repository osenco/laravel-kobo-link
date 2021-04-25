<?php

namespace Stats4sd\KoboLink\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Stats4sd\KoboLink\Models\TeamXlsform;

class KoboGetDataReturnedSuccess implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public User $user;
    public TeamXlsform $form;
    public int $count;
    /**
     * Create a new event instance.
     * @param User $user
     * @param TeamXlsform $form
     * @return void
     */
    public function __construct(User $user, TeamXlsform $form, int $count)
    {
        $this->user = $user;
        $this->form = $form;
        $this->count = $count;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel("App.Models.User.{$this->user->id}");
    }
}

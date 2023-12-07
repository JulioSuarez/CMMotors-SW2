<?php

namespace App\Events;

use App\Models\Producto;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Database\Eloquent\Model;

class DisminuyendoCandtidadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $producto;
    public $cantidadActual;
    public $cantidadRestar;
    public function __construct(Producto $pro, int $cant_restar)
    {
        $this->producto = $pro->id;
        $this->cantidadActual = $pro->cantidad;
        $this->cantidadRestar = $cant_restar;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

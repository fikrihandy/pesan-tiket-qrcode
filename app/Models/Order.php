<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'ticket_category',
        'quantity',
        'payment_method',
    ];

    // Relasi ke model Game dan Ticket
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

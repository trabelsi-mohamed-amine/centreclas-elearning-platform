<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_message',
        'bot_response',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationParticipants extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $fillable = ['conversation_id','recipient_id','type','users_id'];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Leads;
use App\Models\ConversationParticipants;

class Conversation extends Model
{
    use HasFactory;
    protected $table = 'conversation';
    protected $fillable = ['lead_id','type_id','status','tx_id','recipient_id'];


    public function lead(){
        return $this->hasOne(Leads::class,'id','lead_id');
    }
    public function particpant(){
        return $this->hasOne(ConversationParticipants::class,'id','conversation_id');
    }
}

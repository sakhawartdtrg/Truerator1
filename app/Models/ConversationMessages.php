<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Leads;
use App\Models\User;
class ConversationMessages extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = ['conversation_id','sender_id','message_type','message'];

    public function lead(){
        return $this->hasOne(Leads::class,'id','lead_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','sender_id');
    }
}

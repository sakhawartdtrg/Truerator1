<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ReviewChannels extends Model
{
    use HasFactory,Userstamps;

    protected $table = 'review_channels';

    protected $fillable = ['name','relation_id'];
}

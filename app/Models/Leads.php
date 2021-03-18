<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Leads extends Model
{
    use HasFactory;
    use Userstamps;
    protected $table = 'leads';

    protected $fillable = ['tx_id','name','email','relation_id','cell_no','type_id'];
    
}

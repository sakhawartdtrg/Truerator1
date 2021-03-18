<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LeadSources extends Model
{
    use HasFactory;
    use Userstamps;
    protected $table = 'lead_sources';

    
}

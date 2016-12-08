<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class contract extends Model
{

    public function Agency()
    {
        return $this->belongsTo("Digi\Models\agency");
    }
    
}
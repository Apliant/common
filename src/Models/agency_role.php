<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agency_role extends Model
{
    protected $table = "agency_role";
    public $timestamps = false;

    public function Agency()
    {
    	return $this->belongsTo('Digi\Models\agency');
    }
    public function Role()
    {
    	return $this->hasOne('Digi\Models\role');
    }
}
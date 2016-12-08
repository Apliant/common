<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agent_role extends Model
{
    protected $table = "agent_role";
    public $timestamps = false;

    public function Agent()
    {
    	return $this->belongsTo('Digi\Models\agent');
    }
    public function Role()
    {
    	return $this->hasOne('Digi\Models\role');
    }
}
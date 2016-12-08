<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
	protected $fillable = array("agent_id", "lead_id", "lead_name", "task", "comment", "fulfilled", "notified", "task_date");
    public function Agent()
    {
    	return $this->belongsTo("Digi\Models\agent");
    }

    public function Lead()
    {
    	return $this->belongsTo("Digi\Models\lead");
    }
    public function Task()
    {
    	return $this->hasOne('Digi\Models\enumeration', 'id', 'task');
    }
    public function Source()
    {
    	return $this->hasOne('Digi\Models\enumeration', 'id', 'source');
    }
}
?>
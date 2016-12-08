<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;
use Log;


class role extends Model
{
	public $timestamps = false;

	public function Agents()
	{
		return $this->belongsToMany("Digi\Models\agent");
	}

	public function ChildRoles()
	{
		return $this->belongsToMany("Digi\Models\\role", "role_hierarchy", "parent_role_id", "child_role_id");
	}

	public function ParentRoles()
	{
		return $this->belongsToMany("Digi\Models\\role", "role_hierarchy", "child_role_id", "parent_role_id");
	}

	public function hasRole($roleName)
	{
		if($this->role_name == $roleName)
		{
			return true;
		}
		$childRoles = $this->ChildRoles;
		foreach($childRoles as $child)
		{
			if($child->hasRole($roleName))
			{
				return true;
			}
		}

		return false;
	}
}

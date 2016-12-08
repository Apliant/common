<?php

namespace Digi\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class agent extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['agent_first_name', 'agent_middle_name', 'agent_last_name', 'email', 'password', 'agency_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    protected $hidden = ['password', 'remember_token'];
    public function Agency()
    {
        return $this->belongsTo("Digi\Models\agency");
    }

    public function Contacts()
    {
        return $this->hasMany("Digi\Models\contact");
    }

    public function Leads()
    {
        return $this->hasMany("Digi\Models\lead");
    }

    public function Roles()
    {
        return $this->belongsToMany("Digi\Models\\role");
    }

    public function States()
    {
        return $this->belongsToMany("Digi\Models\state", 'agent_carrier_states', 'agent_id', 'state_id');
    }

    public function Carriers()
    {
        return $this->belongsToMany("Digi\Models\carrier");
    }

    public function RecentContacts()
    {
        return $this->hasMany("Digi\Models\\recent_contact");
    }

    public function hasRole($roleName)
    {
        $roles = $this->Roles;
        foreach($roles as $role)
        {
            if($role->hasRole($roleName))
            {
                return true;
            }
        }
        
        return false;
    }

    public function addRole($roleName)
    {
        if(!$this->hasRole($roleName))
        {
            $role = role::where("role_name", "=", $roleName)->first();
            $agentRole = new agent_role;
            $agentRole->agent_id = $this->id;
            $agentRole->role_id = $role->id;
            $agentRole->save();
        }

    }

    public function removeRole($roleName)
    {
        if($this->hasRole($roleName))
        {
            $role = role::where("role_name", "=", $roleName)->first();
            $agentRole = agent_role::where(["agent_id" => $this->id, "role_id" => $role->id])->firstOrFail();
            $agentRole->delete();
        }
    }
}
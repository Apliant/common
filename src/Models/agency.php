<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class agency extends Model implements BillableContract
{
  use Billable;
  protected $dates = ['trial_ends_at', 'subscription_ends_at'];

  public function Agents()
  {
    return $this->hasMany("Digi\Models\agent");
  }

  public function Carriers()
  {
    return $this->belongsToMany("Digi\Models\carrier", "argency_carriers");
  }

  public function Markets()
  {
    return $this->belongsToMany("Digi\Models\market", "agency_markets");
  }

  public function Contact()
  {
    return $this->hasOne("Digi\Models\contact");
  }
}

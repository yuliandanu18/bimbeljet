<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LeadFollowup extends Model {
    protected $fillable = ['lead_id','note','outcome','followup_at','created_by'];
    protected $casts = ['followup_at'=>'datetime'];
    public function lead(){ return $this->belongsTo(Lead::class); }
}

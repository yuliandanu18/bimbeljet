<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model {
    protected $fillable = ['name','phone','source','interest_subjects','status','owner_id','branch_id','next_action_at','notes'];
    protected $casts = [
        'interest_subjects' => 'array',
        'next_action_at' => 'datetime',
    ];
    public function owner(){ return $this->belongsTo(User::class, 'owner_id'); }
    public function branch(){ return $this->belongsTo(Branch::class); }
    public function followups(){ return $this->hasMany(LeadFollowup::class); }
}

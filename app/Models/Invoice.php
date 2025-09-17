<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Invoice extends Model {
    protected $fillable = ['student_id','enrollment_id','amount','due_date','status','branch_id'];
    protected $casts = ['due_date'=>'date'];
    public function enrollment(){ return $this->belongsTo(Enrollment::class); }
    public function payments(){ return $this->hasMany(\App\Models\Payment::class); }

}

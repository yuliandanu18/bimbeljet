<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model {
    protected $fillable = ['student_id','class_id','package_id','sales_id','start_at','end_at','status'];

    public function student(){ return $this->belongsTo(Student::class); }
    public function class(){ return $this->belongsTo(ClassRoom::class,'class_id'); }
    public function invoices(){ return $this->hasMany(Invoice::class); }
    public function attendances(){ return $this->hasMany(Attendance::class); }
}

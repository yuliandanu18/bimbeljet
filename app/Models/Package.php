<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Package extends Model {
    protected $fillable = ['name','subject','meetings','minutes_per_meeting','price','allow_installment','branch_id'];
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
  protected $fillable = [
    'invoice_id','method','status','paid_at','amount','ref',
    'bank_name','bank_ref','proof_path','verified_by','verified_at','notes'
  ];
  protected $casts = ['paid_at'=>'datetime','verified_at'=>'datetime'];
  public function invoice(){ return $this->belongsTo(Invoice::class); }
  public function verifier(){ return $this->belongsTo(User::class, 'verified_by'); }
}

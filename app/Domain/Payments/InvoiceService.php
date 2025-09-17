<?php
namespace App\Domain\Payments;
use App\Models\{Enrollment, Invoice};

class InvoiceService {
  public static function forEnrollment(Enrollment $e){ return new static($e); }
  public function __construct(private Enrollment $e){}
  public function createInitialInvoice(){
    $amount = optional($this->e->package)->price ?? 0;
    return Invoice::create([
      'student_id'=>$this->e->student_id,
      'enrollment_id'=>$this->e->id,
      'amount'=>$amount,
      'due_date'=>now()->addDays(7),
      'branch_id'=>optional($this->e->class)->branch_id ?? 1,
    ]);
  }
}

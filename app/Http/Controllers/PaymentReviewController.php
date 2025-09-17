<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Payment, Invoice};

class PaymentReviewController extends Controller
{
    public function index(){
        $pending = Payment::where('status','pending')->latest()->paginate(20);
        $recent = Payment::whereIn('status',['received','rejected'])->latest()->limit(20)->get();
        return view('payments.review.index', compact('pending','recent'));
    }

    public function show(Payment $payment){
        $invoice = Invoice::find($payment->invoice_id);
        return view('payments.review.show', compact('payment','invoice'));
    }

    public function updateStatus(Request $r, Payment $payment){
        $data = $r->validate(['action'=>'required|in:received,rejected,pending,cancelled','notes'=>'nullable|string']);
        $payment->status = $data['action'];
        $payment->verified_by = optional($r->user())->id;
        $payment->verified_at = now();
        if($r->filled('notes')) $payment->notes = $r->string('notes');
        $payment->save();

        $invoice = Invoice::find($payment->invoice_id);
        if ($invoice) {
            $received = Payment::where('invoice_id',$invoice->id)->where('status','received')->sum('amount');
            $invoice->status = $received >= $invoice->amount ? 'paid' : ($received > 0 ? 'partial' : 'unpaid');
            $invoice->save();
        }

        return back()->with('ok','Status pembayaran diperbarui');
    }
}

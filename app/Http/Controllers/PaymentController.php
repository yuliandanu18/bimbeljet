<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $r, Invoice $invoice)
    {
        $data = $r->validate([
            'method'    => 'required|in:cash,transfer,gateway',
            'amount'    => 'required|integer|min:1',
            'ref'       => 'nullable|string|max:100',
            'bank_name' => 'nullable|string|max:50',
            'bank_ref'  => 'nullable|string|max:100',
            'proof'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $status = $data['method'] === 'cash' ? 'received' : 'pending';

        $path = null;
        if ($r->hasFile('proof')) {
            // butuh: php artisan storage:link
            $path = $r->file('proof')->store('payments', 'public');
        }

        Payment::create([
            'invoice_id' => $invoice->id,
            'method'     => $data['method'],
            'status'     => $status,
            'paid_at'    => now(),
            'amount'     => $data['amount'],
            'ref'        => $data['ref'] ?? null,
            'bank_name'  => $data['bank_name'] ?? null,
            'bank_ref'   => $data['bank_ref'] ?? null,
            'proof_path' => $path,
        ]);

        // Hitung ulang status invoice (hanya pembayaran RECEIVED yang dihitung)
        $received = Payment::where('invoice_id', $invoice->id)
            ->where('status', 'received')
            ->sum('amount');

        $invoice->status = $received >= $invoice->amount
            ? 'paid'
            : ($received > 0 ? 'partial' : 'unpaid');

        $invoice->save();

        return back()->with('ok', 'Pembayaran dicatat.');
    }
}

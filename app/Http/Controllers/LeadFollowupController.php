<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Lead, LeadFollowup};

class LeadFollowupController extends Controller
{
    public function store(Request $r, Lead $lead) {
        $data = $r->validate([
            'note'=>'nullable|string',
            'outcome'=>'required|in:scheduled_trial,callback,no_answer,won,lost',
            'followup_at'=>'nullable|date'
        ]);
        $data['created_by'] = $r->user()->id;
        $lead->followups()->create($data);
        $lead->update(['status' => in_array($data['outcome'], ['won','lost']) ? $data['outcome'] : 'contacted']);
        return back()->with('ok','Follow-up tersimpan');
    }
}

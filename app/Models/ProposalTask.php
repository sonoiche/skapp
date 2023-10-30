<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposalTask extends Model
{
    use HasFactory;

    protected $table = "proposal_tasks";
    protected $guarded = [];
    protected $appends = ['due_date_display','completed_date_display'];

    public function getDueDateDisplayAttribute()
    {
        $due_date = $this->attributes['due_date'] ?? '';
        if($due_date) {
            return Carbon::parse($due_date)->format('F d, Y');
        }

        return '';
    }

    public function getCompletedDateDisplayAttribute()
    {
        $date_completed = $this->attributes['date_completed'] ?? '';
        if($date_completed) {
            return Carbon::parse($date_completed)->format('F d, Y');
        }

        return '';
    }

    public function assign()
    {
        return $this->belongsTo(User::class, 'assigned_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalExpense extends Model
{
    use HasFactory;
    
    protected $table = "proposal_expenses";
    protected $guarded = [];
}

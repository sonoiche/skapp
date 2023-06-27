<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCommittee extends Model
{
    use HasFactory;

    protected $table = "group_committees";
    protected $guarded = [];
}

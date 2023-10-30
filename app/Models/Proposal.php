<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    protected $table = "proposals";
    protected $guarded = [];
    protected $appends = ['created_at_display'];

    public function getCreatedAtDisplayAttribute()
    {
        $created_at = $this->attributes['created_at'] ?? '';
        if($created_at) {
            return Carbon::parse($created_at)->format('F d, Y');
        }

        return '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function action()
    {
        return $this->belongsTo(User::class, 'user_action');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";
    protected $guarded = [];
    protected $appends = ['schedule','schedule_from','schedule_to','schedule_input'];

    public function getScheduleAttribute()
    {
        $from   = $this->attributes['date_from'];
        $to     = $this->attributes['date_to'];
        
        if(isset($from) && isset($to)) {
            return Carbon::parse($from)->format('d F Y').' - '.Carbon::parse($to)->format('d F Y');
        }

        return '';
    }

    public function getScheduleFromAttribute()
    {
        $from   = $this->attributes['date_from'];
        if(isset($from)) {
            return explode('-', Carbon::parse($from)->format('M-d-Y'));
        }

        return '';
    }

    public function getScheduleToAttribute()
    {
        $to     = $this->attributes['date_to'];
        if(isset($to)) {
            return explode('-', Carbon::parse($to)->format('M-d-Y'));
        }

        return '';
    }

    public function getScheduleInputAttribute()
    {
        $from   = $this->attributes['date_from'];
        $to     = $this->attributes['date_to'];
        if(isset($from) && isset($to)) {
            return Carbon::parse($from)->format('m/d/Y').' - '.Carbon::parse($to)->format('m/d/Y');
        }

        return Carbon::now()->format('m/d/Y').' - '.Carbon::now()->format('m/d/Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

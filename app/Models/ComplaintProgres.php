<?php

namespace App\Models;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ComplaintProgres extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'complaint_id',
        'status',
        'komentar',
    ];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    // Relasi ke model Complaint
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}

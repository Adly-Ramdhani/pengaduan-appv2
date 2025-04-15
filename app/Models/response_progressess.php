<?php

namespace App\Models;

use App\Models\Reports;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class response_progressess extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'report_id',
        'status',
        'komentar',
    ];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    // Relasi ke model
    public function reports()
    {
        return $this->belongsTo(Reports::class, 'reports_id');
    }
}

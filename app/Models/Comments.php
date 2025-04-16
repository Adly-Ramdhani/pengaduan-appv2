<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reports;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'report_id',
        'user_id',
        'comment',
    ];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function report()
    {
        return $this->belongsTo(Reports::class, 'report_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

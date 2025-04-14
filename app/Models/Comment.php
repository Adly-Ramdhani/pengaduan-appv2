<?php

namespace App\Models;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'complaint_id',
        'user_id',
        'comment',
    ];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

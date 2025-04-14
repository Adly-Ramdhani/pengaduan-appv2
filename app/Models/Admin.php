<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'users';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}

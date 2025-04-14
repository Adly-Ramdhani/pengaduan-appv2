<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Models\Regencis;
use App\Models\Districts;
use App\Models\Regencies;
use Illuminate\Support\Str;
use App\Models\ComplaintLike;
use App\Models\ComplaintProgres;
use App\Models\ComplaintProgress;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    
    public function provinces()
    {
        return $this->belongsTo(Province::class, 'provinces_id');
    }

    public function regencie()
    {
        return $this->belongsTo(Regencis::class, 'regencis_id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'districts_id');
    }


    public function village()
    {
        return $this->belongsTo(Village::class, 'villages_id', 'id');
    }

     // public function likes()
    // {
    //     return $this->hasMany(ComplaintLike::class, 'complaint_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    public function progresses()
    {
        return $this->hasMany(ComplaintProgres::class);
    }

        public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}

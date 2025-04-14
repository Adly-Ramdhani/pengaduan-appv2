<?php

namespace App\Models;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'province_id');
    }
}

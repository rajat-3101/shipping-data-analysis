<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}

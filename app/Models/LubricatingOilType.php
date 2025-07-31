<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LubricatingOilType extends Model
{
    protected $fillable = ['name', 'description'];

    public function vessels()
    {
        return $this->belongsToMany(Vessel::class, 'vessel_lubricating_oil_types')
                    ->withPivot('notes')
                    ->withTimestamps();
    }
}

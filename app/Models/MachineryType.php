<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineryType extends Model
{
    protected $fillable = ['name', 'description'];

    public function vessels()
    {
        return $this->belongsToMany(Vessel::class, 'vessel_machinery_types')
                    ->withPivot('quantity', 'specifications', 'notes')
                    ->withTimestamps();
    }
}

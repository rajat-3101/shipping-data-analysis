<?php
namespace App\Models;

use App\Models\User;
use App\Models\Voyage;
use App\Models\VesselCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vessel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        "id",
    ];

    protected $casts = [
        'date_of_delivery' => 'date',
        'dwt'              => 'decimal:2',
        'gt'               => 'decimal:2',
        'nt'               => 'decimal:2',
    ];

    // Relationships
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function fuelOilTypes()
    {
        return $this->belongsToMany(FuelOilType::class, 'vessel_fuel_oil_types')
            ->withPivot('notes')
            ->withTimestamps();
    }

    public function lubricatingOilTypes()
    {
        return $this->belongsToMany(LubricatingOilType::class, 'vessel_lubricating_oil_types')
            ->withPivot('notes')
            ->withTimestamps();
    }

    public function machineryTypes()
    {
        return $this->belongsToMany(MachineryType::class, 'vessel_machinery_types')
            ->withPivot('quantity', 'specifications', 'notes')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function noonReports()
    {
        return $this->hasMany(NoonReport::class);
    }

     public function vesselCategory()
    {
        return $this->belongsTo(VesselCategory::class);
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }

    // Scopes
    // public function scopeByVesselType($query, $type)
    // {
    //     return $query->where('vessel_type', $type);
    // }

    // public function scopeByFlag($query, $flag)
    // {
    //     return $query->where('flag', $flag);
    // }

    // public function scopeSearch($query, $term)
    // {
    //     return $query->where(function ($q) use ($term) {
    //         $q->where('vessel_name', 'like', "%{$term}%")
    //             ->orWhere('imo_no', 'like', "%{$term}%")
    //             ->orWhere('call_sign', 'like', "%{$term}%");
    //     });
    // }

    // // Accessors
    // public function getFormattedDwtAttribute()
    // {
    //     return $this->dwt ? number_format($this->dwt, 2) . ' MT' : null;
    // }

    // public function getFormattedGtAttribute()
    // {
    //     return $this->gt ? number_format($this->gt, 2) . ' GT' : null;
    // }
}

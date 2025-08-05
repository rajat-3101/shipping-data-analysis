<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voyage extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function noonReports()
    {
        return $this->hasMany(NoonReport::class);
    }
}

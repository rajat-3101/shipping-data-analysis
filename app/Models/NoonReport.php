<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoonReport extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function reportType()
    {
        return $this->belongsTo(ReportType::class, 'report_type_id');
    }
}

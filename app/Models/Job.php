<?php

// In Job.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue',
        'customer',
        'callType',
        'remark',
        'userLocation',
        'userEmail',
        'status',
        'image',
    ];

    public function timesheet()
    {
        return $this->hasOne(Timesheet::class);
    }
}

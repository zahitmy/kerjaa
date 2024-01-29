<?php

// In Timesheet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

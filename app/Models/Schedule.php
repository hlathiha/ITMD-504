<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'tbl_schedule';

    // Specify the primary key, if different from 'id'
    protected $primaryKey = 'id';

    // Allow mass assignment for the following fields
    protected $fillable = [
        'UID',
        'Meeting_Link',
        'Meeting_Name',
        'Meeting_date',
        'startTime',
        'EndTime',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }

}

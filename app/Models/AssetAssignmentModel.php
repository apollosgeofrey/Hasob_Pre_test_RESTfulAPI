<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAssignmentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'assetId',
        'assignmentDate',
        'status',
        'isDue',
        'dueDate',
        'assignedUserId',
        'assignedBy',
    ];
}

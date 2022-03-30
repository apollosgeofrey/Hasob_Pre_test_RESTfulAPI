<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'serialNumber',
        'description',
        'pictureURL',
        'location',
        'id',
        'type',
        'serialNumber',
        'description',
        'fixed_movable',
        'picturePath',
        'purchaseDate',
        'startUseDate',
        'purchasePrice',
        'warrantyExpiryDate',
        'degradationInYears',
        'currentValueInNaira',
        'location'
    ];
}

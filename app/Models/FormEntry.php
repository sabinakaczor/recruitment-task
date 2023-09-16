<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $attachment
 */
class FormEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HasUuid;

class Category extends Model
{
    use HasFactory, HasUuid;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];


}

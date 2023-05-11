<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HasUuid;

class Contact extends Model
{
    use HasFactory, HasUuid;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'state',
        'city',
        'country',
        'zip_code',
        'user_id',
        'category_id',
        'photo',
        'lat',
        'long',
    ];

//    protected $casts = [
//        'lat' => ''
//    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}

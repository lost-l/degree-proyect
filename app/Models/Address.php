<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'description', 'locality_id', 'user_id'
    ];

    protected $hidden = [
        'user_id',
    ];

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

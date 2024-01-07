<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BugKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
    ];

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }
}

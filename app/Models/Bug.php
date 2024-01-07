<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bug extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'initial_code',
        'resolution',
        'reference_hash'
    ];

    public function keywords()
    {
        return $this->hasMany(BugKeyword::class);
    }

    public static function formatKeywords(string $keywords): Stringable
    {
        return Str::of($keywords)->replace(' ', '')->lower();
    }
}

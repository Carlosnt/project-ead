<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Status extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'abrev',
        'name',
    ];


    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

}

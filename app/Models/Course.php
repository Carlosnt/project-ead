<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $appends = ['photo'];
    protected $fillable = [
        'category_id',
        'name',
        'avaialble',
        'free',
        'description',
        'image'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }

    protected function photo(): Attribute
    {
        return new Attribute(
            get: function () {
                if (!empty($this->attributes['image'])) {
                    return Storage::url($this->attributes['image']);
                }

                return asset('../back/assets/images/layouts/no-image.png');
            }
        );
    }
}

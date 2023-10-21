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

    protected $fillable = [
        'name',
        'category_id',
        'avaialble',
        'description',
        'image'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function getcreatedAtAttribute()
    {
        return Carbon::make($this->attributes['created_at'])->format('d/m/Y');
    }

    public function image(): Attribute
    {
        return new Attribute(
            function($value){
            if (!empty($value)) {
                return Storage::url($value);
            }
            return asset('back/assets/images/no-image.png');
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidTrait;
use Illuminate\Support\Carbon;

class Module extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'course_id'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getcreatedAtAttribute()
    {
        return Carbon::make($this->attributes['created_at'])->format('d/m/Y');
    }
}

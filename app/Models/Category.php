<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'slung',
        'description',
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => [                
                'name' => $value,
                'slug' => $this->normalizeSlug($value),
            ]
        );
    }

    private function normalizeSlug(string $value): string
    {
        $slug = Str::slug($value);

        $count = Category::query()
        ->where('slug', $slug)
        ->when($this->id, function($query){
            $query->where('id', '!=', $this->id);
        })->count();
       
        if($count > 0){
            return $slug.'-'. ++$count;
        }

        return $slug;
    }

    public function getcreatedAtAttribute()
    {
        return Carbon::make($this->attributes['created_at'])->format('d/m/Y');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'module_id',       
        'url',
        'description',
        'embed',
        'duration',
        'plataform'
        
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function modules()
    {
        return $this->hasMany(Lesson::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function views()
    {
        return $this->hasMany(View::class)
            ->where(function ($query){
                if(auth()->check()){
                    return $query->where('user_id', auth()->user()->id);
                }
            });
    }

    public function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => [                
                'name' => $value,
                'url' => $this->normalizeSlug($value),
            ]
        );
    }

    private function normalizeSlug(string $value): string
    {
        $slug = Str::slug($value);

        $count = Lesson::query()
        ->where('url', $slug)
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


}

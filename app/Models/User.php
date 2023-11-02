<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\UuidTrait;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'uuid';
    protected $appends = ['photo'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'urlimage',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function views()
    {
        return $this->hasMany(View::class)
            ->where(function ($query) {
                if (auth()->check()) {
                    return $query->where('user_id', auth()->user()->id);
                }
            });
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

                 return asset('back/assets/images/no-image.png');
             }
         );
     }

}

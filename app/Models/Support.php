<?php

namespace App\Models;

use App\Enum\SupportEnum;
use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $appends = ['statusurl'];
    protected $fillable = [
        'user_id',
        'admin_id',
        'lesson_id',
        'status',
        'description',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }

    protected function statusurl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->attributes['status'] === "A") {
                    return "Aberto";
                }elseif ($this->attributes['status'] === 'C'){
                    return "Concluído";
                }elseif($this->attributes['status'] === "P"){
                    return "Pendente";
                }
            }
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function replies()
    {
        return $this->hasMany(ReplySupport::class);
    }
}

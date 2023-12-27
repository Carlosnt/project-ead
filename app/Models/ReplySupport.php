<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $table = "reply_support";

    protected $touches = ['support'];
    protected $appends = ['htmldescription'];
    protected $fillable = ['user_id', 'admin_id', 'support_id', 'description'];

    protected function htmldescription(): Attribute
    {
        return new Attribute(
            get: function () {
                if (!empty($this->attributes['description'])) {
                    return html_entity_decode($this->attributes['description'],ENT_HTML5, 'UTF-8');
                }
            }
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn($value) => htmlentities($value),
        );
    }
    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

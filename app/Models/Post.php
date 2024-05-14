<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['titulo', 'contenido', 'estado', 'user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function tags() : BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }

    public function titulo(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucwords($v)
        );
    }
    public function contenido(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucwords($v)
        );
    }

}

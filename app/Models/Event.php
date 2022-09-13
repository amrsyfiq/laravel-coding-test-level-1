<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class Event extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $table = "events";

    protected $fillable = ['name', 'slug', 'startAt', 'endAt', 'updated_at'];
}

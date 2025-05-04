<?php

namespace App\Models;

use App\Enums\WhiteboardType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Whiteboard extends Model
{
    use HasUuids;

    protected $table = 'whiteboards';

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'json',
        'type' => WhiteboardType::class,
    ];
}

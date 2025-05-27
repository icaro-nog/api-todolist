<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}

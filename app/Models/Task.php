<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_finished',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

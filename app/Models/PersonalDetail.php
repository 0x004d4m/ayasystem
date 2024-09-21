<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalDetail extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'personal_details';
    protected $fillable = [
        'user_id',
        'job_title',
        'salary',
        'work_hours',
        'is_part_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

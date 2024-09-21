<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialStatement extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'financial_statements';
    protected $fillable = [
        'bank_card_id',
        'request_date',
        'payment_date',
        'is_paid',
        'proof',
    ];

    public function bankCard()
    {
        return $this->belongsTo(BankCard::class);
    }

    public function getProofAttribute($val)
    {
        return url('storage/' . $val);
    }
}

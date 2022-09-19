<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'check_unique_id', 'russia', 'sum', 'paymentType', 'status', 'url'
    ];

    protected $casts = [
        'russia'  => 'boolean',
    ];

    public function checkUnique()
    {
        return $this -> belongsTo(CheckUnique::class, 'check_unique_id');
    }
}

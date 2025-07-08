<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentAccount extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'user_id',
        'method',
        'account_number',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

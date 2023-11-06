<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [ 
        'user_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'province',
        'ID_number',
        'profile_picture',
        'id_verifi_doc',
        'proof_address_verifi_doc',
        'bank_confi_verifi',
        'date_of_birth',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
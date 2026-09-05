<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffSale extends Model
{
    use HasFactory;

    protected $table = 'staff_sales';

    protected $fillable = [
        'employee_id',
        'amount',
        'commission',
        'sale_date',
        'client_name',
        'notes',
        'recorded_by',
        'client_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'commission' => 'decimal:2',
        'sale_date' => 'date',
    ];

    /**
     * Never expose commission when serializing for peer views.
     *
     * @var list<string>
     */
    protected $hidden = [
        'commission',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

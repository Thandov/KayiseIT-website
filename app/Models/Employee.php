<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'user_id',
        'manager_id',
        'sort_order',
        'first_name',
        'last_name',
        'job_title',
        'job_title_id',
        'email',
        'personal_email',
        'phone',
        'address',
        'province',
        'ID_number',
        'profile_picture',
        'id_copy_path',
        'bank_confirmation_path',
        'cv_path',
        'sars_income_tax_path',
        'id_verifi_doc',
        'proof_address_verifi_doc',
        'bank_confi_verifi',
        'date_of_birth',
    ];

    protected $casts = [
        'id_verifi_doc' => 'boolean',
        'proof_address_verifi_doc' => 'boolean',
        'bank_confi_verifi' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(StaffSale::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(self::class, 'manager_id')->orderBy('sort_order')->orderBy('first_name');
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(
            substr((string) $this->first_name, 0, 1)
            .substr((string) $this->last_name, 0, 1)
        );
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->profile_picture) {
            return null;
        }

        return \App\Helpers\StaffFolderHelper::url($this->profile_picture);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    /**
     * Employees grouped by reporting depth, CEO / roots first.
     *
     * @return \Illuminate\Support\Collection<int, \Illuminate\Support\Collection<int, self>>
     */
    public static function organogramLevels()
    {
        $employees = static::query()
            ->orderBy('sort_order')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $levels = collect();
        $current = $employees->filter(fn (self $employee) => $employee->manager_id === null)->values();
        $seen = [];

        while ($current->isNotEmpty()) {
            $levels->push($current);
            foreach ($current as $employee) {
                $seen[(int) $employee->id] = true;
            }

            $parentIds = $current->pluck('id')->map(fn ($id) => (int) $id)->all();
            $current = $employees
                ->filter(function (self $employee) use ($parentIds, $seen) {
                    $id = (int) $employee->id;
                    if (isset($seen[$id]) || $employee->manager_id === null) {
                        return false;
                    }

                    return in_array((int) $employee->manager_id, $parentIds, true);
                })
                ->sortBy([
                    ['sort_order', 'asc'],
                    ['first_name', 'asc'],
                    ['last_name', 'asc'],
                ])
                ->values();
        }

        return $levels;
    }

    /**
     * True if $candidateManagerId is this employee or any descendant (would create a cycle).
     */
    public function wouldCreateCycle(?int $candidateManagerId): bool
    {
        if ($candidateManagerId === null) {
            return false;
        }

        if ((int) $candidateManagerId === (int) $this->id) {
            return true;
        }

        $descendantIds = $this->descendantIds();

        return in_array((int) $candidateManagerId, $descendantIds, true);
    }

    /**
     * @return list<int>
     */
    public function descendantIds(): array
    {
        $ids = [];
        $queue = $this->reports()->pluck('id')->all();

        while (! empty($queue)) {
            $id = (int) array_shift($queue);
            if (in_array($id, $ids, true)) {
                continue;
            }
            $ids[] = $id;
            $childIds = self::query()->where('manager_id', $id)->pluck('id')->all();
            foreach ($childIds as $childId) {
                $queue[] = (int) $childId;
            }
        }

        return $ids;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class InternshipApplication extends Person
{
    protected $table = 'people';

    protected static function booted(): void
    {
        static::addGlobalScope('application', function (Builder $builder) {
            $builder->where('record_type', self::TYPE_APPLICATION);
        });

        static::creating(function (self $model) {
            $model->record_type = self::TYPE_APPLICATION;
            $model->source = $model->source ?: 'application';
            $model->status = $model->status ?: 'pending';
        });
    }

    public function getIdNoAttribute(): ?string
    {
        return $this->id_number;
    }

    public function setIdNoAttribute(?string $value): void
    {
        $this->attributes['id_number'] = $value;
    }

    public function getNameAttribute(?string $value): string
    {
        if (! empty($this->attributes['surname'])) {
            return trim(($value ?? '').' '.$this->attributes['surname']);
        }

        return $value ?? '';
    }

    public function setNameAttribute(?string $value): void
    {
        $parts = preg_split('/\s+/', trim((string) $value), 2);
        $this->attributes['name'] = $parts[0] ?? '';
        $this->attributes['surname'] = $parts[1] ?? '';
    }

    public function internshipProgram()
    {
        return $this->program();
    }
}

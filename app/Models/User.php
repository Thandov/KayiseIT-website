<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Auth\Notifications\VerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'id_number',
        'age',
        'address',
        'province',
        'high_school',
        'year_of_completion',
        'qualification',
        'institution',
        'year_obtained',
        'cv_path',
        'id_copy_path',
        'qualification_copy_path',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function isDashboardAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isStaffMember(): bool
    {
        if ($this->hasRole('staff') || $this->hasRole('admin')) {
            return true;
        }

        return $this->employee()->exists();
    }

    public function canAccessDashboard(): bool
    {
        if ($this->hasRole('student')) {
            return false;
        }

        return $this->isDashboardAdmin() || $this->isStaffMember();
    }

    /**
     * Fine-grained staff permission check. Admins always pass.
     */
    public function hasStaffPermission(string $permission): bool
    {
        if ($this->isDashboardAdmin()) {
            return true;
        }

        $permission = self::canonicalStaffPermission($permission);

        if (method_exists($this, 'isAbleTo')) {
            return (bool) $this->isAbleTo($permission);
        }

        return false;
    }

    /**
     * Sales access: inquiries and converted clients share this set.
     */
    public function canAccessClients(): bool
    {
        return $this->hasAnyStaffPermission([
            'clients.read',
            'clients.create',
            'clients.update',
            'clients.delete',
            'clients.upload',
        ]);
    }

    public static function canonicalStaffPermission(string $permission): string
    {
        return match ($permission) {
            'leads.read', 'customers.read' => 'clients.read',
            'leads.upload' => 'clients.upload',
            'customers.create' => 'clients.create',
            'customers.update' => 'clients.update',
            'customers.delete' => 'clients.delete',
            default => $permission,
        };
    }

    /**
     * True if the user has any of the given permissions (or is admin).
     *
     * @param  list<string>  $permissions
     */
    public function hasAnyStaffPermission(array $permissions): bool
    {
        if ($this->isDashboardAdmin()) {
            return true;
        }

        foreach ($permissions as $permission) {
            if ($this->hasStaffPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}

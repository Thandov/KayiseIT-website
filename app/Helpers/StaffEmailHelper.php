<?php

namespace App\Helpers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Str;

class StaffEmailHelper
{
    public const DOMAIN = 'kayiseit.co.za';

    public static function fromFirstName(string $firstName, ?string $currentEmail = null): string
    {
        $local = Str::slug($firstName, '');
        $local = $local !== '' ? $local : 'staff';
        $generated = $local.'@'.self::DOMAIN;
        $dotcom = $local.'@kayiseit.com';
        $current = strtolower(trim((string) $currentEmail));

        if ($current === $dotcom) {
            return $dotcom;
        }

        return $generated;
    }

    public static function assignWorkEmail(Employee $employee): string
    {
        $linked = $employee->user ?: ($employee->user_id ? User::find($employee->user_id) : null);
        $email = self::fromFirstName(
            (string) $employee->first_name,
            $employee->email ?: ($linked?->email)
        );
        $local = Str::before($email, '@');
        $existing = User::query()
            ->whereIn('email', [$local.'@'.self::DOMAIN, $local.'@kayiseit.com'])
            ->orderByRaw("CASE WHEN email LIKE ? THEN 0 ELSE 1 END", ['%@kayiseit.com'])
            ->first();

        $employee->email = $email;

        if ($existing && self::isSamePerson($employee, $existing)) {
            if ((int) $employee->user_id !== (int) $existing->id) {
                $old = $linked;
                $employee->user_id = $existing->id;
                $employee->save();

                if ($old && (int) $old->id !== (int) $existing->id && self::looksLikeGeneratedStaffLogin($old, $employee)) {
                    $old->delete();
                }
            } else {
                $employee->save();
            }

            if (strtolower((string) $existing->email) !== $email) {
                $existing->email = $email;
                $existing->save();
            }

            return $email;
        }

        if ($linked) {
            $taken = User::where('email', $email)->where('id', '!=', $linked->id)->exists();
            if (! $taken && strtolower((string) $linked->email) !== $email) {
                $linked->email = $email;
                $linked->save();
            }
        }

        $employee->save();

        return $email;
    }

    public static function preferredChannel(Employee $employee): string
    {
        // Prefer work: this host can deliver locally to @kayiseit.co.za.
        // External SMTP is blocked, so personal Gmail often never arrives.
        unset($employee);

        return 'work';
    }

    public static function isLocalDeliverable(string $email): bool
    {
        $host = strtolower((string) Str::after($email, '@'));

        return in_array($host, [self::DOMAIN, 'kayiseit.com'], true);
    }

    /**
     * Mailer that actually delivers. "failover" was smtp→log, which wrote the
     * message to laravel.log and looked like a successful send.
     */
    public static function outboundMailer(): string
    {
        $default = (string) config('mail.default', 'sendmail');

        if (in_array($default, ['log', 'array', 'failover'], true)) {
            return 'sendmail';
        }

        return $default;
    }

    public static function deliveryAddress(Employee $employee, string $channel = 'work'): string
    {
        $work = $employee->email ?: self::fromFirstName((string) $employee->first_name);
        $personal = strtolower(trim((string) $employee->personal_email));

        if ($channel === 'personal') {
            if (! filter_var($personal, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException('No personal email on file for '.$employee->full_name.'.');
            }

            if (! self::isLocalDeliverable($personal)) {
                throw new \RuntimeException(
                    'This server cannot send activation mail to external addresses ('.$personal.'). '
                    .'Choose Work email instead ('.$work.').'
                );
            }

            return $personal;
        }

        if (! filter_var((string) $work, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException('No work email on file for '.$employee->full_name.'.');
        }

        return strtolower((string) $work);
    }

    protected static function isSamePerson(Employee $employee, User $user): bool
    {
        $userFirst = strtolower((string) Str::of($user->name)->before(' '));
        $empFirst = strtolower((string) Str::slug($employee->first_name, ''));

        return $userFirst !== '' && $empFirst !== '' && $userFirst === $empFirst;
    }

    protected static function looksLikeGeneratedStaffLogin(User $user, Employee $employee): bool
    {
        $email = strtolower((string) $user->email);
        $first = Str::slug((string) $employee->first_name, '');
        $last = Str::slug((string) $employee->last_name, '');

        if ($first === '' || $last === '') {
            return false;
        }

        return str_contains($email, $first.'.'.$last) || str_contains($email, $first.'_'.$last);
    }
}

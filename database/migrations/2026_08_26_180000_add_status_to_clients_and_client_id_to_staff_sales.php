<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('clients')) {
            Schema::table('clients', function (Blueprint $table) {
                if (! Schema::hasColumn('clients', 'status')) {
                    $table->string('status', 20)->default('client')->after('province');
                }
                if (! Schema::hasColumn('clients', 'inquiry_subject')) {
                    $table->string('inquiry_subject')->nullable()->after('status');
                }
                if (! Schema::hasColumn('clients', 'inquiry_message')) {
                    $table->text('inquiry_message')->nullable()->after('inquiry_subject');
                }
                if (! Schema::hasColumn('clients', 'converted_at')) {
                    $table->timestamp('converted_at')->nullable()->after('inquiry_message');
                }
            });

            DB::table('clients')->whereNull('status')->orWhere('status', '')->update([
                'status' => 'client',
            ]);
        }

        if (Schema::hasTable('staff_sales') && ! Schema::hasColumn('staff_sales', 'client_id')) {
            Schema::table('staff_sales', function (Blueprint $table) {
                $table->unsignedInteger('client_id')->nullable()->after('employee_id');
                $table->index('client_id');
            });
        }

        $this->importMessagesAsLeads();
    }

    public function down(): void
    {
        if (Schema::hasTable('staff_sales') && Schema::hasColumn('staff_sales', 'client_id')) {
            Schema::table('staff_sales', function (Blueprint $table) {
                $table->dropIndex(['client_id']);
                $table->dropColumn('client_id');
            });
        }

        if (Schema::hasTable('clients')) {
            Schema::table('clients', function (Blueprint $table) {
                foreach (['converted_at', 'inquiry_message', 'inquiry_subject', 'status'] as $column) {
                    if (Schema::hasColumn('clients', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }

    private function importMessagesAsLeads(): void
    {
        if (! Schema::hasTable('messages') || ! Schema::hasTable('clients')) {
            return;
        }

        $messages = DB::table('messages')->orderBy('id')->get();
        foreach ($messages as $message) {
            $email = strtolower(trim((string) $message->email));
            if ($email === '') {
                continue;
            }

            $parts = preg_split('/\s+/', trim((string) $message->name), 2) ?: [];
            $first = $parts[0] ?? trim((string) $message->name);
            $last = $parts[1] ?? '';
            $note = trim((string) ($message->subject ?? '')."\n".(string) ($message->message ?? ''));

            $existing = DB::table('clients')->whereRaw('LOWER(email) = ?', [$email])->first();
            if ($existing) {
                $updates = [];
                if (empty($existing->inquiry_subject) && ! empty($message->subject)) {
                    $updates['inquiry_subject'] = $message->subject;
                }
                if ($note !== '') {
                    $updates['inquiry_message'] = trim((string) $existing->inquiry_message."\n\n".$note);
                }
                if ($updates !== []) {
                    $updates['updated_at'] = now();
                    DB::table('clients')->where('id', $existing->id)->update($updates);
                }

                continue;
            }

            DB::table('clients')->insert([
                'name' => $first !== '' ? $first : null,
                'surname' => $last !== '' ? $last : null,
                'email' => $email,
                'status' => 'lead',
                'inquiry_subject' => $message->subject ?? null,
                'inquiry_message' => $note !== '' ? $note : null,
                'created_at' => $message->created_at ?? now(),
                'updated_at' => $message->updated_at ?? now(),
            ]);
        }
    }
};

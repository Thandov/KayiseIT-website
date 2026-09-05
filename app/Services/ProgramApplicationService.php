<?php

namespace App\Services;

use App\Helpers\UserFolderHelper;
use App\Models\InternshipProgram;
use App\Models\Person;
use App\Models\User;
use App\Support\ProgramFormFields;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProgramApplicationService
{
    /**
     * @return array<string, mixed>
     */
    public function validateSubmission(
        Request $request,
        InternshipProgram $program,
        ?User $user = null,
        ?Person $existingPerson = null,
        bool $publicEnquiry = false
    ): array {
        $fieldKeys = $program->getFormFieldKeys();
        $rules = $this->buildRules($fieldKeys, $program, $user, $existingPerson, $publicEnquiry);

        return $request->validate($rules);
    }

    /**
     * @param  array<string, mixed>  $validated
     */
    public function createSubmission(
        array $validated,
        InternshipProgram $program,
        string $recordType,
        ?User $user = null,
        string $source = 'public'
    ): Person {
        $fieldKeys = $program->getFormFieldKeys();
        $attributes = [
            'record_type' => $recordType,
            'internship_program_id' => $program->id,
            'program_partner' => $program->partner?->name,
            'source' => $source,
            'country' => $validated['country'] ?? 'South Africa',
        ];

        if ($user) {
            $attributes['user_id'] = $user->id;
            $attributes['name'] = $validated['name'] ?? $user->name;
            $attributes['surname'] = $validated['surname'] ?? $user->surname;
            $attributes['email'] = $validated['email'] ?? $user->email;
        }

        if ($recordType === Person::TYPE_APPLICATION) {
            $attributes['status'] = 'pending';
            $attributes['app_id'] = $user
                ? UserFolderHelper::generateFolderName($user)
                : ('P' . now()->format('YmdHis') . mt_rand(100, 999));
        }

        $customFields = [];

        foreach ($fieldKeys as $key) {
            $definition = ProgramFormFields::definition($key);
            if (! $definition) {
                continue;
            }

            if (($definition['type'] ?? '') === 'file') {
                continue;
            }

            if (ProgramFormFields::isCustomField($key)) {
                if (array_key_exists($key, $validated)) {
                    $customFields[$key] = $validated[$key];
                }
                continue;
            }

            $column = ProgramFormFields::columnFor($key);
            if (! $column || array_key_exists($column, $attributes)) {
                continue;
            }

            if (array_key_exists($key, $validated)) {
                $attributes[$column] = $validated[$key];
            } elseif ($user && isset($user->{$column})) {
                $attributes[$column] = $user->{$column};
            }
        }

        if ($user) {
            $this->applyUserFallbacks($attributes, $user, $fieldKeys);
            $this->storeDocumentUploads($attributes, $validated, $fieldKeys, $user);
        } else {
            $this->storePublicDocumentUploads($attributes, $validated, $fieldKeys, $program);
        }

        if ($customFields !== []) {
            $attributes['custom_fields'] = $customFields;
        }

        $attributes['cellphone'] = $attributes['cellphone'] ?? '';
        $attributes['province'] = $attributes['province'] ?? '';
        $attributes['location_name'] = $attributes['location_name'] ?? '';
        $attributes['location_type'] = $attributes['location_type'] ?? 'town';

        if (empty($attributes['id_number'])) {
            $attributes['id_number'] = $validated['id_number'] ?? $user?->id_number ?? '';
        }

        if (empty($attributes['email']) && $user?->email) {
            $attributes['email'] = $user->email;
        }

        return Person::create($attributes);
    }

    /**
     * @param  list<string>  $fieldKeys
     * @return array<string, mixed>
     */
    private function buildRules(
        array $fieldKeys,
        InternshipProgram $program,
        ?User $user,
        ?Person $existingPerson,
        bool $publicEnquiry
    ): array {
        $rules = [
            'internship_program_id' => [
                'required',
                'integer',
                Rule::exists('internship_programs', 'id')->where(function ($query) use ($publicEnquiry) {
                    $query->where('is_active', true);
                    if ($publicEnquiry) {
                        $query->where('allows_enquiry', true);
                    }
                }),
            ],
            'selected_program_id' => ['nullable', 'integer', Rule::exists('internship_programs', 'id')->where('is_active', true)],
        ];

        if (in_array('id_number', $fieldKeys, true)) {
            $uniqueRule = Rule::unique('people', 'id_number');
            if ($existingPerson) {
                $uniqueRule->ignore($existingPerson->id);
            }
            $rules['id_number'] = ['required', 'string', 'max:50', $uniqueRule];
        }

        foreach ($fieldKeys as $key) {
            if ($key === 'id_number') {
                continue;
            }

            $definition = ProgramFormFields::definition($key);
            if (! $definition) {
                continue;
            }

            if (($definition['type'] ?? '') === 'file') {
                $column = ProgramFormFields::columnFor($key);
                $hasExisting = $user && $column && ! empty($user->{$column});
                $rules[$key] = ($hasExisting ? 'nullable' : 'required') . '|file|mimes:pdf|max:2048';
                continue;
            }

            $rules[$key] = $definition['rules'];
        }

        return $rules;
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @param  list<string>  $fieldKeys
     */
    private function applyUserFallbacks(array &$attributes, User $user, array $fieldKeys): void
    {
        $fallbackMap = [
            'address' => 'address',
            'high_school' => 'high_school',
            'year_of_completion' => 'year_of_completion',
            'qualification' => 'qualification',
            'year_obtained' => 'year_obtained',
            'institution' => 'institution',
            'phone' => 'phone',
            'cellphone' => 'phone',
        ];

        foreach ($fieldKeys as $key) {
            $column = ProgramFormFields::columnFor($key);
            if (! $column || ! empty($attributes[$column])) {
                continue;
            }

            $userColumn = $fallbackMap[$key] ?? $column;
            if (! empty($user->{$userColumn})) {
                $attributes[$column] = $user->{$userColumn};
            }
        }
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @param  array<string, mixed>  $validated
     * @param  list<string>  $fieldKeys
     */
    private function storeDocumentUploads(array &$attributes, array $validated, array $fieldKeys, User $user): void
    {
        $folderName = UserFolderHelper::generateFolderName($user);
        UserFolderHelper::createUserFolder($user, 'internship');

        foreach ($fieldKeys as $key) {
            $definition = ProgramFormFields::definition($key);
            if (($definition['type'] ?? '') !== 'file') {
                continue;
            }

            $column = ProgramFormFields::columnFor($key);
            if (! $column) {
                continue;
            }

            if (! empty($validated[$key]) && $validated[$key] instanceof UploadedFile) {
                $file = $validated[$key];
                $attributes[$column] = UserFolderHelper::storeUserFile(
                    $user,
                    $file,
                    $key . '_' . $folderName . '.' . $file->getClientOriginalExtension(),
                    'internship'
                );
            } elseif (! empty($user->{$column})) {
                $attributes[$column] = $user->{$column};
            }
        }
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @param  array<string, mixed>  $validated
     * @param  list<string>  $fieldKeys
     */
    private function storePublicDocumentUploads(array &$attributes, array $validated, array $fieldKeys, InternshipProgram $program): void
    {
        $directory = 'uploads/program-enquiries/' . $program->id;
        $publicRoot = public_path($directory);
        if (! is_dir($publicRoot)) {
            mkdir($publicRoot, 0755, true);
        }

        foreach ($fieldKeys as $key) {
            $definition = ProgramFormFields::definition($key);
            if (($definition['type'] ?? '') !== 'file') {
                continue;
            }

            $column = ProgramFormFields::columnFor($key);
            if (! $column || empty($validated[$key]) || ! ($validated[$key] instanceof UploadedFile)) {
                continue;
            }

            $file = $validated[$key];
            $filename = $key . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($publicRoot, $filename);
            $attributes[$column] = $directory . '/' . $filename;
        }
    }

    public function assertNoDuplicateApplication(User $user, InternshipProgram $program): void
    {
        $exists = Person::applications()
            ->where('user_id', $user->id)
            ->where('internship_program_id', $program->id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'selected_program_id' => 'You have already applied for this programme.',
            ]);
        }
    }
}

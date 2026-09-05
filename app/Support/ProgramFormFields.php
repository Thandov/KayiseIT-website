<?php

namespace App\Support;

class ProgramFormFields
{
    public const SECTION_PERSONAL = 'personal';

    public const SECTION_LOCATION = 'location';

    public const SECTION_EDUCATION = 'education';

    public const SECTION_APPLICATION = 'application';

    public const SECTION_DOCUMENTS = 'documents';

    public const SECTION_ADDITIONAL = 'additional';

    /** @return array<string, array<string, mixed>> */
    public static function definitions(): array
    {
        return [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'section' => self::SECTION_PERSONAL,
                'column' => 'name',
                'rules' => 'required|string|max:255',
            ],
            'surname' => [
                'label' => 'Surname',
                'type' => 'text',
                'section' => self::SECTION_PERSONAL,
                'column' => 'surname',
                'rules' => 'required|string|max:255',
            ],
            'id_number' => [
                'label' => 'ID number',
                'type' => 'text',
                'section' => self::SECTION_PERSONAL,
                'column' => 'id_number',
                'rules' => 'required|string|max:50',
            ],
            'email' => [
                'label' => 'Email',
                'type' => 'email',
                'section' => self::SECTION_PERSONAL,
                'column' => 'email',
                'rules' => 'required|email|max:255',
            ],
            'cellphone' => [
                'label' => 'Cellphone',
                'type' => 'tel',
                'section' => self::SECTION_PERSONAL,
                'column' => 'cellphone',
                'rules' => 'required|string|max:50',
            ],
            'phone' => [
                'label' => 'Contact number',
                'type' => 'tel',
                'section' => self::SECTION_PERSONAL,
                'column' => 'cellphone',
                'rules' => 'required|string|max:50',
            ],
            'age' => [
                'label' => 'Age',
                'type' => 'number',
                'section' => self::SECTION_PERSONAL,
                'column' => 'age',
                'rules' => 'required|integer|min:1|max:120',
            ],
            'address' => [
                'label' => 'Physical address',
                'type' => 'text',
                'section' => self::SECTION_PERSONAL,
                'column' => 'address',
                'rules' => 'required|string|max:500',
            ],
            'mother_name' => [
                'label' => "Mother's name",
                'type' => 'text',
                'section' => self::SECTION_ADDITIONAL,
                'custom' => true,
                'rules' => 'required|string|max:255',
            ],
            'father_name' => [
                'label' => "Father's name",
                'type' => 'text',
                'section' => self::SECTION_ADDITIONAL,
                'custom' => true,
                'rules' => 'required|string|max:255',
            ],
            'hobbies' => [
                'label' => 'Your hobbies',
                'type' => 'textarea',
                'section' => self::SECTION_ADDITIONAL,
                'custom' => true,
                'rules' => 'required|string|max:2000',
            ],
            'motivation' => [
                'label' => 'Why do you want to join this programme?',
                'type' => 'textarea',
                'section' => self::SECTION_ADDITIONAL,
                'custom' => true,
                'rules' => 'required|string|max:2000',
            ],
            'country' => [
                'label' => 'Country',
                'type' => 'select',
                'section' => self::SECTION_LOCATION,
                'column' => 'country',
                'options' => ['South Africa', 'Botswana', 'Lesotho', 'Mozambique', 'Namibia', 'Zimbabwe', 'Other'],
                'rules' => 'required|string|max:100',
            ],
            'province' => [
                'label' => 'Province',
                'type' => 'select',
                'section' => self::SECTION_LOCATION,
                'column' => 'province',
                'options' => ['Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal', 'Limpopo', 'Mpumalanga', 'Northern Cape', 'North West', 'Western Cape'],
                'rules' => 'required|string|max:100',
            ],
            'location_type' => [
                'label' => 'Area type',
                'type' => 'select',
                'section' => self::SECTION_LOCATION,
                'column' => 'location_type',
                'options' => ['town' => 'Town', 'township' => 'Township'],
                'rules' => 'required|in:town,township',
            ],
            'location_name' => [
                'label' => 'Town / township name',
                'type' => 'text',
                'section' => self::SECTION_LOCATION,
                'column' => 'location_name',
                'placeholder' => 'e.g. Polokwane or Seshego',
                'rules' => 'required|string|max:255',
            ],
            'high_school' => [
                'label' => 'Name of high school',
                'type' => 'text',
                'section' => self::SECTION_EDUCATION,
                'column' => 'high_school',
                'rules' => 'required|string|max:255',
            ],
            'year_of_completion' => [
                'label' => 'Year of completion (high school)',
                'type' => 'number',
                'section' => self::SECTION_EDUCATION,
                'column' => 'year_of_completion',
                'placeholder' => 'e.g. 2018',
                'rules' => 'required|integer|digits:4|min:1950|max:' . (date('Y') + 1),
            ],
            'qualification' => [
                'label' => 'Qualification obtained',
                'type' => 'text',
                'section' => self::SECTION_EDUCATION,
                'column' => 'qualification',
                'rules' => 'required|string|max:255',
            ],
            'institution' => [
                'label' => 'Institution',
                'type' => 'text',
                'section' => self::SECTION_EDUCATION,
                'column' => 'institution',
                'rules' => 'required|string|max:255',
            ],
            'year_obtained' => [
                'label' => 'Year obtained (tertiary)',
                'type' => 'number',
                'section' => self::SECTION_EDUCATION,
                'column' => 'year_obtained',
                'placeholder' => 'e.g. 2022',
                'rules' => 'required|integer|digits:4|min:1950|max:' . (date('Y') + 1),
            ],
            'app_type' => [
                'label' => 'Application type',
                'type' => 'select',
                'section' => self::SECTION_APPLICATION,
                'column' => 'app_type',
                'options' => ['Internship', 'Junior Position', 'Senior Position', 'Contract', 'Freelance', 'Short Programme'],
                'rules' => 'required|string|max:100',
            ],
            'field' => [
                'label' => 'Field of study',
                'type' => 'select',
                'section' => self::SECTION_APPLICATION,
                'column' => 'field',
                'options' => [
                    'Software and Web Development',
                    'Coding & Robotics',
                    'Computer Literacy',
                    'Robotics',
                    'Business Analysis',
                    'Desktop Technicial',
                    'Graphic Designs',
                    'Marketing',
                    'Administration',
                ],
                'rules' => 'required|string|max:100',
            ],
            'cv' => [
                'label' => 'CV',
                'type' => 'file',
                'section' => self::SECTION_DOCUMENTS,
                'column' => 'cv_path',
                'accept' => '.pdf',
                'rules' => 'required|file|mimes:pdf|max:2048',
            ],
            'id_copy' => [
                'label' => 'ID copy',
                'type' => 'file',
                'section' => self::SECTION_DOCUMENTS,
                'column' => 'id_copy_path',
                'accept' => '.pdf',
                'rules' => 'required|file|mimes:pdf|max:2048',
            ],
            'qualification_copy' => [
                'label' => 'Qualification copy',
                'type' => 'file',
                'section' => self::SECTION_DOCUMENTS,
                'column' => 'qualification_copy_path',
                'accept' => '.pdf',
                'rules' => 'required|file|mimes:pdf|max:2048',
            ],
            'proof_of_payment' => [
                'label' => 'Proof of payment',
                'type' => 'file',
                'section' => self::SECTION_DOCUMENTS,
                'column' => 'proof_of_payment_path',
                'accept' => '.pdf',
                'rules' => 'required|file|mimes:pdf|max:2048',
            ],
        ];
    }

    /** @return array<string, string> */
    public static function sectionLabels(): array
    {
        return [
            self::SECTION_PERSONAL => 'Personal details',
            self::SECTION_LOCATION => 'Location',
            self::SECTION_EDUCATION => 'Education',
            self::SECTION_APPLICATION => 'Application details',
            self::SECTION_DOCUMENTS => 'Documents',
            self::SECTION_ADDITIONAL => 'Additional information',
        ];
    }

    public static function definition(string $key): ?array
    {
        return self::definitions()[$key] ?? null;
    }

    /** @return list<string> */
    public static function defaultFieldKeys(string $programType, bool $allowsEnquiry): array
    {
        if ($allowsEnquiry) {
            return match ($programType) {
                'Short Program' => [
                    'name', 'surname', 'id_number', 'email', 'cellphone',
                    'province', 'location_name',
                ],
                'TVET Placement' => [
                    'name', 'surname', 'id_number', 'email', 'cellphone',
                    'province', 'location_type', 'location_name',
                    'high_school', 'year_of_completion',
                ],
                default => [
                    'name', 'surname', 'id_number', 'email', 'cellphone',
                    'country', 'province', 'location_type', 'location_name',
                ],
            };
        }

        return match ($programType) {
            'Short Program' => [
                'name', 'surname', 'id_number', 'email', 'phone', 'age', 'address',
                'high_school', 'year_of_completion', 'motivation', 'id_copy',
            ],
            'TVET Placement' => [
                'name', 'surname', 'id_number', 'email', 'phone', 'age', 'address',
                'high_school', 'year_of_completion', 'qualification', 'institution', 'year_obtained',
                'id_copy', 'qualification_copy',
            ],
            default => [
                'name', 'surname', 'id_number', 'email', 'phone', 'age', 'address',
                'high_school', 'year_of_completion', 'qualification', 'institution', 'year_obtained',
                'app_type', 'field', 'cv', 'id_copy', 'qualification_copy', 'proof_of_payment',
            ],
        };
    }

    /**
     * @param  list<string>|null  $selected
     * @return list<string>
     */
    public static function normalizeSelected(?array $selected, string $programType, bool $allowsEnquiry): array
    {
        $definitions = self::definitions();
        $keys = array_values(array_unique(array_filter(
            $selected ?? [],
            fn (string $key) => isset($definitions[$key])
        )));

        if ($keys === []) {
            $keys = self::defaultFieldKeys($programType, $allowsEnquiry);
        }

        if (in_array('cellphone', $keys, true) && in_array('phone', $keys, true)) {
            $keys = array_values(array_filter($keys, fn (string $key) => $key !== 'phone'));
        }

        return $keys;
    }

    /**
     * @param  list<string>  $keys
     * @return array<string, array{label: string, fields: list<array<string, mixed>>}>
     */
    public static function groupedBySection(array $keys): array
    {
        $grouped = [];
        $definitions = self::definitions();
        $labels = self::sectionLabels();

        foreach ($keys as $key) {
            $definition = $definitions[$key] ?? null;
            if (! $definition) {
                continue;
            }

            $section = $definition['section'];
            $grouped[$section]['label'] = $labels[$section] ?? ucfirst($section);
            $grouped[$section]['fields'][] = array_merge($definition, ['key' => $key]);
        }

        $order = array_keys($labels);
        uksort($grouped, fn (string $a, string $b) => array_search($a, $order, true) <=> array_search($b, $order, true));

        return $grouped;
    }

    public static function isCustomField(string $key): bool
    {
        return (bool) (self::definitions()[$key]['custom'] ?? false);
    }

    public static function columnFor(string $key): ?string
    {
        return self::definitions()[$key]['column'] ?? null;
    }
}

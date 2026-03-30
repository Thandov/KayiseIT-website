<?php

namespace App\Services;

class ChatbotResponseService
{
    /**
     * Kayise IT Chatbot Knowledge Base
     */
    protected $responses = [
        [
            'intent' => 'greeting',
            'questions' => ['hi', 'hello', 'hey', 'good morning', 'good afternoon', 'good evening', 'greetings'],
            'response' => 'Hello. I am the KAYISE IT assistant. I can help with our services, training programs, opportunities, certifications, and partnerships.'
        ],
        [
            'intent' => 'services',
            'questions' => [
                'what services does kayise it offer',
                'what services do you offer',
                'services',
                'what can kayise it do',
                'website development',
                'it consulting',
                'cyber security training',
                'microsoft office training',
                'computer productivity'
            ],
            'response' => 'KAYISE IT offers drone building training, ICT skills training, 4IR technology training, cyber security training, Microsoft Office productivity training, website development, and IT consulting.'
        ],
        [
            'intent' => 'drone_training',
            'questions' => [
                'do you offer drone training',
                'drone training',
                'drone workshop',
                'can i learn drones',
                'drone building course',
                'build a drone'
            ],
            'response' => 'Yes. KAYISE IT offers practical drone building training. The course includes hands-on assembly, testing, and STEM-based learning for schools and institutions.'
        ],
        [
            'intent' => 'opportunities',
            'questions' => [
                'what opportunities are available',
                'internship',
                'internships',
                'job opportunities',
                'career opportunities',
                'hiring',
                'recruitment',
                'apply',
                'work with you'
            ],
            'response' => 'We have exciting internship and career opportunities available. You can view all open positions on our website under the Opportunities section. Visit our website or press 2 to hear more details.'
        ],
        [
            'intent' => 'training_programs',
            'questions' => [
                'training programs',
                'courses available',
                'what courses',
                'certification courses',
                'ict training',
                'school training'
            ],
            'response' => 'Our training programs include drone building, ICT skills, 4IR technology, cyber security, and Microsoft Office productivity training. Programs are available for individuals, schools, and organizations.'
        ],
        [
            'intent' => 'certification',
            'questions' => [
                'certification',
                'certifications',
                'do you offer certificates',
                'certificate programs',
                'certified training'
            ],
            'response' => 'Yes. We offer recognized certifications upon completion of our training programs. All programs include industry-relevant certifications to enhance your professional credentials.'
        ],
        [
            'intent' => 'partnership',
            'questions' => [
                'partnership',
                'partnerships',
                'collaborate',
                'working together',
                'partnership opportunities',
                'partner with'
            ],
            'response' => 'We welcome partnerships with schools, organizations, and businesses. Our partnership programs are flexible and tailored to your needs. Contact us to discuss how we can work together.'
        ],
        [
            'intent' => 'contact',
            'questions' => [
                'contact',
                'contact information',
                'how do i contact',
                'phone number',
                'email',
                'address',
                'get in touch'
            ],
            'response' => 'You can reach us at +27 87 702 26 25 for voice calls, or visit our website for more contact options including email and physical address.'
        ],
        [
            'intent' => 'location',
            'questions' => [
                'where are you located',
                'address',
                'office location',
                'physical address'
            ],
            'response' => 'KAYISE IT is based in South Africa. Please visit our website for our exact office address and directions.'
        ],
        [
            'intent' => 'cost',
            'questions' => [
                'how much',
                'cost',
                'price',
                'pricing',
                'fees',
                'how much do you charge'
            ],
            'response' => 'Pricing varies depending on the program and your specific needs. Please visit our website for detailed pricing information or contact us for a custom quote.'
        ],
        [
            'intent' => 'transfer',
            'questions' => [
                'agent',
                'speak to someone',
                'talk to a person',
                'speak to a human',
                'representative',
                'customer service'
            ],
            'response' => 'I can transfer you to one of our team members. Please hold while I connect you.'
        ],
    ];

    /**
     * Get response for user input
     */
    public function getResponse(string $userInput): string
    {
        $input = strtolower(trim($userInput));
        
        if (empty($input)) {
            return 'I did not understand that. Could you please repeat your inquiry?';
        }

        // Try to find matching intent
        foreach ($this->responses as $item) {
            foreach ($item['questions'] as $question) {
                if (stripos($input, $question) !== false) {
                    return $item['response'];
                }
            }
        }

        // Default response if no match
        return 'I\'m not sure about that. You can press 1 for services, 2 for opportunities, 3 for training programs, 4 for certification, 5 for contact, or 0 to speak to an agent.';
    }

    /**
     * Get response for IVR menu option
     */
    public function getResponseByIntent(string $intent): string
    {
        foreach ($this->responses as $item) {
            if ($item['intent'] === $intent) {
                return $item['response'];
            }
        }

        return 'Thank you for your interest. How else can we help you?';
    }

    /**
     * Get all intents
     */
    public function getIntents(): array
    {
        return array_map(fn($item) => $item['intent'], $this->responses);
    }

    /**
     * Add custom response
     */
    public function addResponse(string $intent, array $questions, string $response): void
    {
        $this->responses[] = [
            'intent' => $intent,
            'questions' => $questions,
            'response' => $response,
        ];
    }
}

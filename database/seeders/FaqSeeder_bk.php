<?php 
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqTableSeeder extends Seeder
{
    public function run()
    {
        Faq::Create([
                'question' => 'What kind of therapy services do you offer?',
                'answer' => 'We provide a range of therapy services, including individual, couples, and group therapy sessions tailored to your needs.',
            ]);
            Faq::Create([
                'question' => 'Do you offer online therapy options?',
                'answer' => 'Yes, we offer virtual therapy sessions for your convenience and comfort, ensuring you can access support from anywhere.',
            ]);
            Faq::Create([
                'question' => 'How can I schedule an appointment?',
                'answer' => 'You can easily schedule an appointment by contacting our office via phone or email, or by filling out our online appointment request form.',
             ]);
            Faq::Create([  'question' => 'Are your services covered by insurance?',
                'answer' => 'We accept a variety of insurance plans, and our team can help you navigate the process to ensure you receive the coverage you are entitled to.',
            ]);
            Faq::Create([
                'question' => 'Do you offer specialized therapy for specific issues?',
                'answer' => 'Our psychologists have expertise in various areas, such as anxiety, depression, trauma, and more, offering specialized therapy tailored to your unique needs.',
            ]);
            Faq::Create([
                'question' => 'Can I choose my therapist?',
                'answer' => 'We strive to match you with a therapist who best fits your preferences and needs, ensuring a strong therapeutic alliance for effective treatment.',
            ]);
        
    }
}

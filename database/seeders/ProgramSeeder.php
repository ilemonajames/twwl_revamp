<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'group.jpg',
                'icon_class' => 'fas fa-heart', // Font Awesome icon class
                'program_title' => '8-Week Couples Program',
                'program_description' => 'A structured, self-paced 8-week program designed to help couples strengthen their connection, improve communication, and resolve conflicts.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'parenting.jpg',
                'icon_class' => 'fas fa-child', // Font Awesome icon class
                'program_title' => '8-Week Parenting Class',
                'program_description' => 'An online self-paced parenting course focusing on parenting styles, emotional intelligence, communication, and building stronger family bonds.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'group.jpg',
                'icon_class' => 'fas fa-user-shield', // Font Awesome icon class
                'program_title' => 'Trauma & PTSD Support Group',
                'program_description' => 'An online support group that provides a safe space for individuals dealing with trauma and PTSD to share, grow, and heal.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]); 

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'couple.jpg',
                'icon_class' => 'fas fa-users', // Font Awesome icon class
                'program_title' => 'Couples Seminar',
                'program_description' => 'A seminar led by a licensed mental health provider designed to help couples foster deeper emotional connections, improve communication, and resolve conflicts.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'weigth.jpg',
                'icon_class' => 'fas fa-weight', // Font Awesome icon class
                'program_title' => 'Weight Release Program',
                'program_description' => 'A holistic program combining health coaching, hypnotherapy, and a 14-day detox cleanse to help individuals achieve a healthier lifestyle.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'group.jpg',
                'icon_class' => 'fas fa-comments', // Font Awesome icon class
                'program_title' => 'Group Therapy Program',
                'program_description' => 'Weekly online group therapy sessions providing emotional support and coping strategies for trauma and PTSD.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'hypnotherapy.jpg',
                'icon_class' => 'fas fa-user-md', // Font Awesome icon class
                'program_title' => 'Hypnotherapy Program',
                'program_description' => 'A one-on-one counseling session with a licensed mental health professional to help individuals identify and manage their mental health concerns.',
                'program_content'=>'<p>Hypnotherapy is a therapeutic technique that induces a trance-like state of consciousness, making the mind more receptive to suggestion. In this altered state, individuals are deeply relaxed but remain fully aware of their surroundings. Hypnotherapy can address a variety of issues by guiding individuals toward their goals through focused suggestions.</p>

    <h4>How Hypnotherapy Can Help</h4>
    <ul>
        <li><strong>Reducing Active Stress:</strong> Calms the mind and body to alleviate stress and promote relaxation.</li>
        <li><strong>Improving Sleep:</strong> Addresses subconscious factors contributing to insomnia or restless sleep.</li>
        <li><strong>Facilitating Weight Loss:</strong> Reinforces positive behaviors and attitudes around food and exercise.</li>
    </ul>

    <h4>What to Expect During a Hypnotherapy Session</h4>
    <p>During a session, individuals remain aware but become more open to positive suggestions. These align with personal goals, promoting desired changes in behavior or thinking.</p>

    <h4>Mind, Body, and Spirit Connection</h4>
    <p>Hypnotherapy facilitates unity between the mind, body, and spirit, encouraging harmony among thoughts, emotions, and physical well-being. This holistic approach supports healing and personal growth.</p>

    <h4>What Happens During a Hypnotherapy Session?</h4>
    <ol>
        <li>
            <strong>Induction Phase:</strong>
            <p>The therapist guides the individual into a relaxed state using soothing imagery or scenes.</p>
        </li>
        <li>
            <strong>Suggestion Phase:</strong>
            <p>Personalized suggestions tailored to specific goals (e.g., weight loss, reducing stress) are introduced to influence the subconscious mind.</p>
        </li>
        <li>
            <strong>Emerging Phase:</strong>
            <p>The therapist guides the individual back to full consciousness, leaving them refreshed and aware of the session’s content.</p>
        </li>
    </ol>

    <h4>Why Use Hypnotherapy?</h4>
    <ul>
        <li><strong>Effective Stress Relief:</strong> Reduces anxiety and fosters relaxation.</li>
        <li><strong>Visual Perception for Healing:</strong> Helps process and transform emotional patterns.</li>
        <li><strong>Altered State for Change:</strong> Encourages lasting transformation by making the subconscious more receptive to positive suggestions.</li>
    </ul>
',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}

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
                'program_content' => '<h2>Parenting Course Schedule</h2>
    
    <div class="week">
        <h3>Week 1: Understanding Parenting Styles</h3>
        <h4>Overview:</h4>
        <p>Introduction to different parenting styles (authoritative, authoritarian, permissive, and uninvolved) and their impact on child development.</p>
        <h4>Objectives:</h4>
        <p>Help parents identify their current parenting style and learn how to adopt a more balanced approach that promotes healthy development.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Overview of parenting styles</li>
            <li>The effects of each style on children</li>
            <li>Finding balance: Moving toward an authoritative approach</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 2: Building Emotional Intelligence in Children</h3>
        <h4>Overview:</h4>
        <p>Understanding the importance of emotional intelligence and teaching children to recognize, express, and manage their emotions.</p>
        <h4>Objectives:</h4>
        <p>Equip parents with tools to nurture their children\'s emotional awareness and resilience.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Defining emotional intelligence</li>
            <li>Techniques for modeling emotional regulation</li>
            <li>Helping children identify and express their feelings</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 3: Effective Communication with Your Child</h3>
        <h4>Overview:</h4>
        <p>Learn the essentials of communicating with children at different developmental stages, including listening techniques and expressing empathy.</p>
        <h4>Objectives:</h4>
        <p>Strengthen parent-child relationships through open and effective communication.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Age-appropriate communication strategies</li>
            <li>Active listening skills</li>
            <li>Encouraging open dialogue and empathy</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 4: Setting Boundaries and Encouraging Discipline</h3>
        <h4>Overview:</h4>
        <p>Explore positive discipline strategies and the importance of setting healthy boundaries to promote responsibility and respect.</p>
        <h4>Objectives:</h4>
        <p>Help parents create clear, consistent boundaries and apply discipline in a constructive, non-punitive manner.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Setting clear expectations and consequences</li>
            <li>Positive discipline vs. punitive discipline</li>
            <li>Teaching responsibility and respect through boundaries</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 5: Fostering Self-Esteem and Confidence</h3>
        <h4>Overview:</h4>
        <p>Learn strategies to build your child’s self-esteem and confidence while providing appropriate encouragement and support.</p>
        <h4>Objectives:</h4>
        <p>Teach parents how to cultivate a growth mindset and provide constructive feedback.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Encouraging self-esteem through positive reinforcement</li>
            <li>The role of praise in building confidence</li>
            <li>Helping children develop resilience and independence</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 6: Managing Stress and Overwhelm in Parenting</h3>
        <h4>Overview:</h4>
        <p>Explore strategies for managing parental stress and preventing burnout while balancing responsibilities.</p>
        <h4>Objectives:</h4>
        <p>Teach parents self-care strategies and techniques to reduce stress in family life.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Stress management techniques for parents</li>
            <li>Identifying and reducing sources of overwhelm</li>
            <li>Creating a family routine that works for everyone</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 7: Supporting Your Child\'s Social and Academic Development</h3>
        <h4>Overview:</h4>
        <p>Discuss how to foster a supportive environment for your child’s academic and social success.</p>
        <h4>Objectives:</h4>
        <p>Equip parents with strategies to support their child’s learning and healthy peer relationships.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Encouraging a love for learning</li>
            <li>Supporting social skills and peer relationships</li>
            <li>Balancing academic expectations and play</li>
        </ul>
    </div>

    <div class="week">
        <h3>Week 8: Strengthening Family Bonds and Creating Lasting Traditions</h3>
        <h4>Overview:</h4>
        <p>Focus on ways to create strong family bonds and traditions that foster connection, communication, and joy.</p>
        <h4>Objectives:</h4>
        <p>Encourage families to establish meaningful rituals and traditions that bring them closer together.</p>
        <h4>Key Topics:</h4>
        <ul>
            <li>Building family rituals and routines</li>
            <li>Creating opportunities for connection and bonding</li>
            <li>Celebrating family milestones and traditions</li>
        </ul>
    </div>

    <div class="course-benefit">
        <h3>Course Benefits:</h3>
        <ul>
            <li>Gain practical tools to improve communication and emotional regulation with your child.</li>
            <li>Learn strategies for setting boundaries, managing discipline, and fostering self-esteem.</li>
            <li>Find support in managing parental stress and creating a balanced, loving family environment.</li>
        </ul>
    </div>',
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

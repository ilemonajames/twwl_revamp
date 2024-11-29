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
                'program_image' => 'couple_program.jpg',
                'icon_class' => 'fas fa-heart', // Font Awesome icon class
                'program_title' => '8-Week Couples Program',
                'program_description' => 'A structured, self-paced 8-week program designed to help couples strengthen their connection, improve communication, and resolve conflicts.',
                'program_content' => '<h3>Parenting Course Schedule</h3>
    
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
                'program_description' => 'An online, self-paced parenting course focusing on parenting styles, emotional intelligence, communication, and building stronger family bonds.',
                'program_content' => '<article>
            <h3>Week 1: Understanding Parenting Styles</h3>
            <ul>
                <li><strong>Overview:</strong> Introduction to different parenting styles (authoritative, authoritarian, permissive, and uninvolved) and their impact on child development.</li>
                <li><strong>Objectives:</strong> Help parents identify their current parenting style and learn how to adopt a more balanced approach that promotes healthy development.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Overview of parenting styles</li>
                        <li>The effects of each style on children</li>
                        <li>Finding balance: Moving toward an authoritative approach</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 2: Building Emotional Intelligence in Children</h3>
            <ul>
                <li><strong>Overview:</strong> Understanding the importance of emotional intelligence and teaching children to recognize, express, and manage their emotions.</li>
                <li><strong>Objectives:</strong> Equip parents with tools to nurture their children\'s emotional awareness and resilience.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Defining emotional intelligence</li>
                        <li>Techniques for modeling emotional regulation</li>
                        <li>Helping children identify and express their feelings</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 3: Effective Communication with Your Child</h3>
            <ul>
                <li><strong>Overview:</strong> Learn the essentials of communicating with children at different developmental stages, including listening techniques and expressing empathy.</li>
                <li><strong>Objectives:</strong> Strengthen parent-child relationships through open and effective communication.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Age-appropriate communication strategies</li>
                        <li>Active listening skills</li>
                        <li>Encouraging open dialogue and empathy</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 4: Setting Boundaries and Encouraging Discipline</h3>
            <ul>
                <li><strong>Overview:</strong> Explore positive discipline strategies and the importance of setting healthy boundaries to promote responsibility and respect.</li>
                <li><strong>Objectives:</strong> Help parents create clear, consistent boundaries and apply discipline in a constructive, non-punitive manner.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Setting clear expectations and consequences</li>
                        <li>Positive discipline vs. punitive discipline</li>
                        <li>Teaching responsibility and respect through boundaries</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 5: Fostering Self-Esteem and Confidence</h3>
            <ul>
                <li><strong>Overview:</strong> Learn strategies to build your child’s self-esteem and confidence while providing appropriate encouragement and support.</li>
                <li><strong>Objectives:</strong> Teach parents how to cultivate a growth mindset and provide constructive feedback.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Encouraging self-esteem through positive reinforcement</li>
                        <li>The role of praise in building confidence</li>
                        <li>Helping children develop resilience and independence</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 6: Managing Stress and Overwhelm in Parenting</h3>
            <ul>
                <li><strong>Overview:</strong> Explore strategies for managing parental stress and preventing burnout while balancing responsibilities.</li>
                <li><strong>Objectives:</strong> Teach parents self-care strategies and techniques to reduce stress in family life.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Stress management techniques for parents</li>
                        <li>Identifying and reducing sources of overwhelm</li>
                        <li>Creating a family routine that works for everyone</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 7: Supporting Your Child\'s Social and Academic Development</h3>
            <ul>
                <li><strong>Overview:</strong> Discuss how to foster a supportive environment for your child’s academic and social success.</li>
                <li><strong>Objectives:</strong> Equip parents with strategies to support their child’s learning and healthy peer relationships.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Encouraging a love for learning</li>
                        <li>Supporting social skills and peer relationships</li>
                        <li>Balancing academic expectations and play</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Week 8: Strengthening Family Bonds and Creating Lasting Traditions</h3>
            <ul>
                <li><strong>Overview:</strong> Focus on ways to create strong family bonds and traditions that foster connection, communication, and joy.</li>
                <li><strong>Objectives:</strong> Encourage families to establish meaningful rituals and traditions that bring them closer together.</li>
                <li><strong>Key Topics:</strong>
                    <ul>
                        <li>Building family rituals and routines</li>
                        <li>Creating opportunities for connection and bonding</li>
                        <li>Celebrating family milestones and traditions</li>
                    </ul>
                </li>
            </ul>
        </article>

        <article>
            <h3>Course Benefits</h3>
            <ul>
                <li>Gain practical tools to improve communication and emotional regulation with your child.</li>
                <li>Learn strategies for setting boundaries, managing discipline, and fostering self-esteem.</li>
                <li>Find support in managing parental stress and creating a balanced, loving family environment.</li>
            </ul>
        </article>',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'ptsd.jpg',
                'icon_class' => 'fas fa-user-shield', // Font Awesome icon class
                'program_title' => 'Trauma & PTSD Support Group',
                'program_description' => 'An online support group that provides a safe space for individuals dealing with trauma and PTSD to share, grow, and heal.',
                'program_content'=>'<p>
            Our ongoing Trauma & PTSD Support Group is designed to provide individuals with a safe and
            supportive space to share their stories, process their trauma, and learn effective coping
            strategies. Facilitated by a trained mental health professional, this group focuses on fostering
            healing and personal growth.
        </p>

        <h3>Group Format:</h3>
        <ul>
            <li><strong>When:</strong> Tuesdays and Thursdays (60-minute sessions)</li>
            <li><strong>Where:</strong> Online (accessible from the comfort of your home)</li>
            <li><strong>Who:</strong> Open to individuals seeking support in healing from trauma or PTSD</li>
        </ul>

        <h3>Group Objectives:</h3>
        <ol>
            <li>
                <strong>A Safe Place to Tell Your Story</strong>
                <p>
                    We provide a non-judgmental, empathetic environment where individuals can
                    express their feelings and share their experiences.
                </p>
            </li>
            <li>
                <strong>Installation of Hope</strong>
                <p>
                    The group fosters hope through shared stories of healing and resilience, helping
                    participants see that recovery is possible.
                </p>
            </li>
            <li>
                <strong>Personal Growth and Self-Awareness</strong>
                <p>
                    Participants will develop greater self-awareness and insight into how their trauma
                    affects their thoughts, emotions, and behavior, leading to meaningful personal
                    growth.
                </p>
            </li>
            <li>
                <strong>Coping Skills for Healing</strong>
                <p>
                    The group will teach practical coping strategies and techniques to manage trauma
                    symptoms, reduce distress, and foster long-term healing.
                </p>
            </li>
        </ol>',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]); 

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'coupleseminar.jpg',
                'icon_class' => 'fas fa-users', // Font Awesome icon class
                'program_title' => 'Couples Seminar',
                'program_description' => 'A seminar led by a licensed mental health provider is designed to help couples foster deeper emotional connections, improve communication, and resolve conflicts.',
                'program_content'=>'<p>
            Our Couples Seminar is designed to help couples foster deeper connections, improve
            communication, and learn essential skills for navigating conflict. Through guided sessions led by
            a professional mental health provider, couples will gain valuable tools to strengthen their
            relationship.
        </p>

        <h3>Seminar Objectives:</h3>
        <ol>
            <li>
                <strong>Foster Connection Between Couples</strong>
                <p>
                    Reconnect with your partner through activities and discussions that strengthen
                    emotional bonds and deepen intimacy.
                </p>
            </li>
            <li>
                <strong>Learn Active Listening Skills</strong>
                <p>
                    Develop active listening techniques to better understand your partner\'s needs,
                    thoughts, and feelings, creating a foundation of empathy and mutual respect.
                </p>
            </li>
            <li>
                <strong>Effective Communication Skills</strong>
                <p>
                    Master strategies for expressing thoughts and emotions clearly while avoiding
                    misunderstandings that often lead to conflict.
                </p>
            </li>
            <li>
                <strong>Conflict Resolution and Problem-Solving Skills</strong>
                <p>
                    Learn practical methods for resolving disagreements and navigating challenges in
                    a healthy, collaborative manner, reducing tension, and fostering teamwork in the
                    relationship.
                </p>
            </li>
        </ol>

        <h3>Seminar Details:</h3>
        <ul>
            <li><strong>Dates & Times:</strong> Seminar dates and times are adjusted periodically to accommodate participants. Please check our schedule for the latest availability.</li>
            <li><strong>Format:</strong> Group sessions led by a licensed mental health professional in a supportive, structured environment.</li>
        </ul>

        <h3>Why Attend?</h3>
        <ul>
            <li><strong>Strengthen Your Relationship:</strong> Gain insights and skills that promote lasting connection and understanding with your partner.</li>
            <li><strong>Practical Tools:</strong> Walk away with effective communication, listening, and conflict resolution techniques you can use daily.</li>
            <li><strong>Expert Guidance:</strong> Learn from a professional trained in couples therapy to ensure you receive personalized, effective support.</li>
        </ul>
    ',
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
                'program_content'=>'<h1>Our Weight Release Program</h1>
        <p>
            Our Weight Release Program is a comprehensive approach to achieving a healthier lifestyle. It includes:
        </p>
        <ul>
            <li>
                <strong>Health Coaching:</strong> Support from a health coach to guide you through your weight loss 
                journey and create sustainable habits.
            </li>
            <li>
                <strong>Customized Hypnotherapy Sessions:</strong> Tailored to address emotional and psychological 
                aspects of weight release.
            </li>
            <li>
                <strong>Biofeedback:</strong> Monitors physiological responses to stress, helping you manage emotions 
                and habits that may hinder weight loss.
            </li>
            <li>
                <strong>14-Day Detox Cleanse:</strong> A natural detox program using all-natural ingredients to reset 
                your body and promote health.
            </li>
        </ul>',
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

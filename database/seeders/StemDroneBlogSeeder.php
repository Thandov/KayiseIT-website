<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class StemDroneBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = '5 Reasons Why Drone Building is the Perfect STEM Activity for Schools';

        $content = <<<'HTML'
<p>Schools today are under pressure to make learning practical, relevant, and future-focused. Drone building stands out as one of the most effective STEM education activities because it combines science, technology, engineering, and mathematics into one exciting project. Instead of only reading theory, learners design, build, test, and improve a real flying system. This creates curiosity, confidence, and deeper understanding from the classroom to the workshop.</p>

<h3>1. It Connects STEM Theory to Real-World Application</h3>
<p>Drone projects naturally combine concepts from physics, mathematics, coding, and engineering. Learners quickly see how classroom theory applies to real technical problems and solutions.</p>

<h3>2. It Teaches Electronics Basics in a Practical Way</h3>
<p>Students learn core electronics fundamentals such as circuits, resistance, voltage, and current. Concepts like Ohm's Law become easier to understand when learners use real components and measure outcomes directly during assembly and testing.</p>

<h3>3. It Promotes Hands-On Learning and Problem-Solving</h3>
<p>Hands-on learning helps students retain knowledge for longer and develop stronger technical confidence. Building a drone requires troubleshooting, teamwork, and iterative improvement. Learners test what works, identify failures, and apply structured problem-solving skills.</p>

<h3>4. It Supports Career Readiness for TVET Colleges and Schools</h3>
<p>For TVET colleges and schools, drone building bridges the gap between theory and employable skills. Learners are exposed to practical competencies aligned with digital, engineering, and technical career paths, including maintenance, diagnostics, systems thinking, and innovation.</p>

<h3>5. It Increases Engagement and Motivation</h3>
<p>Drones are exciting and highly visual, which improves learner participation. Students become active contributors in lessons, ask better questions, and collaborate more effectively. This leads to stronger academic engagement and improved confidence in STEM subjects.</p>

<p>Drone building is more than a project; it is a powerful learning model for modern education. It equips learners with technical knowledge, critical thinking, and practical capability that schools and TVET colleges need in today's digital economy.</p>

<p><strong>Ready to bring drone-based STEM education to your learners?</strong> Partner with <strong>KAYISE IT</strong> to design and deliver practical drone training programs for your school or TVET college.</p>
HTML;

        $blog = Blog::firstOrNew(['title' => $title]);
        $blog->icon = 'images/banner/contact.png';
        $blog->subtitle = 'A practical pathway to STEM excellence for schools and TVET colleges';
        $blog->content = $content;
        $blog->category_no = null;
        $blog->save();
    }
}

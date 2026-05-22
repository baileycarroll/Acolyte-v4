<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Discussions;
use App\Models\Gradebook;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\Resource_Types;
use App\Models\Student_Resources;
use App\Models\User;
use App\Models\User_Award;
use App\Models\User_Content;
use Illuminate\Database\Seeder;

class DemoActivitySeeder extends Seeder
{
    /**
     * Seed learner activity, quizzes, grades, awards, and resources.
     */
    public function run(): void
    {
        $this->seedResourceTypes();
        $this->seedResources();
        $this->seedAwards();
        $this->seedUserContent();
        $this->seedQuizzes();
        $this->seedGrades();
        $this->seedUserAwards();
        $this->seedDiscussions();
    }

    private function seedResourceTypes(): void
    {
        foreach (['Guide', 'Template', 'Policy', 'External Link'] as $resourceTypeName) {
            Resource_Types::firstOrCreate(['name' => $resourceTypeName]);
        }
    }

    private function seedResources(): void
    {
        $resourceTypes = Resource_Types::query()->pluck('id', 'name');

        $resources = [
            [
                'name' => 'Customer Kickoff Checklist',
                'description' => 'A reusable checklist for preparing learner-facing kickoff calls.',
                'url' => 'https://example.com/resources/customer-kickoff-checklist',
                'type' => $resourceTypes['Template'],
            ],
            [
                'name' => 'Security Escalation Matrix',
                'description' => 'Quick-reference routing guide for security-related customer questions.',
                'url' => 'https://example.com/resources/security-escalation-matrix',
                'type' => $resourceTypes['Policy'],
            ],
            [
                'name' => 'Manager 1 on 1 Agenda',
                'description' => 'Structured prompts for weekly coaching conversations.',
                'url' => 'https://example.com/resources/manager-1-on-1-agenda',
                'type' => $resourceTypes['Template'],
            ],
            [
                'name' => 'Demo Storyboard Reference',
                'description' => 'A narrated outline for consistent product walkthroughs.',
                'url' => 'https://example.com/resources/demo-storyboard-reference',
                'type' => $resourceTypes['Guide'],
            ],
            [
                'name' => 'Renewal Health Score Rubric',
                'description' => 'Reference guide for spotting risk before renewal conversations.',
                'url' => 'https://example.com/resources/renewal-health-score-rubric',
                'type' => $resourceTypes['Guide'],
            ],
            [
                'name' => 'Digital Adoption Benchmarks',
                'description' => 'External benchmark article used in learner resource views.',
                'url' => 'https://example.com/resources/digital-adoption-benchmarks',
                'type' => $resourceTypes['External Link'],
            ],
        ];

        foreach ($resources as $resource) {
            Student_Resources::updateOrCreate(['name' => $resource['name']], $resource);
        }
    }

    private function seedAwards(): void
    {
        $awards = [
            [
                'name' => 'Launch Ready',
                'description' => 'Awarded for completing the orientation and launch-readiness path.',
                'filename' => 'launch-ready',
            ],
            [
                'name' => 'Customer Advocate',
                'description' => 'Awarded for strong outcomes across customer-success content.',
                'filename' => 'customer-advocate',
            ],
            [
                'name' => 'Security Steward',
                'description' => 'Awarded for high performance on security-focused learning paths.',
                'filename' => 'security-steward',
            ],
            [
                'name' => 'Facilitator Spotlight',
                'description' => 'Awarded for active participation in workshop-style classes.',
                'filename' => 'facilitator-spotlight',
            ],
        ];

        foreach ($awards as $award) {
            Award::updateOrCreate(['name' => $award['name']], $award);
        }
    }

    private function seedUserContent(): void
    {
        $users = User::query()->pluck('id', 'email');
        $courses = Course::query()->pluck('id', 'name');
        $classes = Classes::query()->pluck('id', 'name');

        $enrollments = [
            ['user' => $users['sam.rivera@example.com'], 'course' => $courses['Leadership Foundations'], 'class' => null, 'last_accessed' => now()->subDays(2)->toDateString(), 'completed_on' => null],
            ['user' => $users['sam.rivera@example.com'], 'course' => $courses['Client Success Playbook'], 'class' => null, 'last_accessed' => now()->subDays(4)->toDateString(), 'completed_on' => now()->subDay()->toDateString()],
            ['user' => $users['sam.rivera@example.com'], 'course' => null, 'class' => $classes['Conflict Resolution Workshop'], 'last_accessed' => now()->subDays(3)->toDateString(), 'completed_on' => now()->subDays(2)->toDateString()],
            ['user' => $users['jamie.chen@example.com'], 'course' => $courses['Platform Security Essentials'], 'class' => null, 'last_accessed' => now()->subDays(1)->toDateString(), 'completed_on' => null],
            ['user' => $users['jamie.chen@example.com'], 'course' => $courses['Leadership Foundations'], 'class' => null, 'last_accessed' => now()->subDays(6)->toDateString(), 'completed_on' => now()->subDays(1)->toDateString()],
            ['user' => $users['jamie.chen@example.com'], 'course' => null, 'class' => $classes['Quarterly Compliance Briefing'], 'last_accessed' => now()->subDays(1)->toDateString(), 'completed_on' => null],
            ['user' => $users['taylor.nguyen@example.com'], 'course' => $courses['Client Success Playbook'], 'class' => null, 'last_accessed' => now()->subDays(7)->toDateString(), 'completed_on' => null],
            ['user' => $users['taylor.nguyen@example.com'], 'course' => null, 'class' => $classes['Demo Platform Walkthrough'], 'last_accessed' => now()->subDays(5)->toDateString(), 'completed_on' => null],
            ['user' => $users['riley.brooks@example.com'], 'course' => $courses['Platform Security Essentials'], 'class' => null, 'last_accessed' => now()->subDays(2)->toDateString(), 'completed_on' => now()->subDays(1)->toDateString()],
            ['user' => $users['riley.brooks@example.com'], 'course' => $courses['Leadership Foundations'], 'class' => null, 'last_accessed' => now()->subDays(8)->toDateString(), 'completed_on' => null],
            ['user' => $users['riley.brooks@example.com'], 'course' => null, 'class' => $classes['Sales Discovery Lab'], 'last_accessed' => now()->subDays(3)->toDateString(), 'completed_on' => now()->subDays(2)->toDateString()],
            ['user' => $users['casey.patel@example.com'], 'course' => $courses['Leadership Foundations'], 'class' => null, 'last_accessed' => now()->subDays(2)->toDateString(), 'completed_on' => null],
            ['user' => $users['casey.patel@example.com'], 'course' => null, 'class' => $classes['Conflict Resolution Workshop'], 'last_accessed' => now()->subDays(9)->toDateString(), 'completed_on' => null],
            ['user' => $users['devon.kim@example.com'], 'course' => $courses['New Hire Orientation Journey'], 'class' => null, 'last_accessed' => now()->subDays(30)->toDateString(), 'completed_on' => null],
            ['user' => $users['devon.kim@example.com'], 'course' => null, 'class' => $classes['Archived Town Hall Session'], 'last_accessed' => now()->subDays(60)->toDateString(), 'completed_on' => null],
        ];

        foreach ($enrollments as $enrollment) {
            User_Content::updateOrCreate(
                [
                    'user' => $enrollment['user'],
                    'course' => $enrollment['course'],
                    'class' => $enrollment['class'],
                ],
                $enrollment
            );
        }
    }

    private function seedQuizzes(): void
    {
        foreach (Classes::where('status', 'Active')->get() as $class) {
            Quiz::updateOrCreate(
                ['class_id' => $class->id, 'module_id' => null],
                $this->quizPayload(
                    "Class quiz for {$class->name}",
                    "Which behavior best supports success in {$class->name}?"
                )
            );
        }

        foreach (Module::where('status', 'Active')->get() as $module) {
            Quiz::updateOrCreate(
                ['class_id' => null, 'module_id' => $module->id],
                $this->quizPayload(
                    "Module quiz for {$module->name}",
                    "What is the main objective of {$module->name}?"
                )
            );
        }
    }

    private function seedGrades(): void
    {
        $users = User::query()->pluck('id', 'email');
        $classes = Classes::query()->pluck('id', 'name');
        $courses = Course::query()->pluck('id', 'name');
        $modules = Module::query()->pluck('id', 'name');

        $grades = [
            ['user' => $users['sam.rivera@example.com'], 'class' => $classes['Conflict Resolution Workshop'], 'course' => null, 'module' => null, 'grade' => 94],
            ['user' => $users['sam.rivera@example.com'], 'class' => null, 'course' => $courses['Client Success Playbook'], 'module' => $modules['Onboarding Signals and Triggers'], 'grade' => 88],
            ['user' => $users['sam.rivera@example.com'], 'class' => null, 'course' => $courses['Client Success Playbook'], 'module' => $modules['Renewal Readiness Conversations'], 'grade' => 91],
            ['user' => $users['jamie.chen@example.com'], 'class' => null, 'course' => $courses['Leadership Foundations'], 'module' => $modules['Leading Through Change'], 'grade' => 96],
            ['user' => $users['jamie.chen@example.com'], 'class' => $classes['Quarterly Compliance Briefing'], 'course' => null, 'module' => null, 'grade' => 84],
            ['user' => $users['riley.brooks@example.com'], 'class' => $classes['Sales Discovery Lab'], 'course' => null, 'module' => null, 'grade' => 90],
            ['user' => $users['riley.brooks@example.com'], 'class' => null, 'course' => $courses['Platform Security Essentials'], 'module' => $modules['Secure Customer Messaging'], 'grade' => 98],
            ['user' => $users['riley.brooks@example.com'], 'class' => null, 'course' => $courses['Platform Security Essentials'], 'module' => $modules['Data Handling Scenarios'], 'grade' => 93],
            ['user' => $users['casey.patel@example.com'], 'class' => null, 'course' => $courses['Leadership Foundations'], 'module' => $modules['Feedback That Sticks'], 'grade' => 79],
        ];

        foreach ($grades as $grade) {
            Gradebook::updateOrCreate(
                [
                    'user' => $grade['user'],
                    'class' => $grade['class'],
                    'course' => $grade['course'],
                    'module' => $grade['module'],
                ],
                $grade
            );
        }
    }

    private function seedUserAwards(): void
    {
        $users = User::query()->pluck('id', 'email');
        $awards = Award::query()->pluck('id', 'name');

        $grants = [
            ['user' => $users['sam.rivera@example.com'], 'award' => $awards['Customer Advocate']],
            ['user' => $users['jamie.chen@example.com'], 'award' => $awards['Launch Ready']],
            ['user' => $users['riley.brooks@example.com'], 'award' => $awards['Security Steward']],
            ['user' => $users['taylor.nguyen@example.com'], 'award' => $awards['Facilitator Spotlight']],
        ];

        foreach ($grants as $grant) {
            User_Award::updateOrCreate($grant, $grant);
        }
    }

    private function seedDiscussions(): void
    {
        $classes = array_values(Classes::where('status', 'Active')->pluck('id')->all());
        $modules = array_values(Module::where('status', 'Active')->pluck('id')->all());

        for ($month = 0; $month < 12; $month++) {
            $classId = $classes[$month % count($classes)];
            $moduleId = $modules[$month % count($modules)];

            Discussions::updateOrCreate(
                ['month' => $month],
                [
                    'topic' => sprintf('Monthly Coaching Circle %02d', $month + 1),
                    'related_class_1' => $classId,
                    'related_module' => $moduleId,
                    'information' => 'This seeded discussion gives the home page and discussions admin views a realistic monthly spotlight topic.',
                ]
            );
        }
    }

    /**
     * Build a full quiz payload so reseeding cannot leave stale nullable question fields behind.
     */
    private function quizPayload(string $topic, string $focusPrompt): array
    {
        $payload = ['num_questions' => 4];

        $questions = [
            1 => [
                'question' => $focusPrompt,
                'options' => ['Clarify the expected outcome', 'Skip the context review', 'Delay the response indefinitely'],
                'correct' => 'Clarify the expected outcome',
            ],
            2 => [
                'question' => "What is the strongest facilitator habit in {$topic}?",
                'options' => ['Consistent follow-through', 'Ignoring action items', 'Working without documentation'],
                'correct' => 'Consistent follow-through',
            ],
            3 => [
                'question' => 'Which action best supports learner accountability?',
                'options' => ['Document next steps', 'Remove all checkpoints', 'Avoid feedback loops'],
                'correct' => 'Document next steps',
            ],
            4 => [
                'question' => 'Which response demonstrates a customer-ready standard?',
                'options' => ['Clear communication and escalation', 'Verbal-only handoffs', 'Untracked commitments'],
                'correct' => 'Clear communication and escalation',
            ],
        ];

        for ($i = 1; $i <= 10; $i++) {
            $payload["question_{$i}"] = $questions[$i]['question'] ?? null;
            $payload["q{$i}_opt_1"] = $questions[$i]['options'][0] ?? null;
            $payload["q{$i}_opt_2"] = $questions[$i]['options'][1] ?? null;
            $payload["q{$i}_opt_3"] = $questions[$i]['options'][2] ?? null;
            $payload["q{$i}_correct"] = $questions[$i]['correct'] ?? null;
        }

        return $payload;
    }
}

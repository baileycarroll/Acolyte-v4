<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Classes;
use App\Models\Content_Types;
use App\Models\Course;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Module;
use App\Models\RelatedContent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    /**
     * Seed the LMS catalog structure and linked content records.
     */
    public function run(): void
    {
        $this->seedCategories();
        $this->seedCourses();
        $this->seedClasses();
        $this->seedModules();
        $this->seedCatalog();
        $this->seedRelatedContent();
    }

    private function seedCategories(): void
    {
        foreach ([
            'Leadership',
            'Compliance',
            'Customer Success',
            'Operations',
            'Product Knowledge',
            'Sales Excellence',
        ] as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }
    }

    private function seedCourses(): void
    {
        $contentTypeId = Content_Types::where('name', 'Course')->value('id');
        $departments = Department::query()->pluck('id', 'name');
        $categories = Category::query()->pluck('id', 'name');
        $learningStyles = Learning_Styles::query()->pluck('id', 'name');
        $instructors = User::query()->pluck('id', 'email');

        $courses = [
            [
                'name' => 'Leadership Foundations',
                'excerpt' => 'A practical leadership series for new team leads.',
                'description' => 'Covers coaching, communication, and feedback loops for front-line leaders.',
                'department' => $departments['Training'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Collaborative'],
                'category_1' => $categories['Leadership'],
                'category_2' => $categories['Operations'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 1,
            ],
            [
                'name' => 'Client Success Playbook',
                'excerpt' => 'A structured program for delighting customers throughout onboarding.',
                'description' => 'Focuses on stakeholder alignment, communication cadences, and renewal readiness.',
                'department' => $departments['Support'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Reading/Writing'],
                'category_1' => $categories['Customer Success'],
                'category_2' => $categories['Operations'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 0,
            ],
            [
                'name' => 'Platform Security Essentials',
                'excerpt' => 'A customer-facing security readiness course for internal teams.',
                'description' => 'Explains data handling, escalation paths, and secure customer communication practices.',
                'department' => $departments['Operations'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Visual'],
                'category_1' => $categories['Compliance'],
                'category_2' => $categories['Product Knowledge'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 0,
            ],
            [
                'name' => 'New Hire Orientation Journey',
                'excerpt' => 'A not-yet-published guided onboarding journey for new employees.',
                'description' => 'Introduces team norms, system access expectations, and internal operating rhythms.',
                'department' => $departments['Human Resources'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Reading/Writing'],
                'category_1' => $categories['Operations'],
                'category_2' => $categories['Leadership'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Pending',
                'spotlight' => 0,
            ],
        ];

        Course::query()->update(['spotlight' => 0]);

        foreach ($courses as $course) {
            Course::updateOrCreate(['name' => $course['name']], $course);
        }
    }

    private function seedClasses(): void
    {
        $contentTypeId = Content_Types::where('name', 'Class')->value('id');
        $departments = Department::query()->pluck('id', 'name');
        $categories = Category::query()->pluck('id', 'name');
        $learningStyles = Learning_Styles::query()->pluck('id', 'name');
        $instructors = User::query()->pluck('id', 'email');

        $classes = [
            [
                'name' => 'Conflict Resolution Workshop',
                'excerpt' => 'A live facilitation workshop focused on resolving team friction quickly.',
                'description' => 'Includes peer scenarios, manager roleplay prompts, and post-session reflection steps.',
                'department' => $departments['Training'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Collaborative'],
                'category_1' => $categories['Leadership'],
                'category_2' => $categories['Customer Success'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 1,
            ],
            [
                'name' => 'Quarterly Compliance Briefing',
                'excerpt' => 'A recurring class that keeps teams current on compliance changes.',
                'description' => 'Reviews updated policy language, common audit gaps, and real escalation examples.',
                'department' => $departments['Operations'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Visual'],
                'category_1' => $categories['Compliance'],
                'category_2' => $categories['Operations'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 0,
            ],
            [
                'name' => 'Demo Platform Walkthrough',
                'excerpt' => 'A class designed for customer-facing teams who run product tours.',
                'description' => 'Shows how to structure a product narrative and answer frequent implementation questions.',
                'department' => $departments['Support'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Kinesthetic'],
                'category_1' => $categories['Product Knowledge'],
                'category_2' => $categories['Customer Success'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 0,
            ],
            [
                'name' => 'Sales Discovery Lab',
                'excerpt' => 'A class for refining discovery conversations before pipeline review.',
                'description' => 'Focuses on question framing, follow-up discipline, and qualification signals.',
                'department' => $departments['Sales'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Collaborative'],
                'category_1' => $categories['Sales Excellence'],
                'category_2' => $categories['Leadership'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Active',
                'spotlight' => 0,
            ],
            [
                'name' => 'Archived Town Hall Session',
                'excerpt' => 'A pending archival class for executive communications.',
                'description' => 'Represents unpublished or archived content still visible to admins during demos.',
                'department' => $departments['Human Resources'],
                'instructor' => $instructors['morgan.lee@example.com'],
                'learning_style' => $learningStyles['Reading/Writing'],
                'category_1' => $categories['Operations'],
                'category_2' => $categories['Leadership'],
                'category_3' => null,
                'content_type' => $contentTypeId,
                'status' => 'Pending',
                'spotlight' => 0,
            ],
        ];

        Classes::query()->update(['spotlight' => 0]);

        foreach ($classes as $class) {
            Classes::updateOrCreate(['name' => $class['name']], $class);
        }
    }

    private function seedModules(): void
    {
        $courses = Course::query()->pluck('id', 'name');

        $modules = [
            [
                'name' => 'Leading Through Change',
                'course' => $courses['Leadership Foundations'],
                'description' => 'How to stabilize teams during shifting priorities and new initiatives.',
                'status' => 'Active',
                'available_on' => now()->subMonths(3)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Feedback That Sticks',
                'course' => $courses['Leadership Foundations'],
                'description' => 'A repeatable model for clear, actionable coaching conversations.',
                'status' => 'Active',
                'available_on' => now()->subMonths(2)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Coaching in the Moment',
                'course' => $courses['Leadership Foundations'],
                'description' => 'Practical intervention patterns for live customer and team situations.',
                'status' => 'Active',
                'available_on' => now()->subMonth()->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Onboarding Signals and Triggers',
                'course' => $courses['Client Success Playbook'],
                'description' => 'How to identify onboarding friction early and recover quickly.',
                'status' => 'Active',
                'available_on' => now()->subMonths(4)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Renewal Readiness Conversations',
                'course' => $courses['Client Success Playbook'],
                'description' => 'How to prepare accounts for renewals before risk signals surface.',
                'status' => 'Active',
                'available_on' => now()->subMonths(2)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Escalation Playbook for Success Teams',
                'course' => $courses['Client Success Playbook'],
                'description' => 'Covers routing, handoffs, and communication standards for escalations.',
                'status' => 'Pending',
                'available_on' => now()->addWeek()->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Secure Customer Messaging',
                'course' => $courses['Platform Security Essentials'],
                'description' => 'When and how to handle sensitive information in customer conversations.',
                'status' => 'Active',
                'available_on' => now()->subMonths(5)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Data Handling Scenarios',
                'course' => $courses['Platform Security Essentials'],
                'description' => 'Common scenarios that test retention, storage, and escalation knowledge.',
                'status' => 'Active',
                'available_on' => now()->subMonths(3)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Security Review Q and A',
                'course' => $courses['Platform Security Essentials'],
                'description' => 'A module used in demos to show learner progress with security topics.',
                'status' => 'Active',
                'available_on' => now()->subMonths(1)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Welcome to the Team',
                'course' => $courses['New Hire Orientation Journey'],
                'description' => 'Initial onboarding sequence for unpublished orientation content.',
                'status' => 'Pending',
                'available_on' => now()->addDays(10)->toDateString(),
                'not_available' => null,
            ],
            [
                'name' => 'Operating Rhythm Overview',
                'course' => $courses['New Hire Orientation Journey'],
                'description' => 'Follow-on orientation module covering team rituals and expectations.',
                'status' => 'Pending',
                'available_on' => now()->addDays(14)->toDateString(),
                'not_available' => null,
            ],
        ];

        foreach ($modules as $module) {
            $contentPath = $this->videoPathForModule($module['name']);

            Module::updateOrCreate(
                ['name' => $module['name']],
                array_merge($module, ['content_path' => $contentPath])
            );
        }
    }

    private function seedCatalog(): void
    {
        foreach (Course::all(['id']) as $course) {
            Catalog::updateOrCreate(
                ['course_id' => $course->id],
                ['class_id' => null]
            );
        }

        foreach (Classes::all(['id']) as $class) {
            Catalog::updateOrCreate(
                ['class_id' => $class->id],
                ['course_id' => null]
            );
        }
    }

    private function seedRelatedContent(): void
    {
        $classes = Classes::query()->pluck('id', 'name');
        $modules = Module::query()->pluck('id', 'name');

        $links = [
            [
                'class_id' => $classes['Conflict Resolution Workshop'],
                'module_id' => null,
                'related_class' => $classes['Sales Discovery Lab'],
                'related_module' => null,
            ],
            [
                'class_id' => $classes['Demo Platform Walkthrough'],
                'module_id' => null,
                'related_class' => $classes['Quarterly Compliance Briefing'],
                'related_module' => null,
            ],
            [
                'class_id' => null,
                'module_id' => $modules['Leading Through Change'],
                'related_class' => $classes['Conflict Resolution Workshop'],
                'related_module' => $modules['Feedback That Sticks'],
            ],
            [
                'class_id' => null,
                'module_id' => $modules['Secure Customer Messaging'],
                'related_class' => $classes['Quarterly Compliance Briefing'],
                'related_module' => $modules['Data Handling Scenarios'],
            ],
            [
                'class_id' => null,
                'module_id' => $modules['Renewal Readiness Conversations'],
                'related_class' => $classes['Demo Platform Walkthrough'],
                'related_module' => $modules['Onboarding Signals and Triggers'],
            ],
        ];

        foreach ($links as $link) {
            RelatedContent::updateOrCreate($link, $link);
        }
    }

    private function videoPathForModule(string $moduleName): string
    {
        $slug = str_replace(' ', '_', $moduleName);

        return "modules/{$slug}/{$slug}.mp4";
    }
}

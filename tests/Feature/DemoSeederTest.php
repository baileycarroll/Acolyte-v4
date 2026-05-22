<?php

namespace Tests\Feature;

use App\Models\Award;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Discussions;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\Resource_Types;
use App\Models\SetupKeys;
use App\Models\Student_Resources;
use App\Models\User;
use Database\Seeders\DemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DemoSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeders_populate_the_expected_lms_graph(): void
    {
        Storage::fake(config('filesystems.default'));

        $this->seed(DemoSeeder::class);

        $this->assertSame(10, User::count());
        $this->assertSame(4, Role::count());
        $this->assertSame(4, Course::count());
        $this->assertSame(5, Classes::count());
        $this->assertSame(11, Module::count());
        $this->assertSame(12, Quiz::count());
        $this->assertSame(12, Discussions::count());
        $this->assertSame(4, Award::count());
        $this->assertSame(4, Resource_Types::count());
        $this->assertSame(6, Student_Resources::count());
        $this->assertSame('1', SetupKeys::where('key', 'use_subscriptions')->value('value'));
        $this->assertTrue(User::where('email', 'morgan.lee@example.com')->firstOrFail()->hasActivePlatformAccess());
        $this->assertTrue(User::where('email', 'sam.rivera@example.com')->firstOrFail()->hasActivePlatformAccess());

        Storage::disk(config('filesystems.default'))->assertExists('thumbnails/Leadership Foundations/Leadership Foundations.jpg');
        Storage::disk(config('filesystems.default'))->assertExists('classes/Conflict_Resolution_Workshop/Conflict_Resolution_Workshop.mp4');
        Storage::disk(config('filesystems.default'))->assertExists('awards/launch-ready.png');
    }

    public function test_demo_seeders_are_idempotent_for_core_records(): void
    {
        Storage::fake(config('filesystems.default'));

        $this->seed(DemoSeeder::class);
        $this->seed(DemoSeeder::class);

        $this->assertSame(10, User::count());
        $this->assertSame(4, Course::count());
        $this->assertSame(5, Classes::count());
        $this->assertSame(11, Module::count());
        $this->assertSame(12, Quiz::count());
        $this->assertSame(4, Award::count());
        $this->assertSame(12, Discussions::count());
    }
}

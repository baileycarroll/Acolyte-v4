<?php

namespace Database\Seeders;

use App\Models\Content_Types;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\SetupKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DemoBootstrapSeeder extends Seeder
{
    /**
     * Seed the platform bootstrap data required by the demo.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->seedDepartments();
        $this->seedLearningStyles();
        $this->seedLicenses();
        $this->seedPermissionsAndRoles();
        $this->seedSetupKeys();
        $this->seedContentTypes();
    }

    private function seedDepartments(): void
    {
        foreach ([
            'Support',
            'Training',
            'Operations',
            'Sales',
            'Human Resources',
        ] as $departmentName) {
            Department::firstOrCreate(['name' => $departmentName]);
        }
    }

    private function seedLearningStyles(): void
    {
        $styles = [
            'Unknown' => 'Fallback learning style for system records and setup flows.',
            'Visual' => 'Learners who prefer diagrams, screenshots, and visual walkthroughs.',
            'Reading/Writing' => 'Learners who prefer documentation, transcripts, and guided notes.',
            'Kinesthetic' => 'Learners who prefer hands-on scenarios and practice exercises.',
            'Collaborative' => 'Learners who prefer facilitated workshops and discussion-led practice.',
        ];

        foreach ($styles as $name => $description) {
            Learning_Styles::updateOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }

    private function seedLicenses(): void
    {
        $licenses = [
            [
                'name' => 'Trial',
                'description' => 'Trial License',
                'stripe_api_id' => 'price_demo_trial',
                'price' => 0,
                'trial' => 1,
                'admin' => 0,
            ],
            [
                'name' => 'Admin',
                'description' => 'Administrative platform access',
                'stripe_api_id' => 'price_demo_admin',
                'price' => 0,
                'trial' => 0,
                'admin' => 1,
            ],
            [
                'name' => 'Standard Monthly',
                'description' => 'Baseline learner access for the billing demo flow.',
                'stripe_api_id' => 'price_demo_standard_monthly',
                'price' => 29,
                'trial' => 0,
                'admin' => 0,
            ],
            [
                'name' => 'Professional Monthly',
                'description' => 'Expanded learner access with premium content bundles.',
                'stripe_api_id' => 'price_demo_professional_monthly',
                'price' => 59,
                'trial' => 0,
                'admin' => 0,
            ],
            [
                'name' => 'Enterprise Monthly',
                'description' => 'Department-level access for executive demo scenarios.',
                'stripe_api_id' => 'price_demo_enterprise_monthly',
                'price' => 99,
                'trial' => 0,
                'admin' => 0,
            ],
        ];

        foreach ($licenses as $license) {
            Licenses::updateOrCreate(
                ['name' => $license['name']],
                $license
            );
        }
    }

    private function seedPermissionsAndRoles(): void
    {
        $permissionNames = [
            'ViewSystem',
            'ViewDeptSystem',
            'ViewSelfSystem',
            'CreateSystem',
            'UpdateSystem',
            'DeleteSystem',
            'ViewContent',
            'ViewDeptContent',
            'ViewSelfContent',
            'UpdateContent',
            'CreateContent',
            'DeleteContent',
            'ViewGrade',
            'ViewDeptGrade',
            'ViewSelfGrade',
            'UpdateGrade',
            'CreateGrade',
            'DeleteGrade',
            'ViewForum',
            'ViewDeptForum',
            'ViewSelfForum',
            'UpdateForum',
            'CreateForum',
            'DeleteForum',
            'ViewAnnounce',
            'ViewDeptAnnounce',
            'ViewSelfAnnounce',
            'UpdateAnnounce',
            'CreateAnnounce',
            'DeleteAnnounce',
        ];

        foreach ($permissionNames as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $allPermissions = Permission::query()->pluck('name')->all();
        $instructorPermissions = [
            'ViewContent',
            'ViewDeptContent',
            'ViewSelfContent',
            'CreateContent',
            'UpdateContent',
            'ViewGrade',
            'ViewDeptGrade',
            'ViewSelfGrade',
            'UpdateGrade',
            'CreateGrade',
            'ViewForum',
            'ViewDeptForum',
            'ViewSelfForum',
            'CreateForum',
            'UpdateForum',
            'ViewAnnounce',
            'ViewDeptAnnounce',
            'ViewSelfAnnounce',
        ];
        $userPermissions = [
            'ViewSelfContent',
            'ViewSelfGrade',
            'ViewSelfForum',
            'CreateForum',
            'ViewSelfAnnounce',
        ];

        $roles = [
            'Support' => $allPermissions,
            'Administrator' => $allPermissions,
            'Instructor' => $instructorPermissions,
            'User' => $userPermissions,
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }

    private function seedSetupKeys(): void
    {
        $setupKeys = [
            'Primary Color' => '#73020c',
            'awards_at_class_complete' => '0',
            'instance_name' => 'Acolyte Demo LMS',
            'allow_class_retakes' => '1',
            'allow_module_retakes' => '1',
            'Support_Email' => 'support-demo@example.com',
            'use_subscriptions' => '1',
            'use_custom_frontend' => '0',
            'num_custom_links' => '0',
        ];

        foreach ($setupKeys as $key => $value) {
            SetupKeys::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'old_value' => SetupKeys::where('key', $key)->value('value'),
                ]
            );
        }
    }

    private function seedContentTypes(): void
    {
        foreach (['Course', 'Class'] as $contentTypeName) {
            Content_Types::firstOrCreate(['name' => $contentTypeName]);
        }
    }
}

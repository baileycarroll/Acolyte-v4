<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DemoMediaSeeder extends Seeder
{
    /**
     * Seed thumbnail, award, and placeholder video assets on the active storage disk.
     */
    public function run(): void
    {
        $disk = Storage::disk(config('filesystems.default'));

        $thumbnailSources = $this->imageSourcePaths();
        $awardSource = $this->existingSourcePath([
            'resources/assets/img/Acolyte-REALMS.png',
            'public/assets/img/Acolyte-REALMS.png',
            'resources/assets/img/Profile.png',
            'public/assets/img/Profile.png',
        ]);

        foreach (Course::all() as $index => $course) {
            $sourcePath = $thumbnailSources[$index % count($thumbnailSources)];
            $disk->put(
                "thumbnails/{$course->name}/{$course->name}.jpg",
                file_get_contents($sourcePath)
            );
        }

        foreach (Classes::all() as $index => $class) {
            $sourcePath = $thumbnailSources[($index + 2) % count($thumbnailSources)];
            $disk->put(
                "thumbnails/classes/{$class->name}/{$class->name}.jpg",
                file_get_contents($sourcePath)
            );

            $classSlug = str_replace(' ', '_', $class->name);
            $disk->put(
                "classes/{$classSlug}/{$classSlug}.mp4",
                $this->videoPlaceholder("Demo class placeholder for {$class->name}")
            );
        }

        foreach (Module::all() as $module) {
            $moduleSlug = str_replace(' ', '_', $module->name);
            $disk->put(
                "modules/{$moduleSlug}/{$moduleSlug}.mp4",
                $this->videoPlaceholder("Demo module placeholder for {$module->name}")
            );
        }

        foreach (Award::all() as $award) {
            $disk->put(
                "awards/{$award->filename}.png",
                file_get_contents($awardSource)
            );
        }
    }

    /**
     * Reuse checked-in image assets so demo thumbnails are deterministic.
     *
     * @return array<int, string>
     */
    private function imageSourcePaths(): array
    {
        $paths = [];

        foreach ([
            'resources/assets/img/blog-bg.jpg',
            'resources/assets/img/calendar.jpg',
            'resources/assets/img/chrisanthemums.jpg',
            'resources/assets/img/event-bg.jpg',
            'resources/assets/img/misty-forest.jpg',
            'resources/assets/img/snapdragon.jpg',
            'resources/assets/img/staff-bg.jpg',
            'resources/assets/img/violets.jpg',
            'public/assets/img/blog-bg.jpg',
            'public/assets/img/calendar.jpg',
        ] as $relativePath) {
            $absolutePath = base_path($relativePath);

            if (is_file($absolutePath)) {
                $paths[] = $absolutePath;
            }
        }

        if ($paths === []) {
            $fallbackPath = storage_path('app/demo-fallback-thumbnail.jpg');
            file_put_contents($fallbackPath, base64_decode('/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQEBAQEA8QDw8QDw8PEA8PDw8PDw8PFREWFhURFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OGxAQGy0mICYtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAAEAAgMBIgACEQEDEQH/xAAXAAEBAQEAAAAAAAAAAAAAAAABAgME/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEh/9oADAMBAAIQAxAAAAH4bM0f/8QAGhAAAgMBAQAAAAAAAAAAAAAAAQIAAxESIf/aAAgBAQABBQJfTmyR7kn/xAAVEQEBAAAAAAAAAAAAAAAAAAAQIf/aAAgBAwEBPwEf/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEh/9oACAECAQE/AR//xAAaEAACAwEBAAAAAAAAAAAAAAABEQAhMUFh/9oACAEBAAY/AjwStJdI1i//xAAaEAADAQEBAQAAAAAAAAAAAAABESExQVFh/9oACAEBAAE/IRBKkgJQ9cwDwNw4RrRkqv/aAAwDAQACAAMAAAAQ6D//xAAVEQEBAAAAAAAAAAAAAAAAAAAQIf/aAAgBAwEBPxAf/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEh/9oACAECAQE/EB//xAAaEAEAAwEBAQAAAAAAAAAAAAABABEhMUFh/9oACAEBAAE/EKQ6o6sT6t0qmoS6MZaKQw6uP//Z'));
            $paths[] = $fallbackPath;
        }

        return $paths;
    }

    private function existingSourcePath(array $relativePaths): string
    {
        foreach ($relativePaths as $relativePath) {
            $absolutePath = base_path($relativePath);

            if (is_file($absolutePath)) {
                return $absolutePath;
            }
        }

        return $this->imageSourcePaths()[0];
    }

    private function videoPlaceholder(string $label): string
    {
        return "Demo media placeholder\n{$label}\nReplace this file with a real MP4 before production demos that require playback.";
    }
}

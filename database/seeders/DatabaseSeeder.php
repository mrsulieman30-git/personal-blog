<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);

        // 2. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@blog.test'],
            [
                'name' => 'Mohammad Sulieman Ibrahim',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Super Admin');

        // 3. Initial Site Settings
        $settings = [
            'site_name' => 'Mohammad Sulieman Ibrahim',
            'site_tagline' => 'Full Stack Developer & Writer',
            'site_description' => 'Personal blog and portfolio of Mohammad Sulieman Ibrahim. Sharing insights on software engineering, web development, and tech.',
            'author_name' => 'Mohammad Sulieman Ibrahim',
            'author_title' => 'Full Stack Developer & Tech Creator',
            'author_bio' => 'Passionate software engineer and creator. Building scalable web applications, designing user-centered experiences, and writing about modern web technologies.',
            'author_email' => 'mohammad@example.com',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
            'twitter_url' => 'https://twitter.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }

        // 4. Sample Blog Categories
        $catWebDev = BlogCategory::firstOrCreate(['slug' => 'web-development'], ['name' => 'Web Development']);
        $catArchitecture = BlogCategory::firstOrCreate(['slug' => 'software-architecture'], ['name' => 'Software Architecture']);
        $catTutorials = BlogCategory::firstOrCreate(['slug' => 'tutorials'], ['name' => 'Tutorials & Guides']);

        // 5. Sample Blog Posts
        $posts = [
            [
                'title' => 'Building Modern Web Applications with Laravel 12 & Livewire 3',
                'slug' => 'building-modern-web-applications-with-laravel-12',
                'excerpt' => 'An in-depth look at how Laravel 12 and Livewire 3 simplify full-stack web development without sacrificing performance or developer productivity.',
                'content' => '<h2>Introduction to Modern Full-Stack Laravel</h2><p>Laravel 12 brings a fresh set of developer productivity enhancements, pairing perfectly with Livewire 3 for reactive frontend interfaces without complex JavaScript build setups.</p><h3>Why Livewire 3?</h3><p>Livewire 3 introduces Alpine.js integration by default, simplified state management, morphing DOM updates, and instant client-side transitions.</p><pre><code>php artisan make:livewire ProjectsIndex</code></pre><p>With built-in SPA navigation powered by Livewire Wire Navigate, building fast, rich web apps has never been smoother.</p>',
                'blog_category_id' => $catWebDev->id,
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views' => 142,
                'likes_count' => 18,
                'featured_image_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Mastering Filament v3: Creating Elegant Admin Panels Fast',
                'slug' => 'mastering-filament-v3-admin-panels',
                'excerpt' => 'Discover how Filament v3 empowers developers to craft custom, responsive admin dashboards and CMS controls with minimal effort.',
                'content' => '<h2>The Power of Filament v3</h2><p>Filament v3 is standardizing Laravel admin panels. Its intuitive resource structure and form components let you build CMS features in minutes.</p><h3>Key Features</h3><ul><li>Built-in Form Builder & Table Builder</li><li>Livewire 3 native support</li><li>Custom Dashboard Widgets & Stats</li></ul>',
                'blog_category_id' => $catTutorials->id,
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => 98,
                'likes_count' => 12,
                'featured_image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Designing Scalable Application Architecture for the Web',
                'slug' => 'designing-scalable-application-architecture',
                'excerpt' => 'Key architectural principles for building maintainable, high-performance web systems that scale effortlessly.',
                'content' => '<h2>Principles of Clean Architecture</h2><p>Designing applications requires balancing domain logic, data persistence, and interface layers.</p><p>By separating concerns into clear services and action classes, your codebase stays testable and adaptable over time.</p>',
                'blog_category_id' => $catArchitecture->id,
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'views' => 210,
                'likes_count' => 29,
                'featured_image_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($posts as $postData) {
            BlogPost::firstOrCreate(['slug' => $postData['slug']], $postData);
        }

        // 6. Sample Projects
        $projects = [
            [
                'title' => 'seeha.tech (SEHTECH)',
                'slug' => 'sehtech-healthcare-platform',
                'description' => 'A startup platform providing intelligent, scalable software solutions for healthcare systems, medical clinics, and digital patient care records.',
                'url' => 'https://seeha.tech',
                'technologies' => ['Laravel', 'Filament', 'Livewire', 'Tailwind CSS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'umyusuf.seeha.tech (Um Yusuf)',
                'slug' => 'um-yusuf-quran-school',
                'description' => 'A comprehensive management platform designed for Holy Quran schools, facilitating student registrations, teacher allocations, progress tracking, and administrative tasks.',
                'url' => 'https://umyusuf.seeha.tech',
                'technologies' => ['Laravel', 'Livewire', 'Filament', 'MySQL'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Kaafi Hospitals Portal',
                'slug' => 'kaafi-hospitals-portal',
                'description' => 'Healthcare platform featuring online booking systems, department directories, and patient management portal.',
                'url' => 'https://kaafihospitals.so',
                'technologies' => ['Laravel', 'Filament', 'Livewire', 'MySQL'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Sulieman Academy Platform',
                'slug' => 'sulieman-academy-platform',
                'description' => 'E-Learning platform offering interactive courses, video lessons, and automated progress tracking.',
                'url' => 'https://example.com',
                'technologies' => ['React', 'Laravel API', 'Tailwind CSS'],
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $projData) {
            Project::firstOrCreate(['slug' => $projData['slug']], $projData);
        }

        // 7. Sample CMS Page
        Page::firstOrCreate(
            ['slug' => 'terms-of-service'],
            [
                'title' => 'Terms of Service',
                'content' => '<h2>Terms & Conditions</h2><p>Welcome to Mohammad Sulieman Ibrahim\'s personal blog. By accessing this site, you agree to these terms.</p><h3>Content Usage</h3><p>All articles and code snippets published here are shared for educational and informational purposes.</p>',
                'is_published' => true,
                'meta_title' => 'Terms of Service — Mohammad Sulieman Ibrahim',
                'meta_description' => 'Terms of service and content usage policy.',
            ]
        );
    }
}

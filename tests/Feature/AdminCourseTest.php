<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminCourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_course_create_page_has_required_form_data(): void
    {
        $admin = User::factory()->admin()->create();
        DB::table('course_categories')->insert([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.courses.create'))
            ->assertOk()
            ->assertSee('Select Instructor')
            ->assertSee($admin->name)
            ->assertSee('Web Development');
    }

    public function test_admin_course_edit_page_has_required_form_data(): void
    {
        $admin = User::factory()->admin()->create();
        $categoryId = DB::table('course_categories')->insertGetId([
            'name' => 'Software Development',
            'slug' => 'software-development',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $course = Course::create([
            'title' => 'Laravel Masterclass',
            'slug' => 'laravel-masterclass',
            'type' => 'free',
            'instructor_id' => $admin->id,
            'category_id' => $categoryId,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.courses.edit', $course))
            ->assertOk()
            ->assertSee($admin->name)
            ->assertSee('Software Development');
    }
}

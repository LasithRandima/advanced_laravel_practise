<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstructorTest extends TestCase
{
  public function test_instructor_is_redirected_to_instructor_dashboard()
  {
    $user = User::factory()->create([
        'role' => 'instructor',
    ]);

    // use actingAs if you want to authenticate the user before making the request
    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertRedirectToRoute('instructor.dashboard');

    $this->followRedirects($response)
        ->assertSeeText('Hey Instructor');


    }

    public function test_instructor_can_schedule_a_class(){
        // Given
        $user = User::factory()->create([
            'role' => 'instructor',
        ]);

        // $this->seed(ClassTypeSeeder::class);


        // When
        $response = $this->actingAs($user)->post('/instructor/schedule', [
            'class_type_id' => 1,
            'date' => '2024-06-14',
            'time' => '08:00',
        ]);

        // Then
        $response->assertRedirectToRoute('schedule.index');


    }
}

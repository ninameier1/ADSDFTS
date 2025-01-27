<?php

namespace Tests\Feature;

use App\Models\Festival;
use App\Models\User;
use App\Models\Bus;
use App\Models\BusTicket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreBusTicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_book_tickets_for_a_festival()
    {
        // Arrange: Create necessary data
        $user = User::factory()->create(['points' => 1000]);
        $festival = Festival::factory()->create();
        $bus = Bus::factory()->create([
            'festival_id' => $festival->id,
            'status' => 'reserve',
            'starting_point' => 'Amsterdam'
        ]);

        // Act: Make a POST request to store tickets
        $response = $this->actingAs($user)->post(route('bustickets.store'), [
            'from' => 'Amsterdam',
            'festival_id' => $festival->id,
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'quantity' => 1,
            'paymentOption' => 'points',
            'terms' => 1,
        ]);

        // Assert: Check if tickets were created and response is correct
        $response->assertRedirect(route('bustickets.index'));
        $response->assertSessionHas('success', '1 ticket(s) booked successfully!');

        // Assert that the user's points were deducted
        $user->refresh();
        $this->assertEquals(100, $user->points);
    }

    /** @test */
    public function it_shows_error_when_not_enough_points()
    {
        // Arrange: Create necessary data with insufficient points
        $user = User::factory()->create(['points' => 500]);
        $festival = Festival::factory()->create();
        $bus = Bus::factory()->create([
            'festival_id' => $festival->id,
            'status' => 'reserve',
            'starting_point' => 'Amsterdam'
        ]);

        // Act: Make a POST request to store tickets
        $response = $this->actingAs($user)->post(route('bustickets.store'), [
            'from' => 'Amsterdam',
            'festival_id' => $festival->id,
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'quantity' => 2,
            'paymentOption' => 'points',
        ]);

        // Assert: Check if the correct error message is returned
        $response->assertRedirect();
        $response->assertSessionHasErrors('insufficient_points');
    }
}


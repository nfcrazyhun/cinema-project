<?php

use App\Models\Screening;
use App\Models\Movie;

test('store method validates required fields', function () {
    $response = $this->post(route('screenings.store'), []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['movie_id', 'starts_at', 'seats']);
});

test('store method validates movie_id exists', function () {
    $data = [
        'movie_id' => 999, // Non-existent movie ID
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => 100,
    ];

    $response = $this->post(route('screenings.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['movie_id']);
});

test('store method validates starts_at date', function () {
    $data = [
        'movie_id' => Movie::factory()->create()->id,
        'starts_at' => 'INVALID_DATE', // Invalid date
        'seats' => 100,
    ];

    $response = $this->post(route('screenings.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['starts_at']);
});

test('store method validates starts_at after now', function () {
    $data = [
        'movie_id' => Movie::factory()->create()->id,
        'starts_at' => now()->subHour()->format('Y-m-d H:i:s'), // Date in the past
        'seats' => 100,
    ];

    $response = $this->post(route('screenings.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['starts_at']);
});

test('store method validates seats integer', function () {
    $data = [
        'movie_id' => Movie::factory()->create()->id,
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => 'INVALID_SEATS', // Invalid integer
    ];

    $response = $this->post(route('screenings.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['seats']);
});

test('store method validates seats min value', function () {
    $data = [
        'movie_id' => Movie::factory()->create()->id,
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => -1, // Invalid min value
    ];

    $response = $this->post(route('screenings.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['seats']);
});

test('update method validates required fields', function () {
    $screening = Screening::factory()->create();
    $response = $this->put(route('screenings.update', $screening), []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['movie_id', 'starts_at', 'seats']);
});

test('update method validates movie_id exists', function () {
    $screening = Screening::factory()->create();
    $data = [
        'movie_id' => 999, // Non-existent movie ID
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => 100,
    ];

    $response = $this->put(route('screenings.update', $screening), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['movie_id']);
});

test('update method validates starts_at date', function () {
    $screening = Screening::factory()->create();
    $data = [
        'movie_id' => $screening->movie_id,
        'starts_at' => 'INVALID_DATE', // Invalid date
        'seats' => 100,
    ];

    $response = $this->put(route('screenings.update', $screening), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['starts_at']);
});

test('update method validates starts_at after now', function () {
    $screening = Screening::factory()->create();
    $data = [
        'movie_id' => $screening->movie_id,
        'starts_at' => now()->subHour()->format('Y-m-d H:i:s'), // Date in the past
        'seats' => 100,
    ];

    $response = $this->put(route('screenings.update', $screening), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['starts_at']);
});

test('update method validates seats integer', function () {
    $screening = Screening::factory()->create();
    $data = [
        'movie_id' => $screening->movie_id,
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => 'INVALID_SEATS', // Invalid integer
    ];

    $response = $this->put(route('screenings.update', $screening), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['seats']);
});

test('update method validates seats min value', function () {
    $screening = Screening::factory()->create();
    $data = [
        'movie_id' => $screening->movie_id,
        'starts_at' => now()->addHour()->format('Y-m-d H:i:s'),
        'seats' => -1, // Invalid min value
    ];

    $response = $this->put(route('screenings.update', $screening), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['seats']);
});

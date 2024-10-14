<?php

use App\Models\Movie;
use App\Enums\Language;
use App\Enums\Rating;

test('store method validates required fields', function () {
    $response = $this->post(route('movies.store'), []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['title', 'description', 'rating', 'language']);
});

test('store method validates title max length', function () {
    $data = [
        'title' => str_repeat('A', 256), // Exceeds max length
        'description' => 'This is a test movie',
        'rating' => Rating::PG->value,
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->post(route('movies.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['title']);
});

test('store method validates description max length', function () {
    $data = [
        'title' => 'Test Movie',
        'description' => str_repeat('A', 501), // Exceeds max length
        'rating' => Rating::PG->value,
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->post(route('movies.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['description']);
});

test('store method validates rating enum', function () {
    $data = [
        'title' => 'Test Movie',
        'description' => 'This is a test movie',
        'rating' => 'INVALID_RATING', // Invalid rating
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->post(route('movies.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['rating']);
});

test('store method validates language enum', function () {
    $data = [
        'title' => 'Test Movie',
        'description' => 'This is a test movie',
        'rating' => Rating::PG->value,
        'language' => 'INVALID_LANGUAGE', // Invalid language
    ];

    $response = $this->post(route('movies.store'), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['language']);
});

test('update method validates required fields', function () {
    $movie = Movie::factory()->create();
    $response = $this->put(route('movies.update', $movie), []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['title', 'description', 'rating', 'language']);
});

test('update method validates title max length', function () {
    $movie = Movie::factory()->create();
    $data = [
        'title' => str_repeat('A', 256), // Exceeds max length
        'description' => 'This is an updated movie',
        'rating' => Rating::PG->value,
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->put(route('movies.update', $movie), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['title']);
});

test('update method validates description max length', function () {
    $movie = Movie::factory()->create();
    $data = [
        'title' => 'Updated Movie',
        'description' => str_repeat('A', 501), // Exceeds max length
        'rating' => Rating::PG->value,
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->put(route('movies.update', $movie), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['description']);
});

test('update method validates rating enum', function () {
    $movie = Movie::factory()->create();
    $data = [
        'title' => 'Updated Movie',
        'description' => 'This is an updated movie',
        'rating' => 'INVALID_RATING', // Invalid rating
        'language' => Language::ENGLISH->value,
    ];

    $response = $this->put(route('movies.update', $movie), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['rating']);
});

test('update method validates language enum', function () {
    $movie = Movie::factory()->create();
    $data = [
        'title' => 'Updated Movie',
        'description' => 'This is an updated movie',
        'rating' => Rating::PG->value,
        'language' => 'INVALID_LANGUAGE', // Invalid language
    ];

    $response = $this->put(route('movies.update', $movie), $data);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['language']);
});

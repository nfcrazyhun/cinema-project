<?php

use App\Models\Movie;
use Illuminate\Http\UploadedFile;
use App\Enums\Language;
use App\Enums\Rating;

test('index method returns movie collection', function () {
    $movies = Movie::factory(3)->create();

    $response = $this->get(route('movies.index'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        '*' => [
            'id',
            'title',
            'description',
            'rating',
            'language',
            'poster_url',
            'screenings',
        ],
    ]);
});

test('store method creates new movie', function () {
    $data = [
        'title' => 'Test Movie',
        'description' => 'This is a test movie',
        'rating' => Rating::PG->value,
        'language' => Language::ENGLISH->value,
        'poster' => UploadedFile::fake()->image('poster.jpg'),
    ];

    $response = $this->post(route('movies.store'), $data);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'id',
        'title',
        'description',
        'rating',
        'language',
        'poster_url',
    ]);
});

test('show method returns movie resource', function () {
    $movie = Movie::factory()->create();

    $response = $this->get(route('movies.show', $movie));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'id',
        'title',
        'description',
        'rating',
        'language',
        'poster_url',
    ]);
});

test('update method updates movie', function () {
    $movie = Movie::factory()->create();
    $data = [
        'title' => 'Updated Movie',
        'description' => 'This is an updated movie',
        'rating' => Rating::PG_13->value,
        'language' => Language::SPANISH->value,
        'poster' => UploadedFile::fake()->image('updated_poster.jpg'),
    ];

    $response = $this->put(route('movies.update', $movie), $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'id',
        'title',
        'description',
        'rating',
        'language',
        'poster_url',
    ]);
});

test('destroy method deletes movie', function () {
    $movie = Movie::factory()->create();

    $response = $this->delete(route('movies.destroy', $movie));

    $response->assertStatus(204);
    expect(Movie::find($movie->id))->toBeNull();
});

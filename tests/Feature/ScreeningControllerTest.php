<?php

use App\Models\Movie;
use App\Models\Screening;

it('can list screenings', function () {
    Screening::factory(3)->create();

    $response = $this->getJson(route('screenings.index'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        '*' => [
            'id',
            'movie_id',
            'starts_at',
            'seats',
        ],
    ]);
});

it('can store a screening', function () {
    $movie = Movie::factory()->create();

    $data = [
        'movie_id' => $movie->id,
        'starts_at' => now()->addHour(),
        'seats' => 100,
    ];

    $response = $this->postJson(route('screenings.store'), $data);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'id',
        'movie_id',
        'starts_at',
        'seats',
    ]);
});

it('can show a screening', function () {
    $screening = Screening::factory()->create();

    $response = $this->getJson(route('screenings.show', $screening));

    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $screening->id,
            'movie_id' => $screening->movie_id,
            'starts_at' => $screening->starts_at->toISOString(),
            'seats' => $screening->seats,
        ]);
});

it('can update a screening', function () {
    $screening = Screening::factory()->create();

    $data = [
        'movie_id' => $screening->movie_id,
        'starts_at' => now()->addHours(2),
        'seats' => 150,
    ];

    $response = $this->putJson(route('screenings.update', $screening), $data);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'id',
        'movie_id',
        'starts_at',
        'seats',
    ]);
});

it('can destroy a screening', function () {
    $screening = Screening::factory()->create();

    $response = $this->deleteJson(route('screenings.destroy', $screening));

    $response->assertStatus(204);
    expect(Screening::find($screening->id))->toBeNull();
});

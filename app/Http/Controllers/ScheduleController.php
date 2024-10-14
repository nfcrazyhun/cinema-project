<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    /**
     * Retrieves a collection of movies that have screenings scheduled within the next 7 days.
     */
    public function index(): JsonResponse
    {
        $movies = [];

        for ($i = 0; $i < 7; $i++) {
            $screenings = Movie::query()
            ->whereHas('screenings', function($query) use ($i) {
                $query->whereDate('starts_at', now()->addDays($i));
            })->with(['screenings' => function($query) use ($i) {
                $query->whereDate('starts_at', now()->addDays($i))
                    ->orderBy('starts_at');
            }])->get()
                ->transform(fn($movie) => MovieResource::make($movie));

            $movies[now()->addDays($i)->toDateString()] = $screenings;
        }

        return response()->json($movies);
    }
}

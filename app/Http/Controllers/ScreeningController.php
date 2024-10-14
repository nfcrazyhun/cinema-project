<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use App\Http\Requests\StoreScreeningRequest;
use App\Http\Requests\UpdateScreeningRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $screenings = Screening::with('movie')
            ->whereDate('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->get();

        return ScreeningResource::collection($screenings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScreeningRequest $request): ScreeningResource
    {
        $screening = Screening::create($request->validated());

        return new ScreeningResource($screening);
    }

    /**
     * Display the specified resource.
     */
    public function show(Screening $screening): ScreeningResource
    {
        $screening->load('movie');

        return new ScreeningResource($screening);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScreeningRequest $request, Screening $screening): ScreeningResource
    {
        $screening->update($request->validated());

        return new ScreeningResource($screening);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screening $screening): Response
    {
        $screening->delete();

        return response()->noContent();
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Intrfce\LaravelFrontendEnums\Facades\PublishEnums;
use Symfony\Component\Finder\Finder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Publish Enums to Javascript - Start
        $finder = Finder::create()->files()->in(app_path('Enums'))->name('*.php');
        $enums = collect($finder)->map(function ($file) {
            return "App\\Enums\\{$file->getBasename('.php')}";  //eg. App\Enums\AccountType,
        })->values()->toArray();
        PublishEnums::publish($enums)->toDirectory(resource_path('js/Enums'));
        // Publish Enums to Javascript - END
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set strict mode for all models.
        Model::shouldBeStrict();

        // Disable wrapping of the outer-most resource array.
        JsonResource::withoutWrapping();
    }
}

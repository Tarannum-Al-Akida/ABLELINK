<?php

namespace App\Providers;

use App\Services\Ocr\OcrEngine;
use App\Services\Ocr\TesseractOcrEngine;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OcrEngine::class, static fn () => new TesseractOcrEngine());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

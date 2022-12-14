<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use LaravelPWA\Http\Controllers\LaravelPWAController as PWA;
use LaravelPWA\Services\ManifestService;

class RectifyPWAController extends PWA
{
    public function manifestJson()
    {
        $output = (new ManifestService)->generate();

        return Storage::disk('public')->put('manifest.json', json_encode($output));
    }
}

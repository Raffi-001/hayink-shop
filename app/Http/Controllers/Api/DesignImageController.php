<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesignImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignImageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch all design images for this user
        $designImages = DesignImage::where('user_id', $user->id)->get();

        // Build FPD-compatible structure
        $response = [
            [
                'title' => 'My Uploads',
                'items' => $designImages->flatMap(function ($designImage) {
                    return $designImage->getMedia()->map(function ($media) {
                        return [
                            'source' => $media->getUrl(),   // full URL to the file
                            'title'  => $media->name ?? 'Upload'
                        ];
                    });
                })->values()->toArray()
            ]
        ];

        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectImage;

class ProjectImagesController extends Controller
{
    public function create(Request $request)
    {
        $projectImage = ProjectImage::create($request->all());
        return response()->json(['project-image' => $projectImage]);
    }
}

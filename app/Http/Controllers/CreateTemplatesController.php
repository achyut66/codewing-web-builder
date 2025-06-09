<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CreateTemplate; 
use Inertia\Inertia;

class CreateTemplatesController extends Controller
{
    public function index()
    {
        return inertia('Templates/Index');
    }

    public function fetchTemplates(): JsonResponse
{
    $json = File::get(resource_path('data/templates.json'));
    $templates = json_decode($json, true);
    return response()->json([
        'templates' => $templates,
    ]);
}
public function store(Request $request): JsonResponse
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'domain' => 'required|string',
        'design' => 'nullable|string',
        'user_id' => 'required|integer',
        'template_id' => 'required|integer',
        'thumbnail' => 'nullable|image|max:2048',
    ]);

    $template = CreateTemplate::create($data);
    return response()->json([
        'message' => 'Template created successfully',
        'template' => $template,
    ], 201);
}

public function get_template_by_id($id)
{
    $data = CreateTemplate::find($id);
    if (!$data) {
        return response()->json(['message' => 'Template not found'], 404);
    }
    $json = File::get(resource_path('data/templates.json'));
    $templates = json_decode($json, true);
    $matchedTemplate = collect($templates)->firstWhere('template_id', $data->template_id);

    if (!$matchedTemplate) {
        return response()->json(['message' => 'Matching template not found in JSON'], 404);
    }
    $matchedTemplate['db_info'] = $data;
    return Inertia::render('Templates/Contents/SiteContent', [
        'template' => $matchedTemplate,
    ]);
}
public function get_template_by_user_id(Request $request)
{
    $userId = $request->input('user_id');
    if (!$userId) {
        return response()->json(['error' => 'User ID is required'], 400);
    }
    if ($userId == 1) {
            $templates = CreateTemplate::all();
        } else {
            $templates = CreateTemplate::where('user_id', $userId)->get();
        }
    if ($templates->isEmpty()) {
        return response()->json(['message' => 'No templates found for this user'], 404);
    }
    return response()->json([
        'user_id' => $userId,
        'templates' => $templates,
    ]);
}


}

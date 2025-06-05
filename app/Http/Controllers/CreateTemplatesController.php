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
        'template_id' => 'required|integer',
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
}

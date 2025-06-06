<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateContent;

class ContentsController extends Controller
{
    public function updatePage(Request $request)
{
    $templateId = $request->input('template_id');
    $userId = $request->input('user_id');
    $data = $request->except(['template_id', 'user_id']); // Extract content data only

    if (!$templateId || !$userId) {
        return response()->json(['error' => 'Template ID and User ID are required'], 400);
    }

    // Corrected: Merge template_id and user_id as attributes to match
    $templateContent = \App\Models\TemplateContent::updateOrCreate(
        ['template_id' => $templateId, 'user_id' => $userId],
        ['data' => $data]
    );

    return response()->json([
        'message' => 'Content saved successfully',
        'content' => $templateContent,
    ]);
}

public function getByUserId(Request $request)
{
    $userId = $request->input('user_id');
    $templateId = $request->input('template_id');

    if (!$userId || !$templateId) {
        return response()->json(['error' => 'Both user_id and template_id are required'], 400);
    }

    $contents = TemplateContent::where('user_id', $userId)
                               ->where('template_id', $templateId)
                               ->get();

    return response()->json([
        'user_id' => $userId,
        'template_id' => $templateId,
        'templates' => $contents,
    ]);
}

public function fetchTemplatesOnlyByUserId(Request $request)
{
    $userId = $request->input('user_id');
    if (!$userId) {
        return response()->json(['error' => 'User ID is required'], 400);
    }
    $templates = TemplateContent::where('user_id', $userId)->get();
    return response()->json([
        'user_id' => $userId,
        'templates' => $templates,
    ]);

}
}

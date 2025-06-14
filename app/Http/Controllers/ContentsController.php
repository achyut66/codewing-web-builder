<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateContent;
use Illuminate\Support\Facades\Storage;
use App\Models\CreateTemplate; 
use Intervention\Image\Facades\Image;


class ContentsController extends Controller
{

public function updatePage(Request $request)
{
    $request->validate([
        'template_id' => 'required',
        'user_id' => 'required|exists:users,id',
        'hero_image' => 'nullable|image|max:2048',
    ]);

    $heroImagePath = null;
    $thumbnailPath = null;

    if ($request->hasFile('hero_image')) {
        $heroImagePath = $request->file('hero_image')->store('template_images', 'public');

        $image = Image::make(storage_path('app/public/' . $heroImagePath))->fit(300, 200);
        $thumbnailName = 'thumb_' . basename($heroImagePath);
        $thumbnailPath = 'template_thumbnails/' . $thumbnailName;

        Storage::disk('public')->put($thumbnailPath, (string) $image->encode());
        $publicThumbnailUrl = Storage::url($thumbnailPath);

        CreateTemplate::updateOrCreate(
            ['id' => $request->template_id],
            ['thumbnail' => $publicThumbnailUrl]
        );
    }

    $template = TemplateContent::firstOrNew([
        'template_id' => $request->template_id,
        'user_id' => $request->user_id,
    ]);

    $template->data = [
        'navbar' => json_decode($request->navbar, true),
        'hero' => [
            'title' => $request->hero_title,
            'subtitle' => $request->hero_subtitle,
            'backgroundImage' => $heroImagePath
                ? Storage::url($heroImagePath)
                : data_get($template->data, 'hero.backgroundImage'),
        ],
        'mainContent' => [
            'heading' => $request->main_heading,
            'content' => $request->main_content,
        ],
        'contactContent' => [
            'heading' => $request->contact_heading,
            'content' => $request->contact_content,
        ],
        'portfolioContent' => [
            'heading' => $request->portfolio_heading,
            'content' => $request->portfolio_content,
        ],
        'footer' => [
            'text' => $request->footer_text,
        ],
    ];

    $template->save();
    return response()->json(['message' => 'Content saved successfully!']);
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

    if ($userId == 1) {
        $templates = TemplateContent::all();
    } else {
        $templates = TemplateContent::where('user_id', $userId)->get();
    }
    return response()->json([
        'user_id' => $userId,
        'templates' => $templates,
    ]);
}

public function getTemplateDetailsByTemplateId($id)
{
    if (!$id) {
        return response()->json(['error' => 'Template ID is required'], 400);
    }

    $template = TemplateContent::where('template_id', $id)->first();

    if (!$template) {
        return response()->json(['message' => 'Template not found'], 404);
    }

    return response()->json([
        'template_id' => $id,
        'template' => $template,
    ]);
}

// public function getTemplatesByUserIdAndFlag(Request $request)
// {
//     // $userId = $request->input('user_id');
//     $flag = 1;
//     if (!isset($flag)) {
//         return response()->json(['error' => 'Both user_id and flag are required'], 400);
//     }
//     $templates = TemplateContent::where('flag', $flag)
//                                 ->get();
//     return response()->json([
//         'flag' => $flag,
//         'templates' => $templates,
//     ]);
// }
}

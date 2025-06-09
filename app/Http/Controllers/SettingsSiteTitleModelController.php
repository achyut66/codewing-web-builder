<?php

namespace App\Http\Controllers;

use App\Models\SettingsSiteTitleModel;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class SettingsSiteTitleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Settings/SiteTitle', [
        'settings' => SettingsSiteTitleModel::all(),
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'site_title' => 'required|string',
        'site_description' => 'nullable|string',
        'site_keywords' => 'nullable|string',
        'site_logo' => 'nullable|image',
        'favicon' => 'nullable|image',
    ]);

    if ($request->hasFile('site_logo')) {
        $data['site_logo'] = $request->file('site_logo')->store('logos', 'public');
    }

    if ($request->hasFile('favicon')) {
        $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
    }

    SettingsSiteTitleModel::create($data);

    return back()->with('success', 'Setting saved successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingsSiteTitleModel  $settingsSiteTitleModel
     * @return \Illuminate\Http\Response
     */
    public function show(SettingsSiteTitleModel $settingsSiteTitleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingsSiteTitleModel  $settingsSiteTitleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingsSiteTitleModel $settingsSiteTitleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingsSiteTitleModel  $settingsSiteTitleModel
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, SettingsSiteTitleModel $setting)
{
    $data = $request->validate([
        'site_title' => 'required|string|max:255',
        'site_description' => 'nullable|string',
        'site_keywords' => 'nullable|string',
        'site_logo' => 'nullable|image|max:2048',
        'favicon' => 'nullable|image|max:1024',
    ]);

    if ($request->hasFile('site_logo')) {
        if ($setting->site_logo) {
            Storage::disk('public')->delete($setting->site_logo);
        }
        $data['site_logo'] = $request->file('site_logo')->store('logos', 'public');
    }

    if ($request->hasFile('favicon')) {
        if ($setting->favicon) {
            Storage::disk('public')->delete($setting->favicon);
        }
        $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
    }

    $setting->update($data);

    return redirect()->back()->with('success', 'Setting updated.');
}

public function destroy(SettingsSiteTitleModel $setting)
{
    if ($setting->site_logo) {
        Storage::disk('public')->delete($setting->site_logo);
    }
    if ($setting->favicon) {
        Storage::disk('public')->delete($setting->favicon);
    }
    $setting->delete();
    return redirect()->back()->with('success', 'Setting deleted.');
}
}

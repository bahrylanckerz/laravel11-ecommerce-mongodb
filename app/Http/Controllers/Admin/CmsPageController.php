<?php

namespace App\Http\Controllers\Admin;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('menu', 'pages-management');
        Session::put('page', 'cms-pages');
        $cmsPages = CmsPage::get();
        $data['cmsPages'] = $cmsPages;
        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title'       => 'required',
                'url'         => 'required|lowercase',
                'description' => 'required',
            ], [
                'title.required'       => 'Title is required.',
                'url.required'         => 'URL is required.',
                'url.lowercase'        => 'URL must be lowercase.',
                'description.required' => 'Description is required.',
            ]);
            CmsPage::create([
                'title'       => $request->title,
                'url'         => str_replace(' ', '-', $request->url),
                'description' => $request->description,
                'status'      => 1,
            ]);
            return redirect('admin/cms-pages')->with('success', 'CMS Pages created successfully');
        }
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $cmsPage = CmsPage::find($id);
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title'       => 'required',
                'url'         => 'required|lowercase',
                'description' => 'required',
            ], [
                'title.required'       => 'Title is required.',
                'url.required'         => 'URL is required.',
                'url.lowercase'        => 'URL must be lowercase.',
                'description.required' => 'Description is required.',
            ]);
            CmsPage::where('id', $id)->update([
                'title'       => $request->title,
                'url'         => str_replace(' ', '-', $request->url),
                'description' => $request->description,
            ]);
            return redirect('admin/cms-pages')->with('success', 'CMS Pages updated successfully');
        }
        $data['cmsPage'] = $cmsPage;
        return view('admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        //
    }

    public function updateStatus($status, $id)
    {
        CmsPage::where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id', $id)->delete();
        return redirect('admin/cms-pages')->with('success', 'CMS Pages deleted successfully');
    }
}

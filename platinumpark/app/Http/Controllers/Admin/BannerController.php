<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\BannerImages;
use Illuminate\Http\Request;
use App\Traits\SessionsTraits;
use App\Traits\ProcessImageTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller {

    use SessionsTraits,
        ProcessImageTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $banner = Banner::all();

        return view("admin.banner.index", compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create() {
    //     return view('admin.banner.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            "title" => "required",
            'thumbnail' => 'required|image|max:2048',
        ]);

        $bannerAll= Banner::all();
        $sequence = count($bannerAll) + 1;

        $string = str_replace(' ', '-', $request->get('title'));
        
        
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);

        $upload_path_desktop = 'uploads/banner/';
        if (!$request->hasFile('thumbnail')) {
            $thumbnail =  '';
        } else {
            $file      = $request->file('thumbnail');
            $file_name_desktop = 'image_desktop' . '_' . time() . '.' . $file->extension();
            $upload_success = $file->move($upload_path_desktop, $file_name_desktop); 
            if (!$upload_success) {
                return redirect()->route("admin.banner.index")->with("failure", "Error when tried to save image.");
            }
            $thumbnail = $upload_path_desktop . $file_name_desktop;
        }


        $banner = new Banner;
        $banner->title = $request->get('title');
        $banner->slug = strtolower($string);
        $banner->thumbnail = $thumbnail;
        $banner->sequence = $sequence;
        $banner->save();

        Session::flash('success', 'Banner has been added!');
        return redirect()->route("admin.banner.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner) {

        $banner_images = BannerImages::where('banner_id', $banner->id)->orderBy('sequence', 'asc')->get();

        return view('admin.banner.show',  compact('banner', 'banner_images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner) {
        $banner = Banner::where('id',$banner->id)->first() ?? '';

        $all_banner =  Banner::all();

        return view('admin.banner.edit',  compact('banner','all_banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner) {

        $this->validate($request, [
            "title" => "required",
            "slug" => "required",
            'thumbnail' => 'image|max:2048',
        ]);

        $upload_path_desktop = 'uploads/banner/';
        if (!$request->hasFile('thumbnail')) {
            $thumbnail =  $request->get('exist_thumbnail');
        } else {
            $file      = $request->file('thumbnail');
            $file_name_desktop = 'image_desktop' . '_' . time() . '.' . $file->extension();
            $upload_success = $file->move($upload_path_desktop, $file_name_desktop); // uploading file to given path
            if (!$upload_success) {
                return redirect()->route("admin.banner.index")->with("failure", "Error when tried to save image.");
            }
            $thumbnail = $upload_path_desktop . $file_name_desktop;
        }
        
        $banner->title = $request->get('title');
        $banner->slug = $request->get('slug');
        $banner->thumbnail = $thumbnail;

        $sequence = $request->get("sequence");

        if ($sequence < $banner->sequence) {
            Banner::where('sequence', '>=', $sequence)
                    ->where('sequence', '<', $banner->sequence)
                    ->increment('sequence');
        } else if ($sequence > $banner->sequence) {
            Banner::where('sequence', '<=', $sequence)
                    ->where('sequence', '>', $banner->sequence)
                    ->decrement('sequence');
        }

        $banner->sequence = $request->get('sequence');

        $banner->save();

        Session::flash('success', 'Banner has been updated!');
        return redirect()->route("admin.banner.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */

}

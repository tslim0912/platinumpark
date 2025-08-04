<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Banner;
use App\PostDetail;
use App\PostDetails;
use App\BannerImages;
use Illuminate\Http\Request;
use App\Traits\SessionsTraits;
use App\Traits\ProcessImageTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostDetailController extends Controller {

    use SessionsTraits,
        ProcessImageTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post) {
        return view("admin.posts.post.create", compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            'image_desktop' => 'image|max:2048',
        ]);
        
        $upload_path_desktop = 'uploads/post/';
        if (!$request->hasFile('image_desktop')) {
            $image_desktop =  $request->get('exist_image_desktop');
        } else {
            $file      = $request->file('image_desktop');
            $file_name_desktop = 'image_desktop' . '_' . time() . '.' . $file->extension();
            $upload_success = $file->move($upload_path_desktop, $file_name_desktop); // uploading file to given path
            if (!$upload_success) {
                return redirect()->route("admin.posts.index")->with("failure", "Error when tried to save image.");
            }
            $image_desktop = $upload_path_desktop . $file_name_desktop;
        }
        $post_id = $request->get('post_id');

        $post= PostDetail::where('page_id',  $post_id )->get();
        // $sequence = count($post) + 1;

        $post = new PostDetail;
        $post->page_id = $post_id;
        $post->title = $request->get('title');
        $post->thumbnail =  $image_desktop;
        $post->description = $request->get('description');
        $post->start_date = $request->get('start_date');
        $post->end_date = $request->get('end_date');
        // $post->sequence = $sequence;
        $post->save();


        Session::flash('success', 'Post has been added!');
        return redirect()->route('admin.posts.show', ['post'=> $post_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerImages $bannerImages) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerImages $bannerImage) {
        $rules = [
            'sequence' => 'required',
            'thumbnail' => 'image|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (empty($bannerImage)) {
            return redirect()->back()->withErrors('Image not found')->withInput();
        }

        $sequence = $request->get("sequence");

        if ($sequence < $bannerImage->sequence) {
            BannerImages::where('sequence', '>=', $sequence)
                    ->where('banner_id', $bannerImage->banner_id)
                    ->where('sequence', '<', $bannerImage->sequence)
                    ->increment('sequence');
        } else if ($sequence > $bannerImage->sequence) {
            BannerImages::where('sequence', '<=', $sequence)
                    ->where('banner_id', $bannerImage->banner_id)
                    ->where('sequence', '>', $bannerImage->sequence)
                    ->decrement('sequence');
        }

        $bannerImage->image_alt = $request->get('image_alt');
        $bannerImage->sequence = $request->get('sequence');

        if($bannerImage->video_url) {

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


            $bannerImage->video_url = $request->get('youtube_link');
            // $bannerImage->image = $request->get('youtube_thumbnail');
            $bannerImage->image =$thumbnail;

        }
        
        $bannerImage->save();
        if($bannerImage->video_url) {
            $this->flash("success", "Video has been updated!");
        } else {
            $this->flash("success", "Image has been updated!");
        }
        return redirect()->route('admin.banner.show', ['banner'=>$bannerImage->banner->id]);
    }


    public function storeYoutube(Request $request, $banner_id) {

        
        $rules = [
            'youtube_link' => 'required',
            'thumbnail' => 'required|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $upload_path_desktop = 'uploads/banner/';
        if (!$request->hasFile('thumbnail')) {
            $thumbnail =  '';
        } else {
            $file      = $request->file('thumbnail');
            $file_name_desktop = 'image_desktop' . '_' . time() . '.' . $file->extension();
            $upload_success = $file->move($upload_path_desktop, $file_name_desktop); // uploading file to given path
            if (!$upload_success) {
                return redirect()->route("admin.banner.index")->with("failure", "Error when tried to save image.");
            }
            $thumbnail = $upload_path_desktop . $file_name_desktop;
        }
        // dd($thumbnail);

        $bannerImages= BannerImages::Where('banner_id', $banner_id)->max('sequence');
        $sequence = $bannerImages + 1;

        $bannerImage = new BannerImages;
        $bannerImage->type = 'video';
        $bannerImage->banner_id = $banner_id;
        $bannerImage->video_url = $request->get('youtube_link');
        // $bannerImage->image = $request->get('youtube_thumbnail');
        $bannerImage->image = $thumbnail;
        $bannerImage->image_alt = $request->get('image_alt');
        $bannerImage->sequence = $sequence;
        
        $bannerImage->save();
        
        $this->flash("success", "YouTube video has been added!");
        return redirect()->route('admin.banner.show', ['banner'=>$banner_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerImages $bannerImage) {
        if (empty($bannerImage)) {
            return response()->json(['success' => false, 'message' => 'Image not found']);
        }

        $delete = $this->unlinkImage($bannerImage, "bannerImages");

        if (!empty($delete)) {
            return $delete;
        }

        // BannerImages::where('banner_id', $bannerImage->banner_id)
        //         ->where('sequence', '>', $bannerImage->sequence)
        //         ->decrement('sequence');

        // $bannerImage->delete();

        return response()->json(['success' => true, 'message' => '']);
    }

    private function responseJson($msg, $code = 400) {
        return response()->json($msg, $code);
    }

}

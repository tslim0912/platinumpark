@extends('admin.layouts.app')
@section("content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner</h1>
          </div>
          <div class="col-sm-6">          
            <ol class="breadcrumb float-sm-right">
<!--               <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
            <div class="card">
              <div class="card-header">
                <div class="mt-3 form-group row">
                  <label class="col-sm-2 control-label">Title : </label>
                  <div class="col-sm-8">
                      <p class="form-control-static">
                          {!!  ucfirst($banner->title) !!}
                      </p>
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">Created At : </label>
                    <div class="col-sm-8">
                        <p class="form-control-static">
                            {!! $banner->created_at !!}
                        </p>
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <div class="visible-md-block visible-lg-block">

                        <a id="add_video_link" href="javascript:void(0);" type="button" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>&nbsp; Add YouTube Video
                        </a>
                        <div style="margin-top:8px;"></div>
                    </div>
                </div> --}}
              </div>
            
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading pl-3 pt-3">
                            Banner Images 
                            {{-- - <i>Recommend size 1920x1001(px)</i> --}}
                        </div>
                        <div class="panel-body">
                            {{-- {!! Form::open([ 'route' => [ 'admin.banner.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone banner_dropzone1', 'id' => 'image-upload' ]) !!}
                            {!! Form::close() !!} --}}
                            {!! Form::open(['url'=> route('admin.bannerImages.store'),'files'=>true,'class'=>'dropzone banner_dropzone1', 'method'=>'post']) !!}
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                            {!! Form::close() !!}
                            <div class="row" style="margin-top: 20px">
                                @foreach($banner_images as $key => $value)
                                <div class="col-xs-6 col-md-3 col-lg-3" style="margin-bottom: 10px;">
                                    <div class="img-thumbnail" style="height: 150px; overflow: hidden; padding: 0;">
                                        <a class="fancybox" rel="banner1" href="{{ url($value->image) }}" title="{{ $value->banner->title }}">
                                            <img src="{{ url($value->image) }}" alt="{{ $value->banner->title }}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="col-lg-12" style="text-align: right; margin-top: 5px;">
                                        <a id="{{ $value->id }}" class="edit_image_link" href="javascript:void(0);" image_link="{!! asset($value->image) !!}"  content="{{  $value->banner->title }}" content2="{{ $value->sequence }}" image_alt="{{ $value->image_alt }}" data-type="{{ $value->type }}" youtube_link="{{ $value->video_url }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a id="{{ $value->id }}" class="delete_image_link" href="{{route('admin.bannerImages.destroy', ['bannerImage'=>$value->id])}}"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                    <div class="round-tag image-sequence-tag">{{ $value->sequence }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-image" class="form-content" style="display:none;">
                    {!! Form::open(array('url'=> route('admin.bannerImages.store'), 'method'=>'put', 'id' => 'image_form', 'class' => 'form')) !!}

                    <div class="form-group">
                        <label for="name">Image Alt</label>
                        <input type="text" class="form-control" id="image_alt" name="image_alt">
                    </div>
                    <div class="form-group">
                        <label for="name">Sequence <span class="red">*</span></label>
                        <select id="sequence" name="sequence" class="form-control" >
                            @foreach($banner_images as $key => $value)
                            <option value="{{$value->sequence}}">{{$value->sequence}}</option>
                            @endforeach
                        </select>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div id="modal-video_update" class="form-content" style="display:none;">
                    {!! Form::open(array('url'=> route('admin.bannerImages.store'), 'method'=>'put', 'id' => 'image_form', 'class' => 'form', "enctype" =>"multipart/form-data")) !!}

                    <div class="form-group">
                        <label for="youtube_link">YouTube Link<span class="red">*</span><br> <small>example: https://youtu.be/xxxxxxxxxxx</small></label>
                        <input type="text" class="form-control" id="youtube_link" name="youtube_link">
                    </div>
                    <div class="form-group">
                        {{-- <label for="youtube_thumbnail">YouTube Thumbnail <span class="red">*</span> <br> <small>Thumbnail can be extracted from the YouTube link by using <a href="http://www.get-youtube-thumbnail.com/" target="_blank">http://www.get-youtube-thumbnail.com/.</a></small></label>
                        <input type="text" class="form-control" id="youtube_thumbnail" name="youtube_thumbnail"> --}}
                        <label for="file" class="moto-widget-contact_form-label">YouTube Thumbnail<span class="red">*</span> - <i>Recommend ratio 12:8</i></label>
                        <input type="file" name="thumbnail" id="youtube_thumbnail" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="exist_thumbnail" id="exist_thumbnail">
                        <a id="exist_youtube_thumbnail" target="_blank" href="#">
                            <p class="form-control-static"><i class="fa fa-paperclip" aria-hidden="true"></i> View Attachment</p>
                        </a>
                    </div>

                    <div class="form-group">
                        <label for="name">Image Alt</label>
                        <input type="text" class="form-control" id="image_alt" name="image_alt">
                    </div>
                    <div class="form-group">
                        <label for="name">Sequence  <span class="red">*</span></label>
                        <select id="sequence" name="sequence" class="form-control" >
                            @foreach($banner_images as $key => $value)
                            <option value="{{$value->sequence}}">{{$value->sequence}}</option>
                            @endforeach
                        </select>
                    </div>
                    {!! Form::close() !!}
                </div>


                <div id="modal-video" class="form-content" style="display:none;">
                    {!! Form::open(array('url'=> route('admin.bannerVideo.store', ['banner_id' => $banner->id]), 'method'=>'POST', 'id' => 'image_form', 'class' => 'form', "enctype" =>"multipart/form-data")) !!}
                    
                    <div class="form-group">
                        <label for="youtube_link">YouTube Link<span class="red">*</span><small><br> example: https://youtu.be/xxxxxxxxxxx</small></label>
                        <input type="text" class="form-control" name="youtube_link">
                    </div>
                    <div class="form-group">
                        {{-- <label for="youtube_thumbnail">YouTube Thumbnail<span class="red">*</span> <br> <small>Thumbnail can be extracted from the YouTube link by using <a href="http://www.get-youtube-thumbnail.com/" target="_blank">http://www.get-youtube-thumbnail.com/.</a></small></label>
                        <input type="text" class="form-control" id="youtube_thumbnail" name="youtube_thumbnail"> --}}
                        <label for="file" class="moto-widget-contact_form-label">YouTube Thumbnail<span class="red">*</span> - <i>Recommend ratio 12:8</i></label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    </div>
                    
                

                    <div class="form-group">
                        <label for="image_alt">Image Alt</label>
                        <input type="text" class="form-control" id="image_alt" name="image_alt">
                    </div>
                    
                    {!! Form::close() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });

    var token = "{{ Session::token() }}";

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone(".banner_dropzone1", {
        url: "{!! route('admin.bannerImages.store') !!}",
        params: {
            _token: token,
            type: 'banner_images',
            banner_id: '{{ $banner->id }}',
        },
        maxFilesize: 1,
        uploadMultiple: true,
        addRemoveLinks: false,
        parallelUploads: 1,
        autoProcessQueue: true,

        error: function (file, response) {
            if ($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;

            $('.banner_dropzone1').append(message);

        },
        paramName: "file"
    });

    myDropzone.on("queuecomplete", function (progress) {

        window.location.reload();
    });

    $(document).ready(function () {

        $(".fancybox").fancybox({
            openEffect: 'none',
            closeEffect: 'none',
            fitToView: true,
            autoResize: true
        });

    });


    $(document).on('click', '.edit_image_link', function (event) {
        var type = $(this).data('type');
        event.preventDefault();
        bootbox.hideAll();
        
        var banner_type = $(this).attr("data-type");

        if(type == "video") {
            var modal_content = $("#modal-video_update").clone();
        } else {
            var modal_content = $("#modal-image").clone();
        }
        

        var id = $(this).attr("id");
        var image_alt = $(this).attr("image_alt");
        var sequence = $(this).attr("content2");
        var image_link = $(this).attr("image_link");
        var youtube_link = $(this).attr("youtube_link");

        // modal_content.find("#link").attr('value', link);
        modal_content.find("#image_alt").attr('value', image_alt);
        modal_content.find("#sequence option[value='" + sequence + "']").attr('selected', 'selected');
        modal_content.find(".form").attr("action", "{!! route('admin.bannerImages.store') !!}/" + id);

        if(type == "video") {
            modal_content.find("#youtube_link").attr('value', youtube_link);
            modal_content.find("#exist_thumbnail").attr('value', image_link);
            modal_content.find("#exist_youtube_thumbnail").attr('href', image_link);
            var title = "Edit YouTube Video";
        }else {
            var title = "Edit Image";
        }

        var modal = bootbox.dialog({
            message: modal_content.html(),
            title: title,
            buttons: {
                save: {
                    label: "Save",
                    className: "btn-primary",
                    callback: function () {
                        var form = modal.find(".form");
                        form.validate({
                            ignore: [],
                            rules: {
                                "sequence": "required"
                            },
                            messages: {
                                "sequence": ""
                            },
                            errorClass: "has-error",
                            errorPlacement: function (error, element) {
                                element.parent().addClass('has-error');
                            }
                        });
                        if (form.valid()) {
                            form.submit();
                        } else {
                            return false;
                        }
                    }
                },
                close: {
                    label: "Close",
                    className: "btn-default",
                    callback: function () {
                        //Example.show("uh oh, look out!");
                    }
                }
            },
            show: false,
            onEscape: function () {
                modal.modal("hide");
            }
        });

        modal.modal("show");

    });

    $(document).on('click', '.delete_image_link', function (event) {
        event.preventDefault();
        var id = this.id
        var url = $(this).attr("href");

        bootbox.hideAll();

        bootbox.dialog({
            message: "Are you sure to delete this image ?",
            title: "Delete Image",
            buttons: {
                yes: {
                    label: "Yes",
                    className: "btn-primary",
                    callback: function () {
                        jQuery.ajax({
                            url: url,
                            type: 'DELETE',
                            success: function (response) {
                                if (response.success == true) {
                                    location.reload();
                                } else {
                                    bootbox.alert(response.message);
                                }
                            }
                        });
                    }
                },
                cancel: {
                    label: "Close",
                    className: "btn-default",
                    callback: function () {
                        //Example.show("uh oh, look out!");
                    }
                }
            }
        });
    });


    $(document).on('click', '#add_video_link', function (event) {
        event.preventDefault();

        bootbox.hideAll();

      
        var modal_content = $("#modal-video").clone();


        var modal = bootbox.dialog({
            message: modal_content.html(),
            title: "Add YouTube Video",
            buttons: {
                save: {
                    label: "Save",
                    className: "btn-primary",
                    callback: function () {
                        var form = modal.find(".form");
                        form.validate({
                            ignore: [],
                            // rules: {
                            //     "sequence": "required"
                            // },
                            // messages: {
                            //     "sequence": ""
                            // },
                            errorClass: "has-error",
                            errorPlacement: function (error, element) {
                                element.parent().addClass('has-error');
                            }
                        });
                        if (form.valid()) {
                            form.submit();
                        } else {
                            return false;
                        }
                    }
                },
                close: {
                    label: "Close",
                    className: "btn-default",
                    callback: function () {
                        //Example.show("uh oh, look out!");
                    }
                }
            },
            show: false,
            onEscape: function () {
                modal.modal("hide");
            }
        });

        modal.modal("show");

    });
</script>
@endsection
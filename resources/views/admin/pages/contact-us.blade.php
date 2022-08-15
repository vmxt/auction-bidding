@extends('admin.layouts.app')

@section('pagetitle')
    Edit Page
@endsection

@section('pagecss')
    <link href="{{ asset('lib/bselect/dist/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>

    <style>
        .bootstrap-tagsinput .tag {
            border-radius: 3px;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]::after {
            content: '\f406';
        }
    </style>
@endsection

@section('content')

    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">CMS</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit a Page</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Edit a Page</h4>
            </div>
            <div>
                <a class="btn btn-outline-primary btn-sm" href="{{$page->get_url()}}" target="_blank">Preview Page</a>
            </div>
        </div>
        <form id="editForm" action="{{ route('pages.update-contact-us', $page->id) }}" method="post" enctype="multipart/form-data">
            <div class="row row-sm">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="d-block">Page Title *</label>
                        @if ($page->page_type == "default")
                            <label>{{ $page->name }}</label></br>
                            <input type="hidden" class="form-control" name="page_title" value="{{ $page->name }}">
                        @else
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" id="page_title" value="{{ old('page_title', $page->name) }}" required>
                        @endif
                        @hasError(['inputName' => 'page_title'])
                        @endhasError
                        <small id="page_slug"><a target="_blank" href="{{env('APP_URL')}}/{{$page->slug}}">{{env('APP_URL')}}/{{$page->slug}}</a></small>
                        @hasError(['inputName' => 'slug'])
                        @endhasError
                    </div>
                    <div class="form-group">
                        <label class="d-block">Page Label *</label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ old('label', $page->label) }}" required>
                        @hasError(['inputName' => 'label'])
                        @endhasError
                    </div>
{{--                    @if ($page->page_type != "default")--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="d-block">Parent Page</label>--}}
{{--                            <select id="parentPage" class="selectpicker mg-b-5 @error('parent_page') is-invalid @enderror" name="parent_page" data-style="btn btn-outline-light btn-md btn-block tx-left" title="- None -" data-width="100%">--}}
{{--                                <option value="0" @if (empty($page->parent_page_id)) selected @endif>- None -</option>--}}
{{--                                @forelse($parentPages as $parentPage)--}}
{{--                                    <option value="{{$parentPage->id}}" {{ (old("parent_page",$page->parent_page_id) == $parentPage->id ? "selected":"") }}> {{$parentPage->name}} </option>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}

{{--                            </select>--}}
{{--                            @hasError(['inputName' => 'parent_page'])--}}
{{--                            @endhasError--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    @php
                        $album_active = 'active';
                        $image_active = '';
                        $banner_type = 'banner_slider';
                        if(strlen($page->image_url) > 0){
                            $album_active = '';
                            $image_active = 'active';
                            $banner_type = 'banner_image';
                        }
                    @endphp
                    <div class="form-group">
                        <label class="d-block">Page Banner</label>
                        @if ($page->page_type != "default")
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="banner_slider" class="btn page_banner_btn btn-secondary {{ $album_active }}">Slider</button>
                                <button type="button" id="banner_image" class="btn page_banner_btn btn-secondary {{ $image_active }}">Image</button>

                                <input type="hidden" name="banner_type" id="banner_type" value="{{ $banner_type }}">
                            </div>
                    </div>

                    <div class="form-group banner-image" style="{{($banner_type == 'banner_slider' ? 'display:none;':'')}}">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('page_image') is-invalid @enderror"  id="page_image" name="page_image" @if (!empty($page->image_url)) title="{{$page->get_image_file_name()}}" @endif>
                            <label class="custom-file-label" for="customFile" id="img_name">@if (empty($page->image_url)) Choose file @else {{$page->get_image_file_name()}} @endif</label>
                        </div>
                        <p class="tx-10">
                            Required image dimension: {{ env('SUB_BANNER_WIDTH') }}px by {{ env('SUB_BANNER_HEIGHT') }}px <br /> Maximum file size: 1MB <br /> Required file type: .jpeg .png
                        </p>
                        @error('page_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div id="image_div" @if($page->has_slider()) style="display:none;" @endif>
                            <img src="{{ old('page_image', $page->image_url) }}" height="100" width="300" id="img_temp" alt="">  <br /><br />
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger remove-upload" >Remove Image</a>
                        </div>
                        @endif
                    </div>

                    <div class="form-group banner-slider" style="{{($banner_type == 'banner_image' ? 'display:none;':'')}}">
                        <div class="row">
                            <div class="col-md-10">
                                <select class="selectpicker mg-b-5 @error('page_banner') is-invalid @enderror" id="page_banner" name="page_banner" data-style="btn btn-outline-light btn-md btn-block tx-left" title="Select album" data-width="100%">
                                    <option value="0" @if (empty($page->album_id)) selected @endif>- None -</option>
                                    @forelse($albums as $album)
                                        <option value="{{$album->id}}" {{ (old("page_banner",$page->album_id) == $album->id ? "selected":"") }}> {{$album->name}} </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            {{--						<div class="col-md-2">--}}
                            {{--							<div class="col-md-2" id="preview_btn_div" @if(!$page->has_slider() || empty($page->album_id)) style="display:none;" @endif>--}}
                            {{--                                <a href="#" data-toggle="modal" data-target="#preview-banner" id="preview_btn" class="btn btn-xs btn-success" data-id="{{$page->album_id}}">Preview</a>--}}
                            {{--						    </div>--}}
                            {{--						</div>--}}
                        </div>
                        @hasError(['inputName' => 'page_banner'])
                        @endhasError
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="d-block">Content</label>
                        <textarea name="content" id="editor1" rows="10" cols="80">
                            {{ old('content',$page->contents) }}
                        </textarea>
                        @hasError(['inputName' => 'content'])
                        @endhasError
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="d-block">Email Recipients *</label>
                        <input type="text" class="form-control @error('emails') is-invalid @enderror" data-role="tagsinput" name="emails" id="tags" value="{{ old('emails', $emails) }}">
                        @hasError(['inputName' => 'emails'])
                        @endhasError
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="d-block">Email Content *</label>
                        <textarea name="content2" id="editor2" rows="10" cols="80" required>
                            {{ old('content2', $settings->contact_us_email_layout) }}
                        </textarea>
                        @hasError(['inputName' => 'content2'])
                        @endhasError
                        <span class="invalid-feedback" role="alert" id="contentRequired2" style="display: none;">
                            <strong>The content field is required</strong>
                        </span>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label class="d-block">Page Visibility</label>
                        @if ($page->page_type == "default")
                            <label>
                                {{ucfirst($page->status)}}
                            </label>
                        @else
                            <div class="custom-control custom-switch @error('visibility') is-invalid @enderror">
                                <input type="checkbox" class="custom-control-input" name="visibility" {{ (old("visibility") == "ON" || $page->status == "PUBLISHED" ? "checked":"") }} id="customSwitch1">
                                <label class="custom-control-label" id="label_visibility" for="customSwitch1">{{ucfirst(strtolower($page->status))}}</label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-12 mg-t-30">
                    <h4 class="mg-b-0 tx-spacing--1">Manage SEO</h4>
                    <hr>
                </div>

                <div class="col-lg-6 mg-t-30">
                    <div class="form-group">
                        <label class="d-block">Title <code>(meta title)</code></label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title',$page->meta_title) }}">
                        @hasError(['inputName' => 'meta_title'])
                        @endhasError
                        <p class="tx-11 mg-t-4">{{ __('standard.seo.title') }}</p>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Description <code>(meta description)</code></label>
                        <textarea rows="3" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description">{!! old('meta_description', $page->meta_description) !!}</textarea>
                        @hasError(['inputName' => 'meta_description'])
                        @endhasError
                        <p class="tx-11 mg-t-4">{{ __('standard.seo.description') }}</p>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Keywords <code>(meta keywords)</code></label>
                        <textarea rows="3" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword">{!! old('meta_keyword', $page->meta_keyword) !!}</textarea>
                        @hasError(['inputName' => 'meta_keyword'])
                        @endhasError
                        <p class="tx-11 mg-t-4">{{ __('standard.seo.keywords') }}</p>
                    </div>
                </div>

                <div class="col-lg-12 mg-t-30">
                    <input class="btn btn-primary btn-sm btn-uppercase" type="submit" value="Update Page">
                    <a href="{{route('pages.index')}}" class="btn btn-outline-secondary btn-sm btn-uppercase" type="cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="preview-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Preview</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="owl-carousel owl-theme" id="previewCarousel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="prompt-remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Remove image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('standard.banner.remove_image')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" id="btnRemove">Yes, remove image</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('lib/bselect/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('lib/bselect/dist/js/i18n/defaults-en_US.js') }}"></script>
    <script src="{{ asset('lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    {{--    Image validation--}}
    <script>
        let BANNER_WIDTH = "{{ env('SUB_BANNER_WIDTH') }}";
        let BANNER_HEIGHT =  "{{ env('SUB_BANNER_HEIGHT') }}";
    </script>
    <script src="{{ asset('js/image-upload-validation.js') }}"></script>
    {{--    End Image validation--}}
@endsection


@section('customjs')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        var options = {
            filebrowserImageBrowseUrl: '{{ env('APP_URL') }}/laravel-filemanager?type=Images',
            filebrowserImageUpload: '{{ env('APP_URL') }}/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '{{ env('APP_URL') }}/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ env('APP_URL') }}/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}',
            allowedContent: true,
        };
        let editor = CKEDITOR.replace('content', options);

        options['contentsCss'] = [];
        let editor2 = CKEDITOR.replace('content2', options);
        editor2.on('required', function (evt) {
            if ($('.invalid-feedback').length == 1) {
                $('#contentRequired2').show();
            }
            $('#cke_editor2').addClass('is-invalid');
            evt.cancel();
        });

        function has_none_option(objectId, currentValue)
        {
            if (currentValue == "0" || currentValue == "" || currentValue == "null") {
                document.getElementById(objectId).selectedIndex = -1;
            }
            $('#'+objectId).on('change', function() {
                if ($(this).val() == 0) {
                    document.getElementById(objectId).selectedIndex = -1;
                }
            });
        }

        $(function() {
            $('.selectpicker').selectpicker();

            has_none_option("page_banner", "{{$page->album_id}}");
        });

        /**  START Slider Preview **/
        $('#page_banner').on('change', function() {
            $("#preview_btn").data("id", $('#page_banner').val());
            if($('#page_banner').val() && $('#page_banner').val() > 0){
                $('#preview_btn_div').show();
            } else {
                $('#preview_btn_div').hide();
            }
        });

        $('#preview-banner').on('show.bs.modal', function (e) {
            let album = e.relatedTarget;
            let albumId = $(album).data('id');
            $('#previewCarousel').html('');
            $.ajax({
                type: "POST",
                data: { _token: "{{ csrf_token() }}"},
                url: "{{ route('albums.banners', '') }}/" + albumId,
                success: function(returnData) {
                    console.log(returnData);
                    let pathHTML = '';
                    $.each(returnData['banner_paths'], function(index, path) {
                        pathHTML += `<div class="item">
                            <img src="`+path+`">
                        </div>`;
                    });
                    $('#previewCarousel').trigger('destroy.owl.carousel');

                    $('#previewCarousel').html(pathHTML);

                    $('#previewCarousel').owlCarousel({
                        animateOut: returnData['transition_out'],
                        animateIn: returnData['transition_in'],
                        loop: true,
                        dots: false,
                        margin: 0,
                        autoplay: true,
                        autoplayTimeout: (returnData['transition']*1000),
                        autoplayHoverPause: false,
                        nav: false,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 1
                            },
                            1000: {
                                items: 1
                            }
                        }
                    });
                }
            });
        });
        /**  END Slider Preview **/

        $("#customSwitch1").change(function() {
            if(this.checked) {
                $('#label_visibility').html('Published');
            }
            else{
                $('#label_visibility').html('Private');
            }
        });


        /** Generation of the page slug **/
        function get_page_slug() {
            var url = $('#page_title').val();
            var parentPage = $('#parentPage').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                }
            })

            $.ajax({
                type: "POST",
                url: "{{ route('pages.get_slug') }}",
                data: {url: url, parentPage: parentPage}
            })

                .done(function (response) {

                    slug_url = '{{env('APP_URL')}}/' + response;
                    $('#page_slug').html("<a target='_blank' href='" + slug_url + "'>" + slug_url + "</a>");

                });
        }

        $('#parentPage').change(function(){
            get_page_slug();
        });

        $('#page_title').change(function(){
            get_page_slug();
        });


        /** Handles the page banner functions **/
        $('.page_banner_btn').click(function(){

            var btn = $(this).attr('id');

            if(btn == $('#banner_type').val()){ // if user clicked the already selected button then cancel the operation.
                return false;
            }
            else{

                /** reset the input boxes **/
                $('#page_image').val('');
                $('#page_banner').val('');
                $('#image_div').hide();
                $('#img_name').html('Choose file');

                $('#banner_type').val(btn);

                if(btn == 'banner_slider'){ // if user selected the banner slider

                    $("#banner_image").removeClass("active");
                    $("#banner_slider").addClass("active");

                    // $("#page_banner").prop('required',true);
                    // $("#page_image").prop('required',false);

                    $(".banner-image").hide();
                    $(".banner-slider").show();
                }


                if(btn == 'banner_image'){ // if user selected the banner image

                    $("#banner_slider").removeClass("active");
                    $("#banner_image").addClass("active");

                    // $("#page_image").prop('required',true);
                    // $("#page_banner").prop('required',false);

                    $(".banner-slider").hide();
                    $(".banner-image").show();

                }
            }


        });

        function readURL(file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#img_name').html(file.name);
                $('#page_image').attr('title', file.name);
                $('#img_temp').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);
            $('#image_div').show();
        }

        $("#page_image").change(function(evt) {
            validate_images(evt, readURL);
        });

        $(document).on('click', '.remove-upload', function() {
            $('#prompt-remove').modal('show');
        });

        $('#btnRemove').on('click', function() {
            $('#editForm').prepend('<input type="hidden" name="delete_image" value="1"/>');
            $('#img_name').html('Choose file');
            $('#page_image').removeAttr('title');
            $('#page_image').val('');
            $('#img_temp').attr('src', '');
            $('#image_div').hide();
            $('#prompt-remove').modal('hide');
        });

    </script>
@endsection

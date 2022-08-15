@extends('admin.layouts.app')

@section('pagetitle')
    Create Page
@endsection

@section('pagecss')
    <link href="{{ asset('lib/bselect/dist/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owl.carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

<div class="container pd-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('dashboard')}}">CMS</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create a Page</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Create a Page</h4>
        </div>
    </div>
    <form method="post" action="{{ route('pages.store') }}" enctype="multipart/form-data">
        <div class="row row-sm">
            <div class="col-lg-6">
                @csrf
                <div class="form-group">
                    <label class="d-block">Page Title *</label>
                    <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" id="page_title" value="{{ old('page_title') }}" required @htmlValidationMessage({{__('standard.empty_all_field')}})>
                    @hasError(['inputName' => 'page_title'])
                    @endhasError
                    <small id="page_slug"></small>
                    @hasError(['inputName' => 'slug'])
                    @endhasError
                </div>
                <div class="form-group">
                    <label class="d-block">Page Label *</label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ old('label') }}" required>
                    @hasError(['inputName' => 'label'])
                    @endhasError
                </div>
                
                <div class="form-group">
                    <label class="d-block">Parent Page</label>
                    <select id="parentPage" class="selectpicker mg-b-5 @error('parent_page') is-invalid @enderror" name="parent_page" data-style="btn btn-outline-light btn-md btn-block tx-left" title="- None -" data-width="100%">
                        <option value="0" selected>- None -</option>
                        @forelse($pages as $page)
                            <option value="{{$page->id}}" {{ (old("parent_page") == $page->id ? "selected":"") }}> {{$page->name}} </option>
                        @empty
                        @endforelse

                    </select>
                    @hasError(['inputName' => 'parent_page'])
                    @endhasError
				</div>

                <div class="form-group">
                    <label class="d-block">Module *</label>
                    <select name="module" id="module" class="form-control">
                        <option value="sp" selected="selected">Supplier Portal</option>
                        <option value="cms">CMS Portal</option>
                        <option value="ec">Ecommerce Portal</option>
                    </select>
                 
                </div>
                
				<div class="form-group">
					<label class="d-block">Page Banner</label>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" id="banner_slider" class="btn page_banner_btn btn-secondary
							@if(old('banner_type') != 'banner_image') active @endif">Slider
						</button>
						<button type="button" id="banner_image" class="btn page_banner_btn btn-secondary
							@if(old('banner_type') == 'banner_image') active @endif">Image
						</button>
						<input type="hidden" name="banner_type" id="banner_type" value="{{ old('banner_type','banner_slider') }}">
					</div>
				</div>
				<div class="form-group banner-image" @if(old('banner_type') != 'banner_image') style="display:none;" @endif>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('page_image') is-invalid @enderror" name="page_image" id="page_image" accept="image/*">
                        <label class="custom-file-label" for="page_image" id="img_name">Choose file</label>
                    </div>
                    @error('page_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <p class="tx-10">
                        Required image dimension: {{ env('SUB_BANNER_WIDTH') }}px by {{ env('SUB_BANNER_HEIGHT') }}px <br /> Maximum file size: 1MB <br /> Required file type: .jpeg .png
                    </p>

                    <div id="image_div" style="display:none;">
                        <img src="" height="100" width="300" id="img_temp" alt="">  <br /><br />
                        <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="remove_image();">Remove Image</a>
                    </div>
                </div>

                <div class="form-group banner-slider" @if(old('banner_type') == 'banner_image') style="display:none;" @endif>
                    <div class="row">
                        <div class="col-md-10">
                            <select class="selectpicker mg-b-5 @error('page_banner') is-invalid @enderror" id="page_banner" name="page_banner" data-style="btn btn-outline-light btn-md btn-block tx-left" title="- None -" data-width="100%">
                                <option value="0" selected>- None -</option>
                                @forelse($albums as $album)
                                    <option value="{{$album->id}}" {{ (old("page_banner") == $album->id ? "selected":"") }}> {{$album->name}} </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
{{--                        <div class="col-md-2" id="preview_btn_div" style="display:none;">--}}
{{--                            <a href="#" data-toggle="modal" data-target="#preview-banner" id="preview_btn" class="btn btn-xs btn-success">Preview</a>--}}
{{--                        </div>--}}
                    </div>

                    @hasError(['inputName' => 'page_banner'])
                    @endhasError
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="d-block" id="contentLabel">Content *</label>
                    <textarea name="content" id="editor1" rows="10" cols="80" required>
                         {{ old('content') }}
                    </textarea>
                    @hasError(['inputName' => 'content'])
                    @endhasError
                    <span class="invalid-feedback" role="alert" id="contentRequired" style="display: none;">
                        <strong>The content field is required</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="d-block">Page Visibility</label>
                    <div class="custom-control custom-switch @error('visibility') is-invalid @enderror">
                        <input type="checkbox" class="custom-control-input" name="visibility" {{ (old("visibility") ? "checked":"") }} id="customSwitch1">
                        <label class="custom-control-label" id="label_visibility" for="customSwitch1">Private</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mg-t-30">
                <h4 class="mg-b-0 tx-spacing--1">Manage SEO</h4>
                <hr>
            </div>

            <div class="col-lg-6 mg-t-30">
                <div class="form-group">
                    <label class="d-block">Title <code>(meta title)</code></label>
                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror" name="seo_title" value="{{ old('seo_title') }}">
                    @hasError(['inputName' => 'seo_title'])
                    @endhasError
                    <p class="tx-11 mg-t-4">{{ __('standard.seo.title') }}</p>
                </div>
                <div class="form-group">
                    <label class="d-block">Description <code>(meta description)</code></label>
                    <textarea rows="3" class="form-control @error('seo_description') is-invalid @enderror" name="seo_description">{{ old('seo_description') }}</textarea>
                    @hasError(['inputName' => 'seo_description'])
                    @endhasError
                    <p class="tx-11 mg-t-4">{{ __('standard.seo.description') }}</p>
                </div>
                <div class="form-group">
                    <label class="d-block">Keywords <code>(meta keywords)</code></label>
                    <textarea rows="3" class="form-control @error('seo_keywords') is-invalid @enderror" name="seo_keywords">{{ old('seo_keywords') }}</textarea>
                    @hasError(['inputName' => 'seo_keywords'])
                    @endhasError
                    <p class="tx-11 mg-t-4">{{ __('standard.seo.keywords') }}</p>
                </div>
            </div>

            <div class="col-lg-12 mg-t-30">
                <input class="btn btn-primary btn-sm btn-uppercase" type="submit" value="Save Page">
                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary btn-sm btn-uppercase">Cancel</a>
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
@endsection

@section('pagejs')
    <script src="{{ asset('lib/bselect/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('lib/bselect/dist/js/i18n/defaults-en_US.js') }}"></script>
    <script src="{{ asset('lib/owl.carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/file-upload-validation.js') }}"></script>
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
        editor.on('required', function (evt) {
            if ($('.invalid-feedback').length == 1) {
                $('#contentRequired').show();
            }
            $('#cke_editor1').addClass('is-invalid');
            evt.cancel();
        });

        function has_none_option(objectId)
        {
            document.getElementById(objectId).selectedIndex = -1;
            $('#'+objectId).on('change', function() {
                if ($(this).val() == 0) {
                    document.getElementById(objectId).selectedIndex = -1;
                }
            });
        }

        $(function() {
            $('.selectpicker').selectpicker();

            has_none_option("parentPage");
            has_none_option("page_banner");
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
            var page_module = $('#module').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                }
            })

            $.ajax({
                type: "POST",
                url: "{{ route('pages.get_slug') }}",
                data: {url: url, parentPage: parentPage, module: page_module}
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
                $('#img_name').html('Choose file');
                $('#page_banner').val('');
                $('#image_div').hide();


                $('#banner_type').val(btn);


                $('#page_image').val();
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

    </script>
    <script>
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

            $('#img_name').html('Choose file');
            $('#img_temp').attr('src', '');
            $('#image_div').hide();

            let files = evt.target.files;
            let maxSize = 1;
            let validateFileTypes = ["image/jpeg", "image/png"];
            let requiredWidth = "{{ env('SUB_BANNER_WIDTH') }}";
            let requiredHeight =  "{{ env('SUB_BANNER_HEIGHT') }}";

            validate_files(files, readURL, maxSize, validateFileTypes, requiredWidth, requiredHeight, remove_banner_value_when_error);
        });

        function remove_banner_value_when_error()
        {
            $('#page_image').val('');
            $('#page_image').removeAttr('title');
        }

        function remove_image() {
            $('#img_name').html('Choose file');
            $('#page_image').removeAttr('title');
            $('#page_image').val('');
            $('#img_temp').attr('src', '');
            $('#image_div').hide();
        }
    </script>
@endsection

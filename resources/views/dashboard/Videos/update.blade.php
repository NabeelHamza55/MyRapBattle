@extends('dashboard.sidebar')
@section('title', 'Dashboard')
@section('Styles')
    <style>
        #pageloader {
            background: rgba(255, 255, 255, 0.8);
            display: none;
            height: 100%;
            position: fixed;
            width: 100%;
            z-index: 9999;
        }

        #pageloader img {
            left: 50%;
            margin-left: -32px;
            margin-top: -32px;
            position: absolute;
            top: 50%;
        }

    </style>
@endsection
<div id="pageloader">
    <img src="{{ asset('uploads/Spinner-1s-200px.gif') }}" alt="processing..." />
</div>
@section('main_content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Videos</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">Update</span>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ route('videos') }}" class="btn btn-light-warning font-weight-bolder btn-sm">List</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Update Video
                            <i class="mr-2"></i>
                            <small class="">Enter Video information below</small>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('videos') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                            <i class="fa fa-long-arrow-left icon-sm"></i>Back</a>
                        <div class="btn-group">
                            <button id="kt_submit" onclick="document.getElementById('kt_form').submit();" type="button"
                                class="btn btn-primary font-weight-bolder">
                                <i class="fa fa-check icon-sm"></i>Save Form</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Form-->
                    <form method="post" class="form" action="{{ route('videoUpdate', encrypt($video->id)) }}"
                        id="kt_form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Video Info:</h3>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Video Name:</label>
                                        <div class="col-9">
                                            <input name="videoName"
                                                class="form-control form-control-solid @error('videoName') is-invalid @enderror"
                                                type="text" value="{{ old('videoName', $video->name) }}" />
                                            @if ($errors->has('videoName'))
                                                @error('videoName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3">Category:</label>
                                        <div class="col-9">
                                            <select name="category"
                                                class="form-control form-control-solid @error('category') is-invalid @enderror">
                                                <option disabled selected value="">Select Category</option>
                                                @if (!empty($categories[0]))
                                                    @foreach ($categories as $category)
                                                        <option
                                                            {{ $video->category_id == $category->id ? 'selected' : '' }}
                                                            {{ old('category') == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('category'))
                                                @error('category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <div class="form-group row align-items-center">
                                                <label class="col-4">Video Thumbnail:</label>
                                                <div class="col-8">
                                                    <input id="thumbnail"
                                                        class="btn btn-light-primary font-weight-bolder btn-sm @error('thumbnail') is-invalid @enderror"
                                                        name="thumbnail" type="file" oninput='UpdatePreview()' />
                                                    @if ($errors->has('thumbnail'))
                                                        @error('thumbnail')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="col-4">Upload Video:</label>
                                                <div class="col-8">
                                                    <input id="video"
                                                        class="btn btn-light-primary font-weight-bolder btn-sm @error('video') is-invalid @enderror"
                                                        name="video" type="file" />
                                                    @if ($errors->has('video'))
                                                        @error('video')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img id="frame" class="img-fluid" src="{{ asset($video->thumbnail) }}"
                                                alt="Preview" srcset="">
                                            <span id="thumbnail_text" class="form-text text-center text-muted d-none">Double
                                                click to
                                                remove Thumnail</span>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Release Date:</label>
                                        <div class="col-6">
                                            <div class="input-group date">
                                                <input type="text"
                                                    class="form-control @error('releaseDate') is-invalid @enderror"
                                                    id="kt_datepicker_2" readonly="readonly"
                                                    value="{{ $video->release_date }}" name="releaseDate"
                                                    placeholder="Select date" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('releaseDate'))
                                                    @error('releaseDate')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row align-items-center">
                                        <label class="col-3">Video Length:</label>
                                        <div class="form-group col-4">
                                            <input
                                                class="form-control form-control-solid @error('length') is-invalid @enderror"
                                                name="length" type="text" value="{{ old('length', $video->length) }}" />
                                            <span class="form-text text-muted">length of video in minutes</span>
                                            @if ($errors->has('length'))
                                                @error('length')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-3">Description:</label>
                                        <div class="col-9">
                                            <textarea name="description" class="form-control form-control-solid"
                                                type="text">{{ old('videoName', $video->description) }}</textarea>
                                            @if ($errors->has('videoName'))
                                                @error('videoName')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>

                                    <div class="row align-items-center">
                                        <div class="form-group col-4">
                                            <span class="switch switch-sm ">
                                                <label class="col-form-label px-1">Trending? </label>
                                                <label class="px-1">
                                                    <input type="checkbox" value="1" name="trending"
                                                        {{ $video->trending == 1 ? 'checked' : '' }} />
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                        <div class="form-group col-4">
                                            <span class="switch switch-sm ">
                                                <label class="col-form-label px-1">Available? </label>
                                                <label class="px-1">
                                                    <input type="checkbox" value="1" name="status"
                                                        {{ $video->trending == 1 ? 'checked' : '' }} />
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                        <div class="form-group col-4">
                                            <span class="switch switch-sm ">
                                                <h4> <label class="col-form-label px-1">Likes: </label>
                                                    <label class="px-1">
                                                        {{ Helper::getLikesbyVideo($video->videoId) }}
                                                    </label>
                                                </h4>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
@section('Scripts')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script>
        function UpdatePreview() {
            $("#thumbnail_text").removeClass('d-none');
            $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
        };
        $(document).ready(function() {
            var thumbnail = "{{ asset($video->thumbnail) }}"
            $('#frame').dblclick(() => {
                $('#thumbnail').val('');
                $('#frame').attr('src', thumbnail);
                $("#thumbnail_text").addClass('d-none');
            });
        });
        $("#kt_submit").on("click", function() {
            $("#pageloader").css("display", "block");
        }); //submit
    </script>
@endsection

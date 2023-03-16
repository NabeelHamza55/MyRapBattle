@extends('dashboard.sidebar')
@section('title', 'Videos')

@section('main_content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Videos</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Total
                        Videos: {{ sizeof($videos) }}</span>
                    {{-- <form class="ml-5">
                        <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                            <input type="text" class="form-control" id="kt_subheader_search_form"
                                placeholder="Search..." />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                                </span>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="{{ route('videoAdd') }}" class="btn btn-light-primary font-weight-bold ml-2">Add Video</a>
                <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->
            @if ($errors->has('status'))
                @error('status')
                    <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-xl">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                            fill="#000000" opacity="0.3" />
                                        <path
                                            d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="alert-text text-center text-success">
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            @endif
            <!--end::Notice-->
            <!--begin::Row-->
            <div class="row">
                @if (empty($videos[0]))
                    <div class="col-12">
                        <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                            <div class="alert-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-xl">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="alert-text text-center text-success">
                                No Record Found
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($videos as $video)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body pt-4">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end">
                                        <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left">
                                            <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover">
                                                    <li class="navi-item">
                                                        <a href="{{ route('videoEdit', encrypt($video->videoId)) }}"
                                                            class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="text-primary">Edit</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item ">
                                                        <a onclick="remove('{{ encrypt($video->videoId) }}');"
                                                            {{-- href="{{ route('videoDelete', encrypt($video->videoId)) }}" --}} class="navi-link">
                                                            <span class="navi-text">
                                                                <span class="text-danger">Delete</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-7">
                                        <!--begin::Pic-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Pic-->
                                            <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                <div class="symbol symbol-circle symbol-lg-75">
                                                    <img src="{{ asset($video->thumbnail) }}" alt="image" />
                                                </div>
                                                <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                                    <span
                                                        class="font-size-h3 font-weight-boldest">{{ $video->videoName[0] }}</span>
                                                </div>
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{ $video->videoName }}</a>
                                                <span class="text-muted font-weight-bold">{{ $video->length }}min</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Desc-->
                                    <div>
                                        <p class="mb-7">
                                            {{ substr_replace($video->description, '...', 125) }}</p>
                                    </div>
                                    <!--end::Desc-->
                                    <!--begin::Info-->
                                    <div class="mb-7">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-dark-75 font-weight-bolder mr-2">Category:</span>
                                            <span class="text-muted font-weight-bold">{{ $video->category }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-cente my-1">
                                            <span class="text-dark-75 font-weight-bolder mr-2">Release Date:</span>
                                            <span class="text-muted font-weight-bold">{{ $video->release_date }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-dark-75 font-weight-bolder mr-2">uploaded_at:</span>
                                            <span
                                                class="text-muted font-weight-bold">{{ date('d-m-Y', strtotime($video->created_at)) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-dark-75 font-weight-bolder mr-2">Likes:</span>
                                            <span class="text-muted font-weight-bold">
                                                {{ Helper::getLikesbyVideo($video->videoId) }}</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <a onclick="remove('{{ encrypt($video->videoId) }}');"
                                        class="btn btn-block btn-sm btn-light-danger font-weight-bolder text-uppercase py-4">
                                        Delete</a>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                    @endforeach
                @endif
            </div>
            <!--end::Row-->


            {{-- <!--begin::Pagination-->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap mr-3">
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <select
                        class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary"
                        style="width: 75px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-muted">Displaying 10 of 230 records</span>
                </div>
            </div>
            <!--end::Pagination--> --}}
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
@section('Scripts')
    <!--begin::Page Vendors(used by this page)-->
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{ asset('assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script> --}}
    <!--end::Page Scripts-->
    <script>
        function remove(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: '/videos/delete/' + id,
                        success: function(response) {
                            if (response == 1) {
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                ).then((result1) => {
                                    if (result1.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                    )
                }
            })
        }
        // alert();
    </script>
@endsection

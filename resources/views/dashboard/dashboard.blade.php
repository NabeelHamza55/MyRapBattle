@extends('dashboard.sidebar')
@section('title', 'Dashboard')
@section('main_content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                {{-- <span class="text-muted font-weight-bold mr-4">#XRS-45670</span> --}}
                {{-- <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">Add New</a> --}}
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <a href="{{ route('users') }}">
                    <div class="card card-custom bg-info card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-2x svg-icon-white">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span id="total_users"
                                class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"></span>
                            <span class="font-weight-bold text-white font-size-sm">Total Users</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 29-->
                <a href="{{ route('categories') }}">
                    <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                        style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-1.svg)">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z"
                                            fill="#000000" />
                                        <path
                                            d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>

                            <span id="total_cat"
                                class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"></span>
                            <span class="font-weight-bold text-muted font-size-sm">Total Categories</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 29-->
            </div>

            <div class="col-xl-3">
                <!--begin::Stats Widget 31-->
                <a href="{{ route('videos') }}">
                    <div class="card card-custom bg-danger card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Devices/Video-camera.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <rect fill="#000000" x="2" y="6" width="13" height="12" rx="2" />
                                        <path
                                            d="M22,8.4142119 L22,15.5857848 C22,16.1380695 21.5522847,16.5857848 21,16.5857848 C20.7347833,16.5857848 20.4804293,16.4804278 20.2928929,16.2928912 L16.7071064,12.7071013 C16.3165823,12.3165768 16.3165826,11.6834118 16.7071071,11.2928877 L20.2928936,7.70710477 C20.683418,7.31658067 21.316583,7.31658098 21.7071071,7.70710546 C21.8946433,7.89464181 22,8.14899558 22,8.4142119 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span id="total_videos"
                                class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"></span>
                            <span class="font-weight-bold text-white font-size-sm">Total Videos</span>
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
                <!--end::Stats Widget 31-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 32-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Like.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z"
                                        fill="#000000" />
                                    <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span id="total_likes"
                            class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block"></span>
                        <span class="font-weight-bold text-white font-size-sm">Total Likes</span>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 32-->
            </div>
        </div>
        <!--End::Row-->
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Header-->
                    {{-- <div class="card-header h-auto">
                        <!--begin::Title-->
                        <div class="card-title py-5">
                            <h3 class="card-label">Likes</h3>
                        </div>
                        <!--end::Title-->
                    </div> --}}
                    <!--end::Header-->
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart4"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
@endsection
@section('Scripts')
    <!-- Optional JavaScript -->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/features/charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>

    <script>
        //  Users Types
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "/charts/users",
                dataType: "json",
                success: function(response) {
                    $('#total_users').text(response.totalUser);
                }
            });


            // Categories
            $.ajax({
                type: "get",
                url: "/charts/categories",
                dataType: "json",
                success: function(response) {
                    $('#total_cat').text(response.totalCategories);
                }
            });

            // Video Chart
            $.ajax({
                type: "get",
                url: "/charts/videos",
                dataType: "json",
                success: function(response) {
                    $('#total_videos').text(response.totalVideos);
                }
            });

            // Likes Chart

            $.ajax({
                type: "get",
                url: "/charts/likes",
                dataType: "json",
                success: function(response) {
                    $('#total_likes').text(response.totalLikes);
                }
            });


            var options = {
                series: [],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                title: {
                    text: '',

                    style: {
                        fontSize: '20px',
                        fontWeight: 'bolder'
                    }
                },
                subtitle: {
                    text: '',
                    style: {
                        fontSize: '16px',
                        fontWeight: 'light'
                    }
                },
                tooltip: {
                    enabled: true,
                },
            };
            // Successful Park Redemptions
            $("#chart4").ready(function() {
                $.ajax({
                    type: "get",
                    url: "/charts/likes",
                    dataType: "json",
                    success: function(response) {
                        chart4.updateOptions({
                            series: [{
                                name: 'Likes',
                                data: response.Likes,
                            }],
                            labels: response.Month,
                            xaxis: {
                                type: 'datetime',
                            },
                            title: {
                                text: 'Monthly Likes Graph',
                            },
                            subtitle: {
                                text: 'Total: ' + response.totalLikes,
                            },
                            stroke: {
                                colors: ['#0792F1'],
                                curve: 'smooth'
                            },
                            fill: {
                                colors: ['#3598DC'],
                                type: 'solid',
                            },
                        });
                    }
                });
            });
            var chart4 = new ApexCharts(document.querySelector("#chart4"), options);
            chart4.render();
        });
    </script>

@endsection

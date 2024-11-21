@extends('dashboard.core.app')
@section('title', __('dashboard.company'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>@lang('dashboard.Home')</h1>--}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Content Wrapper. Contains page content -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@lang('dashboard.company')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@lang('dashboard.Home')</a></li>
                                <li class="breadcrumb-item active">@lang('dashboard.company')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.loyalty_points')</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <p class="lead">{{$company->name}}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            @isset($company->reference_id)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.reference_id'):</th>
                                                    <td>{{$company->reference_id}}</td>
                                                </tr>
                                            @endisset
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Name'):</th>
                                                    <td>{{$company->t('name')}}</td>
                                                </tr>
                                            @isset($company->totalLoyaltyPoints)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.totalLoyaltyPoints'):</th>
                                                    <td>{{$company->totalLoyaltyPoints}}</td>
                                                </tr>
                                            @endisset
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.company'):</th>
                                                <td><a target="_blank"
                                                       href="{{route('companies.show',$company->id)}}">@lang('dashboard.details')</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="card card-dark">
                                            <div class="card-header ">
                                                <h3 class="card-title">@lang('dashboard.loyalty_points') @lang('dashboard.details')</h3>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>@lang('dashboard.Name')</th>
                                                        <th>@lang('dashboard.type')</th>
                                                        <th>@lang('dashboard.date')</th>
                                                        <th>@lang('dashboard.points')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($loyalty_points as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->referralCompany->t('name') }}</td>
                                                            <td>{{ $item->settingValue }}</td>
                                                            <td>{{ $item->date }}</td>
                                                            <td>{{ $item->points }}</td>
                                                        </tr>
                                                    @empty
                                                        @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js_addons')

    <script>
        function previewImage() {
            var input = document.getElementById('image');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result).show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection


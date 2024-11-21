@extends('dashboard.core.app')
@section('title', __('dashboard.package'))
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
                            <h1>@lang('dashboard.package')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@lang('dashboard.Home')</a></li>
                                <li class="breadcrumb-item active">@lang('dashboard.package')</li>
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
                                <h3 class="card-title">@lang('dashboard.package')</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <p class="lead">{{$package->t('name')}}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.Name'):</th>
                                                <td>{{$package->t('name')}}</td>
                                            </tr>
                                            @isset($package->color)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.reference_id'):</th>
                                                <td><input type="color" value="{{$package->color}}" disabled></td>
                                            </tr>
                                            @endisset
                                            @isset($package->price)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.price'):</th>
                                                <td>{{$package->price}}</td>
                                            </tr>
                                            @endisset
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.subscription_months'):</th>
                                                <td>{{$package->subscription_months??__('dashboard.unlimited')}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.special_offers'):</th>
                                                <td>{{$package->special_offers??__('dashboard.unlimited')}}</td>
                                            </tr>
                                            @isset($package->canAddSubUserValue)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.can_add_sub_user'):</th>
                                                    <td>{{$package->canAddSubUserValue}}</td>
                                                </tr>
                                            @endisset
                                            @isset($package->hasVerifiedBadgeValue)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.has_verified_badge'):</th>
                                                    <td>{{$package->hasVerifiedBadgeValue}}</td>
                                                </tr>
                                            @endisset
                                            @isset($package->canViewCompanyFileValue)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.can_view_company_file'):</th>
                                                    <td>{{$package->canViewCompanyFileValue}}</td>
                                                </tr>
                                            @endisset
                                            @isset($package->isFallbackValue)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.is_fallback'):</th>
                                                    <td>{{$package->isFallbackValue}}</td>
                                                </tr>
                                            @endisset
                                            <tr>
                                            </tbody>
                                        </table>
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

@endsection


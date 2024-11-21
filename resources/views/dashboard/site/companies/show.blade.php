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
                                <h3 class="card-title">@lang('dashboard.company')</h3>
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
                                            @isset($company->typeValue)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.type'):</th>
                                                <td>{{$company->typeValue}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->commercial_registration_no)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.commercial_registration_no'):</th>
                                                <td>{{$company->commercial_registration_no}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->commercial_registration_expiry_date)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.commercial_registration_expiry_date'):</th>
                                                <td>{{$company->commercial_registration_expiry_date}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->istaxValue)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.Tax Exempt'):</th>
                                                <td>{{$company->istaxValue}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->tax_registration_no)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.tax_registration_no'):</th>
                                                <td>{{$company->tax_registration_no}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->city)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.city'):</th>
                                                <td>{{$company->city->t('name')}}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->phone)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.phone'):</th>
                                                <td>{{$company->phone }}</td>
                                            </tr>
                                            @endisset
                                            @isset($company->website_url)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.website_url'):</th>
                                                <td><a href="{{$company->website_url}}">url</a></td>
                                            </tr>
                                            @endisset
                                            @isset($company->logo)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.logo'):</th>
                                                <td><img src="{{asset($company->logo)}}" width="100%" height="auto">
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($company->tax_registration_image)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.tax_registration_image'):</th>
                                                <td><img src="{{asset($company->tax_registration_image)}}" width="100%" height="auto">
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($company->commercial_registration_image)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.commercial_registration_image'):</th>
                                                <td><img src="{{asset($company->commercial_registration_image)}}" width="100%" height="auto">
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($company->authorization_file)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.authorization_file'):</th>
                                                <td>
                                                    <iframe src="{{asset($company->authorization_file)}}" width="100%"
                                                            height="auto"></iframe>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($company->authorization_approval_file)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.authorization_approval_file'):
                                                </th>
                                                <td>
                                                    <iframe src="{{asset($company->authorization_approval_file)}}"
                                                            width="100%" height="auto"></iframe>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($company->bank_details_file)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.bank_details_file'):
                                                </th>
                                                <td>
                                                    <iframe src="{{asset($company->bank_details_file)}}"
                                                            width="100%" height="auto"></iframe>
                                                </td>
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


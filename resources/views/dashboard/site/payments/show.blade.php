@extends('dashboard.core.app')
@section('title', __('dashboard.payment'))
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
                            <h1>@lang('dashboard.payment')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@lang('dashboard.Home')</a></li>
                                <li class="breadcrumb-item active">@lang('dashboard.payment')</li>
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
                                <h3 class="card-title">@lang('dashboard.payment')</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <p class="lead">{{$payment->company?->t('name')}}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            @isset($payment->company)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.company'):</th>
                                                <td>{{$payment->company?->t('name')}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->method)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.method'):</th>
                                                <td>{{$payment->methodValue}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->status)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.status'):</th>
                                                <td>{{$payment->statusValue}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->amount)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.amount'):</th>
                                                <td>{{$payment->amount}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->bank_account_name)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.bank_account_name'):</th>
                                                <td>{{$payment->bank_account_name}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->bank_account_number)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.bank_account_number'):</th>
                                                <td>{{$payment->bank_account_number}}</td>
                                            </tr>
                                            @endisset
                                            @isset($payment->transfer_image)
                                            <tr>
                                                <th style="width:50%">@lang('dashboard.transfer_image'):</th>
                                                <td><img src="{{asset($payment->transfer_image)}}" alt=">@lang('dashboard.transfer_image')" width="100%" height="500px"></td>
                                            </tr>
                                            @endisset
                                            @isset($payment->from_bank)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.from_bank'):</th>
                                                    <td>{{$payment->from_bank}}</td>
                                                </tr>
                                            @endisset
                                            @isset($payment->to_bank)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.to_bank'):</th>
                                                    <td>{{$payment->to_bank}}</td>
                                                </tr>
                                            @endisset
                                            @isset($payment->transfer_date)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.transfer_date'):</th>
                                                    <td>{{$payment->transfer_date}}</td>
                                                </tr>
                                            @endisset
                                            @isset($payment->transfer_time)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.transfer_time'):</th>
                                                    <td>{{$payment->transfer_time}}</td>
                                                </tr>
                                            @endisset

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


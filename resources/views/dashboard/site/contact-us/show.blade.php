@extends('dashboard.core.app')
@section('title', __('dashboard.contact-u'))
@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.contact-us')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.contact-us')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Name')</span>
                                            <span class="info-box-number text-center mb-0">{{$contactUsMessage->name}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.created_at')</span>
                                            <span class="info-box-number text-center mb-0">{{$contactUsMessage->created_at->diffForHumans()}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Phone')</span>
                                            <span class="info-box-number text-center mb-0">{{$contactUsMessage->phone}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Email')</span>
                                            <span class="info-box-number text-center mb-0"><a href="mailto:{{$contactUsMessage->email}}">{{$contactUsMessage->email}}</a></span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.message')</span>
                                            <span class="info-box-number text-center mb-0">{{$contactUsMessage->message}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.is_read')</span>
                                            <span class="info-box-number text-center mb-0">{{$contactUsMessage->is_read_value}}</span>

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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js_addons')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
        });
    </script>
@endsection

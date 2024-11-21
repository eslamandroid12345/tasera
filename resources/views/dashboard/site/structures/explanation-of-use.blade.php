@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.explanation-of-use'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.info_control')</h1>
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
                        <form action="{{ route('explanation-of-use-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.explanation-of-use')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.first_video_platform') </label>

                                            <select id="platform_type" class="form-control" name="all[first][video_platform]">
                                                <option @selected($content['ar']['first']['video_platform'] !== null && $content['ar']['first']['video_platform'] == 'youtube') value="youtube">@lang('dashboard.youtube')</option>
                                                <option @selected($content['ar']['first']['video_platform'] !== null && $content['ar']['first']['video_platform'] == 'vimeo') value="vimeo">@lang('dashboard.vimeo')</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.first_video_url')</label>
                                            <input name="all[first][video_url]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['first']['video_url'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.ar')</label>
                                            <input name="ar[first][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['first']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.en')</label>
                                            <input name="en[first][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['first']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <hr>


                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.second_video_platform') </label>

                                            <select id="platform_type" class="form-control" name="all[second][video_platform]">
                                                <option @selected($content['ar']['second']['video_platform'] !== null && $content['ar']['second']['video_platform'] == 'youtube') value="youtube">@lang('dashboard.youtube')</option>
                                                <option @selected($content['ar']['second']['video_platform'] !== null && $content['ar']['second']['video_platform'] == 'vimeo') value="vimeo">@lang('dashboard.vimeo')</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.second_video_url')</label>
                                            <input name="all[second][video_url]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['second']['video_url'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.ar')</label>
                                            <input name="ar[second][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['second']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.en')</label>
                                            <input name="en[second][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['second']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish')</button>
                            </div>
                        </form>
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
@endsection

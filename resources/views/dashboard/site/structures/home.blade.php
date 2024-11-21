@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.home'))

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
                        <form action="{{ route('home-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.home')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <!-- Hero Section -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input name="ar[hero][title]" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ $content['ar']['hero']['title'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][title]" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{$content['en']['hero']['title'] ?? '' }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input required name="ar[hero][description]" value="{{$content['ar']['hero']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][description]" value="{{$content['en']['hero']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <!-- Hero Section -->

                                <hr>

                                <!-- Statistic Section -->
                                <div class="form-group">
                                    <label for="aboutImage">@lang('dashboard.image') @lang('dashboard.first_statistic')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[statistics][first][image]" type="hidden" value="file_200">
                                                    <input name="ar[statistics][first][image]" type="hidden" value="file_200">
                                                    <input name="file[200]" type="file" class="custom-file-input" id="aboutImage">
                                                    <input name="old_file[200]" type="hidden" value="{{ $content['ar']['statistics']['first']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="aboutImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['statistics']['first']['image'] ?? '' }}" style="width: 60%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.number') @lang('dashboard.first_statistic') </label>
                                            <input name="all[statistics][first][number]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['statistics']['first']['number'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.first_statistic') @lang('dashboard.ar')</label>
                                            <input name="ar[statistics][first][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['statistics']['first']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.first_statistic') @lang('dashboard.en')</label>
                                            <input name="en[statistics][first][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['statistics']['first']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aboutImage">@lang('dashboard.image') @lang('dashboard.second_statistic')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[statistics][second][image]" type="hidden" value="file_300">
                                                    <input name="ar[statistics][second][image]" type="hidden" value="file_300">
                                                    <input name="file[300]" type="file" class="custom-file-input" id="aboutImage">
                                                    <input name="old_file[300]" type="hidden" value="{{ $content['ar']['statistics']['second']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="aboutImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['statistics']['second']['image'] ?? '' }}" style="width: 60%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.number') @lang('dashboard.second_statistic') </label>
                                            <input name="all[statistics][second][number]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['statistics']['second']['number'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.second_statistic') @lang('dashboard.ar')</label>
                                            <input name="ar[statistics][second][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['ar']['statistics']['second']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.second_statistic') @lang('dashboard.en')</label>
                                            <input name="en[statistics][second][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['statistics']['second']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Statistic Section -->

                                <hr>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.title') @lang('dashboard.partners') @lang('dashboard.ar')</label>
                                            <input required name="ar[partners][title]" value="{{$content['ar']['partners']['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.partners') @lang('dashboard.en')</label>
                                            <input name="en[partners][title]" value="{{$content['en']['partners']['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="partners">
                                    @foreach($content['ar']['partners']['images'] ?? [] as $key => $image)
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input name="en[partners][images][{{500 + $key}}]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="ar[partners][images][{{500 + $key}}]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="file[{{ 500 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[{{ 500 + $key }}]" type="hidden" value="{{$image ?? ''}}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <img src="{{$image ?? ''}}" style="width: 60%">
                                            </div>
                                            <div class="col-2">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-1">
                                    <div id="add_partner" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.title') @lang('dashboard.our_services') @lang('dashboard.ar')</label>
                                            <input required name="ar[our_services][title]" value="{{$content['ar']['our_services']['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.our_services') @lang('dashboard.en')</label>
                                            <input name="en[our_services][title]" value="{{$content['en']['our_services']['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="services">
                                    @foreach($content['ar']['our_services']['services'] ?? [] as $key => $service)
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.service') @lang('dashboard.ar')</label>
                                                    <input name="ar[our_services][services][{{7000 + $key}}][title]" value="{{$content['ar']['our_services']['services'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.service') @lang('dashboard.en')</label>
                                                    <input name="en[our_services][services][{{7000 + $key}}][title]" value="{{$content['en']['our_services']['services'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <input name="en[our_services][services][{{7000 + $key}}][image]" type="hidden" value="file_{{ 7000 + $key }}">
                                                    <input name="ar[our_services][services][{{7000 + $key}}][image]" type="hidden" value="file_{{ 7000 + $key }}">
                                                    <input name="file[{{ 7000 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[{{ 7000 + $key }}]" type="hidden" value="{{$service['image'] ?? ''}}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{$service['image'] ?? ''}}" style="width: 60%">
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-1">
                                    <div id="add_service" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                </div>
                                <hr>

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
    <script>
        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });




        let key = {{ max(array_keys($content['ar']['partners']['images'] ?? [0])) ?? 0 }} + 900;
        $('#add_partner').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '    <div class="col-6">' +
                '        <div class="form-group">' +
                '            <input name="en[partners][images][' + key + ']" type="hidden" value="file_' + key + '">' +
                '            <input name="ar[partners][images][' + key + ']" type="hidden" value="file_' + key + '">' +
                '            <input name="file[' + key + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '            <input name="old_file[' + key + ']" type="hidden">' +
                '            <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-2">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '</div>';

            $('#partners').append(content);

        });



        key = {{ max(array_keys($content['ar']['our_services']['services'] ?? [0])) ?? 0 }} + 8000;
        $('#add_service').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '    <div class="col-3">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.service") @lang("dashboard.ar")</label>' +
                '            <input name="ar[our_services][services][' + key + '][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-3">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.service") @lang("dashboard.en")</label>' +
                '            <input name="en[our_services][services][' + key + '][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-3">' +
                '        <div class="form-group">' +
                '            <input name="en[our_services][services][' + key + '][image]" type="hidden" value="file_'+key+'">' +
                '            <input name="ar[our_services][services][' + key + '][image]" type="hidden" value="file_'+key+'">' +
                '            <input name="file['+key+']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '            <input name="old_file['+key+']" type="hidden">' +
                '            <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-1">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '</div>' +
                '';

            $('#services').append(content);




        });
    </script>
@endsection

@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.packages'))

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
                        <form action="{{ route('packages-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.packages')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div id="packages">
                                    @foreach($content['ar']['packages_info'] ?? [] as $key => $package)
                                        <div class="row">
                                            <div class="col-11 row">
                                                <div class="col-6">
                                                    <label for="packagesTitleAr{{$loop->iteration}}">{{ __('dashboard.title') }} @lang('dashboard.ar')</label>
                                                    <input required name="ar[packages_info][{{$key}}][title]" value="{{$content['ar']['packages_info'][$key]['title']}}" type="text" class="form-control" id="packagesTitleAr{{$loop->iteration}}" placeholder="">
                                                </div>
                                                <div class="col-6">
                                                    <label for="packagesTitleEn{{$loop->iteration}}">{{ __('dashboard.title') }} @lang('dashboard.en')</label>
                                                    <input required name="en[packages_info][{{$key}}][title]" value="{{$content['en']['packages_info'][$key]['title']}}" type="text" class="form-control" id="packagesTitleEn{{$loop->iteration}}" placeholder="">
                                                </div>
                                                <div class="col-6">
                                                    <label for="packagesDescriptionAr{{$loop->iteration}}">{{ __('dashboard.description') }} @lang('dashboard.ar')</label>
                                                    <textarea name="ar[packages_info][{{$key}}][description]" class="form-control" id="packagesDescriptionAr{{$loop->iteration}}" rows="2">{{$content['ar']['packages_info'][$key]['description']}}</textarea>
                                                </div>
                                                <div class="col-6">
                                                    <label for="packagesDescriptionEn{{$loop->iteration}}">{{ __('dashboard.description') }} @lang('dashboard.en')</label>
                                                    <textarea name="en[packages_info][{{$key}}][description]" class="form-control" id="packagesDescriptionEn{{$loop->iteration}}" rows="2">{{$content['en']['packages_info'][$key]['description']}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                                <div class="col-1">
                                    <div id="add_package" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
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
    <script>
        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });

        let key = {{ max(array_keys($content['ar']['packages_info'] ?? [0])) ?? 0 }} + 900;
        $('#add_package').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '    <div class="col-11 row">' +
                '        <div class="col-6">' +
                '            <label for="packagesTitleAr' + key + '">{{ __('dashboard.title') }} @lang('dashboard.ar')</label>' +
                '            <input required name="ar[packages_info][' + key + '][title]" type="text" class="form-control" id="packagesTitleAr' + key + '" placeholder="">' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="packagesTitleEn' + key + '">{{ __('dashboard.title') }} @lang('dashboard.en')</label>' +
                '            <input required name="en[packages_info][' + key + '][title]" type="text" class="form-control" id="packagesTitleEn' + key + '" placeholder="">' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="packagesDescriptionAr' + key + '">{{ __('dashboard.description') }} @lang('dashboard.ar')</label>' +
                '            <textarea name="ar[packages_info][' + key + '][description]" class="form-control" id="packagesDescriptionAr' + key + '" rows="2"></textarea>' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="packagesDescriptionEn' + key + '">{{ __('dashboard.description') }} @lang('dashboard.en')</label>' +
                '            <textarea name="en[packages_info][' + key + '][description]" class="form-control" id="packagesDescriptionEn' + key + '" rows="2"></textarea>' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-1">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '</div><hr>' +
                '';

            $('#packages').append(content);

        });
    </script>
@endsection

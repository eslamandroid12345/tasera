@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.terms'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                        <form action="{{ route('terms-and-conditions-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.terms')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div id="policies">
                                    @foreach($content['ar']['terms_and_conditions'] ?? [] as $key => $terms)
                                        <div class="row" style="padding: 10px 0;border-bottom: 1px solid #ccc">
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.ar')</label>
                                                    <input name="ar[terms_and_conditions][{{7000 + $key}}][title]" value="{{$content['ar']['terms_and_conditions'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.en')</label>
                                                    <input name="en[terms_and_conditions][{{7000 + $key}}][title]" value="{{$content['en']['terms_and_conditions'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.ar')</label>
                                                    <input name="ar[terms_and_conditions][{{7000 + $key}}][description]" value="{{$content['ar']['terms_and_conditions'][$key]['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.en')</label>
                                                    <input name="en[terms_and_conditions][{{7000 + $key}}][description]" value="{{$content['en']['terms_and_conditions'][$key]['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-1">
                                    <div id="add_policy" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
            $('.summernote').summernote();
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

        let key = {{ max(array_keys($content['ar']['policies'] ?? [0])) ?? 0 }} + 3132312;
        $('#add_policy').on('click', function () {
            key++;
            const content = '' +
                '<div class="row" style="padding: 10px 0;border-bottom: 1px solid #ccc">' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.ar")</label>' +
                '            <input name="ar[terms_and_conditions][' + key + '][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.en")</label>' +
                '            <input name="en[terms_and_conditions][' + key + '][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.description") @lang("dashboard.ar")</label>' +
                '            <input name="ar[terms_and_conditions][' + key + '][description]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.description") @lang("dashboard.en")</label>' +
                '            <input name="en[terms_and_conditions][' + key + '][description]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-2">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '</div>' +
                '';

            $('#policies').append(content);

        });
    </script>
@endsection

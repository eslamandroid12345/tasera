@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.explanation-of-use-buyer'))

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
                        <form action="{{ route('explanation-of-use-buyer-content.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.explanation-of-use-buyer')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div id="explanation_of_use">
                                    @foreach($content['ar']['explanation_of_use'] ?? [] as $key => $explanation)
                                        <div class="row" style="padding: 10px 0;border-bottom: 1px solid #ccc">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <input name="en[explanation_of_use][{{7000 + $key}}][image]" type="hidden" value="file_{{ 7000 + $key }}">
                                                    <input name="ar[explanation_of_use][{{7000 + $key}}][image]" type="hidden" value="file_{{ 7000 + $key }}">
                                                    <input name="file[{{ 7000 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[{{ 7000 + $key }}]" type="hidden" value="{{$explanation['image'] ?? ''}}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img src="{{$explanation['image'] ?? ''}}" style="width: 60%">
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.explanation') @lang('dashboard.ar')</label>
                                                    <input name="ar[explanation_of_use][{{7000 + $key}}][title]" value="{{$content['ar']['explanation_of_use'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.title') @lang('dashboard.explanation') @lang('dashboard.en')</label>
                                                    <input name="en[explanation_of_use][{{7000 + $key}}][title]" value="{{$content['en']['explanation_of_use'][$key]['title'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.explanation') @lang('dashboard.ar')</label>
                                                    <input name="ar[explanation_of_use][{{7000 + $key}}][description]" value="{{$content['ar']['explanation_of_use'][$key]['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.explanation') @lang('dashboard.en')</label>
                                                    <input name="en[explanation_of_use][{{7000 + $key}}][description]" value="{{$content['en']['explanation_of_use'][$key]['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-1">
                                    <div id="add_explanation" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
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

        key = {{ max(array_keys($content['ar']['explanation_of_use'] ?? [0])) ?? 0 }} + 8000;
        $('#add_explanation').on('click', function () {
            key++;
            const content = '' +
                '<div class="row" style="padding: 10px 0;border-bottom: 1px solid #ccc">' +
                '    <div class="col-8">' +
                '        <div class="form-group">' +
                '            <input name="en[explanation_of_use]['+ key +'][image]" type="hidden" value="file_'+ key +'">' +
                '            <input name="ar[explanation_of_use]['+ key +'][image]" type="hidden" value="file_'+ key +'">' +
                '            <input name="file['+ key +']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '            <input name="old_file['+ key +']" type="hidden">' +
                '            <label class="custom-file-label" for="exampleInputFile">Choose file</label>' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.exlanation") @lang("dashboard.ar")</label>' +
                '            <input name="ar[explanation_of_use]['+ key +'][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.title") @lang("dashboard.exlanation") @lang("dashboard.en")</label>' +
                '            <input name="en[explanation_of_use]['+ key +'][title]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-2">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.description") @lang("dashboard.exlanation") @lang("dashboard.ar")</label>' +
                '            <input name="ar[explanation_of_use]['+ key +'][description]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-5">' +
                '        <div class="form-group">' +
                '            <label for="exampleInputContent1">@lang("dashboard.description") @lang("dashboard.exlanation") @lang("dashboard.en")</label>' +
                '            <input name="en[explanation_of_use]['+ key +'][description]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '        </div>' +
                '    </div>' +
                '</div>' +
                '';

            $('#explanation_of_use').append(content);




        });
    </script>
@endsection

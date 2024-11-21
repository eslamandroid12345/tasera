@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.infos'))

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
                    <h1>@lang('dashboard.infos')</h1>
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
                        <form action="{{ route('infos.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.infos')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle1">@lang('dashboard.website') @lang('dashboard.title_en')</label>
                                            <input required name="en[title]" value="{{$content['en']['title']??null}}" type="text" class="form-control" id="exampleInputMainTitle1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.website') @lang('dashboard.title_ar')</label>
                                            <input name="ar[title]" value="{{$content['ar']['title']??null}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.website') @lang('dashboard.desc_en')</label>
                                            <textarea name="en[desc]"class="form-control"  required>{{$content['en']['desc']??null}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.website') @lang('dashboard.desc_ar')</label>
                                            <textarea name="ar[desc]"class="form-control"  required>{{$content['ar']['desc']??null}}</textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9" style="align-content: center;display: grid;">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.logo')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[logo]" type="hidden" value="file_120">
                                                    <input name="ar[logo]" type="hidden" value="file_120">
                                                    <input name="file[120]" type="file" class="custom-file-input"
                                                           id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                    <input name="old_file[120]" type="hidden"
                                                           value="{{ $content['ar']['logo'] ?? null }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ $content['ar']['logo'] ?? null }}" style="width: 60%">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9" style="align-content: center;display: grid;">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.fav_icon')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[fav_icon]" type="hidden" value="file_121">
                                                    <input name="ar[fav_icon]" type="hidden" value="file_121">
                                                    <input name="file[121]" type="file" class="custom-file-input"
                                                           id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                    <input name="old_file[121]" type="hidden"
                                                           value="{{ $content['ar']['fav_icon'] ?? null }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ $content['ar']['fav_icon'] ?? null }}" style="width: 60%">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9" style="align-content: center;display: grid;">
                                        <div class="form-group" style="width: 100%;">
                                            <label for="exampleInputFile">@lang('dashboard.authorization_file')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[authorization_file]" type="hidden" value="file_123">
                                                    <input name="ar[authorization_file]" type="hidden" value="file_123">
                                                    <input name="file[123]" type="file" class="custom-file-input"
                                                           id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                    <input name="old_file[123]" type="hidden"
                                                           value="{{ $content['ar']['authorization_file'] ?? null }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        @isset($content['ar']['authorization_file'])
                                            <a href="{{ $content['ar']['authorization_file'] ?? null }}" target="_blank">@lang('dashboard.download')</a>
                                        @endisset
                                    </div>
                                </div>
                                <hr>
                                <br><br><br>
                                <div >
                                    <p class="h4">@lang('dashboard.contacts')</p>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputMainTitle2">@lang('dashboard.contact_us_phone')</label>
                                            <input name="all[contacts][contact_us_phone]" value="{{$content['en']['contacts']['contact_us_phone']??null}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <p class="h5">@lang('dashboard.complaints_phones')</p>
                                    <div id="phones">
                                        @if(isset($content['en']['contacts']['complaints_phones']))
                                            @foreach($content['en']['contacts']['complaints_phones'] as $k => $phone)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputMainTitle2">@lang('dashboard.complaints_phone') {{++$k}}</label>
                                                            <input name="all[contacts][complaints_phones][]" value="{{$phone??null}}" type="number" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="delete_content" style="cursor: pointer;"><i
                                                                style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-1">
                                        <div id="add_phone" style="cursor: pointer;"><i style="color: green"
                                                                                        class="nav-icon fas fa-plus-circle"></i></div>
                                    </div>
                                </div>
                                <br><br><br>

                                <hr>
                                <br><br><br>
                                <div id="social_accounts">
                                    <p class="h4">@lang('dashboard.social_media')</p>
                                    @if(isset($content['en']['social']))
                                        @foreach($content['en']['social'] as $key => $social)
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input name="en[social][{{$key}}][icon]" type="hidden" value="file_{{ 1000 + $key }}">
                                                        <input name="ar[social][{{$key}}][icon]" type="hidden" value="file_{{ 1000 + $key }}">
                                                        <input name="file[{{ 1000 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                        <input name="old_file[{{ 1000 + $key }}]" type="hidden" value="{{$content['en']['social'][$key]['icon'] ?? ''}}">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <input required name="all[social][{{$key}}][link]" value="{{$social['link']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                </div>
                                                <div class="col-1">
                                                    <img src="{{$content['en']['social'][$key]['icon'] ?? ''}}" style="width: 60%">
                                                </div>
                                                <div class="col-1">
                                                    <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif

                                </div>
                                <div class="col-1">
                                    <div id="add_social" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
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
    <script>
        $('.row').on('click', '.delete_content', function(e) {
            $(this).parent().parent().remove();
        });
        let index = {{ isset($content['en']['contacts']['phones']) ? max(array_keys($content['en']['contacts']['complaints_phones'])) : 0 }};
        $(document).ready(function() {
            $('#add_phone').click(function() {
                index++
                var newPhone = `<div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputMainTitle2">@lang('dashboard.complaints_phone')</label>
                                                        <input name="all[contacts][complaints_phones][]"  type="number" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="delete_content" style="cursor: pointer;"><i
                                                            style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>`;
                $('#phones').append(newPhone);
            });
        });
        let social_index = {{ isset($content['en']['social']) ? max(array_keys($content['en']['social'])) : 0  }};
        $('#add_social').on('click' , function (){
            social_index++ ;
            var content = `<div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input name="en[social][${social_index}][icon]" type="hidden" value="file_${social_index+2000}">
                                                    <input name="ar[social][${social_index}][icon]" type="hidden" value="file_${social_index+2000}">
                                                    <input name="file[${social_index+2000}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[${social_index+2000}]" type="hidden" >
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input required name="all[social][${social_index}][link]" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>`;

            $('#social_accounts').append(content);

        });

    </script>
@endsection

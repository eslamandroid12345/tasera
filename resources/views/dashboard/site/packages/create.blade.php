@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.packages'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.packages')</h1>
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
                        <form action="{{ route('packages.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create') @lang('dashboard.package')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name Ar')</label>
                                            <input name="name_ar" type="text" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('name_ar') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('name_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Name En')</label>
                                            <input name="name_en" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{ old('name_en') }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('name_en')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="price">@lang('dashboard.price')</label>
                                            <input name="price" type="text" class="form-control"
                                                   id="price" value="{{ old('price') }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="color">@lang('dashboard.color')</label>
                                            <input type="color" name="color" id="favcolor" value="{{old('color')??'#ff0000'}}" required>
                                        </div>
                                    </div>
                                    @error('color')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="subscription_months">@lang('dashboard.subscription_months')</label>
                                            <span class="text-sm">"@lang('dashboard.left_it_empty_for_unlimited')"</span>
                                            <input name="subscription_months" type="text" class="form-control"
                                                   id="price" value="{{ old('subscription_months') }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('subscription_months')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="special_offers">@lang('dashboard.special_offers')</label>
                                            <span class="text-sm">"@lang('dashboard.left_it_empty_for_unlimited')"</span>
                                            <input name="special_offers" type="text" class="form-control"
                                                   id="price" value="{{ old('special_offers') }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('special_offers')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="can_add_sub_user" class="form-label">@lang('dashboard.can_add_sub_user'): </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="can_add_sub_user"  required id="can_add_sub_userYes" value="1" {{old('can_add_sub_user')=='1'?'checked':''}}>
                                            <label class="form-check-label" for="can_add_sub_userYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="can_add_sub_user" required  id="can_add_sub_userNo" value="0"  {{old('can_add_sub_user')=='0'?'checked':''}}>
                                            <label class="form-check-label" for="can_add_sub_userNo">No</label>
                                        </div>
                                    </div>
                                    </div>
                                    @error('can_add_sub_user')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="has_verified_badge" class="form-label">@lang('dashboard.has_verified_badge'): </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_verified_badge"  required id="has_verified_badgeYes" value="1" {{old('has_verified_badge')=='1'?'checked':''}}>
                                            <label class="form-check-label" for="has_verified_badgeYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_verified_badge" required  id="has_verified_badgetNo" value="0"  {{old('has_verified_badge')=='0'?'checked':''}}>
                                            <label class="form-check-label" for="has_verified_badgetNo">No</label>
                                        </div>
                                    </div>
                                    </div>
                                    @error('has_verified_badge')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="can_view_company_file" class="form-label">@lang('dashboard.can_view_company_file'): </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="can_view_company_file"  required id="can_view_company_fileYes" value="1" {{old('can_view_company_file')=='1'?'checked':''}}>
                                            <label class="form-check-label" for="can_view_company_fileYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="can_view_company_file" required  id="can_view_company_fileNo" value="0"  {{old('can_view_company_file')=='0'?'checked':''}}>
                                            <label class="form-check-label" for="can_view_company_fileNo">No</label>
                                        </div>
                                    </div>
                                    </div>
                                    @error('can_view_company_file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_fallback" class="form-label">@lang('dashboard.is_fallback'): </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_fallback"  required id="is_fallbackYes" value="1" {{old('is_fallback')=='1'?'checked':''}}>
                                            <label class="form-check-label" for="is_fallbackYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_fallback" required  id="is_fallbackNo" value="0"  {{old('is_fallback')=='0'?'checked':''}}>
                                            <label class="form-check-label" for="is_fallbackNo">No</label>
                                        </div>
                                    </div>
                                    </div>
                                    @error('is_fallback')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
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
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function () {
                    }
                },
            });
        });
    </script>
@endsection

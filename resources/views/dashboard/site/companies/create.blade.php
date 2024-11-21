@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.companies'))

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
                    <h1>@lang('dashboard.companies')</h1>
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
                        <form action="{{ route('companies.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create') @lang('dashboard.company')</h3>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('dashboard.type')</label>
                                            <select class="form-control" name="type">
                                                    <option {{old('type')=='buyer'?'selected':''}} value="buyer">@lang('dashboard.buyer')</option>
                                                    <option {{old('type')=='supplier'?'selected':''}} value="supplier">@lang('dashboard.supplier')</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="select2">@lang('dashboard.fields')</label>
                                        <select id="select2" name="fields[]" class="select2 select2-hidden-accessible" multiple style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            @foreach($fields as $item)
                                                <option @if(old('fields') !== null && in_array($item['id'], old('fields'))) selected @endif value="{{$item['id']}}">{{$item->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.website_url')</label>
                                            <input name="website_url" type="text" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('website_url') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('website_url')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.logo')</label>
                                            <input name="logo" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.authorization_approval_file')</label>
                                            <input name="authorization_approval_file" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('authorization_approval_file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.commercial_registration_no')</label>
                                            <input name="commercial_registration_no" type="text" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('commercial_registration_no') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('commercial_registration_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.commercial_registration_image')</label>
                                            <input name="commercial_registration_image" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('commercial_registration_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.commercial_registration_expiry_date')</label>
                                            <input name="commercial_registration_expiry_date" type="date" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('commercial_registration_expiry_date') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('commercial_registration_expiry_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="taxExemptYes" class="form-label">@lang('dashboard.Tax Exempt'): </label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_tax_exempt"  required id="taxExemptYes" value="1" {{old('is_tax_exempt'=='1'?'checked':'')}}>
                                                <label class="form-check-label" for="taxExemptYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_tax_exempt" required  id="taxExemptNo" value="0"  {{old('is_tax_exempt'=='0'?'checked':'')}}>
                                                <label class="form-check-label" for="taxExemptNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('commercial_registration_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.tax_registration_no')</label>
                                            <input name="tax_registration_no" type="text" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('tax_registration_no') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('tax_registration_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.tax_registration_image')</label>
                                            <input name="tax_registration_image" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('tax_registration_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('dashboard.city')</label>
                                            <select class="form-control" name="city_id">
                                                @foreach($cities as $item)
                                                <option {{old('city_id')==$item->id?'selected':''}} value="{{$item->id}}">{{$item->t('name')}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.phone')</label>
                                            <input name="phone" type="text" class="form-control"
                                                   id="exampleInputName1"
                                                   value="{{ old('phone') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.bank_details_file')</label>
                                            <input name="bank_details_file" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('bank_details_file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.about_us')</label>
                                            <textarea  name="about_us" class="form-control"
                                                       id="exampleInputEmail1"  placeholder=""
                                                       >{{old('about_us')}}</textarea>
                                        </div>
                                    </div>
                                    @error('about_us')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.vision')</label>
                                            <textarea  name="vision" class="form-control"
                                                       id="exampleInputEmail1"  placeholder=""
                                                       >{{old('vision')}}</textarea>
                                        </div>
                                    </div>
                                    @error('vision')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.message')</label>
                                            <textarea  name="message" class="form-control"
                                                       id="exampleInputEmail1"  placeholder=""
                                                       >{{old('message')}}</textarea>
                                        </div>
                                    </div>
                                    @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.achievements_file')</label>
                                            <input name="achievements_file" type="file" class="form-control"
                                                   id="exampleInputEmail1"  placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                    @error('achievements_file')
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

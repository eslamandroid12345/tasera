@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.packages'))
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
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.packages')</h3>
                            @permission('packages-create')
                            <div class="card-tools">
                                <a href="{{ route('packages.create') }}"
                                   class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                            @endpermission
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name Ar')</th>
                                    <th>@lang('dashboard.Name En')</th>
                                    <th>@lang('dashboard.Active')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package->name_ar }}</td>
                                        <td>{{ $package->name_en }}</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" {{$package->is_active=='1'?'checked':''}} class="custom-control-input status-toggle" id="customSwitch{{ $package->id }}" data-item-id="{{ $package->id }}">
                                                <label class="custom-control-label" for="customSwitch{{ $package->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @permission('packages-update')
                                                <a href="{{ route('packages.edit', $package->id) }}"
                                                   class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endpermission
                                                @permission('packages-read')
                                                <a href="{{ route('packages.show', $package->id) }}"
                                                   class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endpermission
                                                @if(auth()->user()->hasPermission('packages-delete')&& Gate::allows('delete-package',$package))
                                                    <button class="btn btn-danger waves-effect waves-light"
                                                            data-toggle="modal"
                                                            data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                    <div id="delete-modal{{ $loop->iteration }}"
                                                         class="modal fade modal2 " tabindex="-1" role="dialog"
                                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                                         style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form
                                                                        action="{{ route('packages.destroy', $package->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit"
                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    {{-- <a target="_blank" href="{{ route('packages.loginFromAdmin', $package->id) }}" class="btn  btn-success">@lang('dashboard.Login')</a> --}}

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $packages->appends(request()->all())->links() }}
                        </div>
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
        $(document).ready(function () {
            $('.status-toggle').on('change', function () {
                var itemId = $(this).data('item-id');
                var status = $(this).prop('checked') ? '1' : '0';

                $.ajax({
                    url: "{{ route('togglePackage') }}", // Replace with your actual route
                    type: "GET", // or "GET" depending on your server setup
                    data: {
                        itemId: itemId,
                        status: status,
                        // Add any additional data you want to send with the request
                    },
                    success: function (data) {
                        toastr.success('@lang('messages.updated_successfully')');
                        // console.log(data); // Handle success response
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Handle error response
                    }
                });
            });
        });
    </script>
@endsection

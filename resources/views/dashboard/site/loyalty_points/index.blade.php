@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.buyers'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.loyalty_points')</h1>
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
                            <h3 class="card-title">@lang('dashboard.buyers')</h3>
                            @permission('buyers-create')
                            <div class="card-tools">
                                <a href="{{ route('buyers.create') }}"
                                   class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                            @endpermission
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.reference_id')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.logo')</th>
                                    <th>@lang('dashboard.loyalty_points')</th>
                                    @permission('loyalty-points-update')
                                    <th>@lang('dashboard.has_loyalty_points')</th>
                                    @endpermission
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($buyers as $buyer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $buyer->reference_id }}</td>
                                        <td>{{ $buyer->t('name') }}</td>
                                        <td><img src="{{ asset($buyer->logo) }}" width="50px" height="50px"></td>
                                        <td>{{ $buyer->totalLoyaltyPoints??null }}</td>
                                        @permission('loyalty-points-update')
                                        <td>
                                            @if($buyer->has_loyalty_points==1)
                                                <button class="btn btn-primary waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#deactive-modal{{ $loop->iteration }}">@lang('dashboard.Yes')</button>
                                                <div id="deactive-modal{{ $loop->iteration }}"
                                                     class="modal fade modal2 " tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel" aria-hidden="true"
                                                     style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.confirmation_deactive')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.confirm_deactive')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form
                                                                    action="{{ route('loyalty-points.update', $buyer->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    {{ method_field('put') }}
                                                                    <button type="submit"
                                                                            class="btn btn-danger">@lang('dashboard.deactive')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button class="btn btn-danger waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#active-modal{{ $loop->iteration }}">@lang('dashboard.No')</button>
                                                <div id="active-modal{{ $loop->iteration }}"
                                                     class="modal fade modal2 " tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel" aria-hidden="true"
                                                     style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.confirmation_active')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.confirm_active')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form
                                                                    action="{{ route('loyalty-points.update', $buyer->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    {{ method_field('put') }}
                                                                    <button type="submit"
                                                                            class="btn btn-primary">@lang('dashboard.Active')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        @endpermission
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if(auth()->user()->hasPermission('loyalty-points-read')&&$buyer->has_loyalty_points==1)
                                                <a href="{{ route('loyalty-points.show', $buyer->id) }}"
                                                   class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endif
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
                            {{ $buyers->appends(request()->all())->links() }}
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
    </script>
@endsection

@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.offer'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.offer')</h1>
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
                            <h3 class="card-title">@lang('dashboard.offer') @lang('dashboard.details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 row">


                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.offer') @lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table">
                                                <tbody>
                                                @if($offer->reference_id)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.reference_id'):</th>
                                                        <td>{{$offer->reference_id}}</td>
                                                    </tr>
                                                @endif
                                                @if($offer->tax)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.tax'):</th>
                                                        <td>{{$offer->tax?->value}}</td>
                                                    </tr>
                                                @endif
                                                @if($offer->company)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.company'):</th>
                                                        <td>{{$offer->company?->t('name')}}</td>
                                                    </tr>
                                                @endif
                                                @if($offer->user)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.user'):</th>
                                                        <td>{{$offer->user?->name}}</td>
                                                    </tr>
                                                @endif
                                                @if($offer->attachment)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.attachment'):</th>
                                                        <td><a href="{{ asset($offer->attachment) }}"
                                                               target="_blank">@lang('dashboard.attachment')</a></td>
                                                    </tr>
                                                @endif
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.is_special'):</th>
                                                        <td>{{$offer->isSpecialValue}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.is_approved'):</th>
                                                        <td>{{$offer->isApprovedValue}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    @permission('purchase-orders-offers-units-read')
                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.demandUnits') @lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>@lang('dashboard.Name')</th>
                                                    <th>@lang('dashboard.price')</th>
                                                    <th>@lang('dashboard.Operations')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($offer->demandUnits as $demand_unit)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $demand_unit->demandUnit->name }}</td>
                                                        <td>{{ $demand_unit->price }}</td>
                                                        <td>
                                                            <div class="operations-btns" style="">
                                                                @if(auth()->user()->hasPermission('purchase-orders-offers-units-delete'))
                                                                    <button
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-toggle="modal"
                                                                        data-target="#delete-dmeand-unit-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                    <div id="delete-dmeand-unit-modal{{ $loop->iteration }}"
                                                                         class="modal fade modal2 " tabindex="-1"
                                                                         role="dialog"
                                                                         aria-labelledby="myModalLabel"
                                                                         aria-hidden="true"
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
                                                                                    <button type="button"
                                                                                            data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{ route('offer-demand-units.destroy', $demand_unit->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{ method_field('delete') }}
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                                    </div>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.col -->
        <!-- /.container-fluid -->
    </section>
@endsection
@section('js_addons')
@endsection

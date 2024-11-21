@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.unapproved_purchase_order_offers'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.unapproved_purchase_order_offers')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark col-12">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.offers') @lang('dashboard.details')</h3>
                        </div>

                        <div class="card-body row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.reference_id')</th>
                                    <th>@lang('dashboard.company')</th>
                                    <th>@lang('dashboard.price')</th>
                                    <th>@lang('dashboard.purchase_order')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($offers as $offer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $offer->reference_id }}</td>
                                        <td>{{ $offer->company->t('name') }}</td>
                                        <td>{{ $offer->totalPrice }}</td>
                                        <td>
                                            <a href="{{ route('purchase-orders.show', $offer->purchase_order_id) }}">{{ $offer->purchaseOrder->title }}</a>
                                        </td>
                                        <td>{{ $offer->full_published_at }}</td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @permission('purchase-orders-offers-read')
                                                <a href="{{ route('offers.show', $offer->id) }}"
                                                   class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endpermission
                                                @if(!$offer->is_published)
                                                        <button class="btn btn-success waves-effect waves-light"
                                                                data-toggle="modal"
                                                                data-target="#approve-inquire-modal{{ $loop->iteration }}">@lang('dashboard.approve')</button>
                                                    <div id="approve-inquire-modal{{ $loop->iteration }}"
                                                         class="modal fade modal2 " tabindex="-1" role="dialog"
                                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                                         style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.confirm_approve')</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.Are you sure you want to publish this?')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form
                                                                        action="{{ route('offers.approve', $offer->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{ method_field('put') }}
                                                                        <button type="submit"
                                                                                class="btn btn-success">@lang('dashboard.approve')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                                @if(auth()->user()->hasPermission('purchase-orders-offers-delete'))
                                                    <button
                                                        class="btn btn-danger waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#delete-offer-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                    <div id="delete-offer-modal{{ $loop->iteration }}"
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
                                                                        action="{{ route('offers.destroy', $offer->id) }}"
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

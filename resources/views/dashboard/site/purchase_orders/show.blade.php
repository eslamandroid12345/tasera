@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.purchase_order'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.purchase_order')</h1>
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
                            <h3 class="card-title">@lang('dashboard.purchase_order') @lang('dashboard.details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 row">


                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.purchase_order') @lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table">
                                                <tbody>
                                                @if($purchase_order->reference_id)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.reference_id'):</th>
                                                        <td>{{$purchase_order->reference_id}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->title)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.title'):</th>
                                                        <td>{{$purchase_order->title}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->company)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.company'):</th>
                                                        <td>{{$purchase_order->company->t('name')}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->userName)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.user_name'):</th>
                                                        <td>{{$purchase_order->userName}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->status)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.status'):</th>
                                                        <td>
                                                            <select class="custom-select"
                                                                    id="statusSelect_{{ $purchase_order->id }}">
                                                                <option
                                                                    value="under_review" {{$purchase_order->status=='under_review'?'selected':''}}>@lang('dashboard.under_review')</option>
                                                                <option
                                                                    value="available" {{$purchase_order->status=='available'?'selected':''}}>@lang('dashboard.available')</option>
{{--                                                                <option--}}
{{--                                                                    value="available_urgently" {{$purchase_order->status=='available_urgently'?'selected':''}}>@lang('dashboard.available_urgently')</option>--}}
                                                                <option
                                                                    value="canceled" {{$purchase_order->status=='canceled'?'selected':''}}>@lang('dashboard.canceled')</option>
                                                                <option
                                                                    value="expired" {{$purchase_order->status=='expired'?'selected':''}}>@lang('dashboard.expired')</option>
                                                                <option
                                                                    value="approved" {{$purchase_order->status=='approved'?'selected':''}}>@lang('dashboard.approved')</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->typeValue)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.type'):</th>
                                                        <td>{{$purchase_order->typeValue}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->deliveryCity)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.deliveryCity'):</th>
                                                        <td>{{$purchase_order->deliveryCity->t('name')}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->closes_at)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.closes_at'):</th>
                                                        <td>{{$purchase_order->closes_at}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->delivery_duration)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.delivery_duration'):</th>
                                                        <td>{{$purchase_order->delivery_duration}} @lang('dashboard.day')</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->payment_duration)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.payment_duration'):</th>
                                                        <td>{{$purchase_order->payment_duration}} @lang('dashboard.day')</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->description)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.description'):</th>
                                                        <td>{{$purchase_order->description}}</td>
                                                    </tr>
                                                @endif
                                                @if($purchase_order->fields)
                                                    <tr>
                                                        <th style="width:50%">@lang('dashboard.fields'):</th>
                                                        <td>
                                                            @foreach($purchase_order->fields as $field)
                                                                {{$field->t('name') . ' , '}}
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    @permission('purchase-orders-demand-unit-read')
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
                                                    <th>@lang('dashboard.quantity')</th>
                                                    <th>@lang('dashboard.type')</th>
                                                    <th>@lang('dashboard.details')</th>
                                                    <th>@lang('dashboard.attachment')</th>
                                                    <th>@lang('dashboard.Operations')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($purchase_order->demandUnits as $demand_unit)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $demand_unit->name }}</td>
                                                        <td>{{ $demand_unit->quantity }}</td>
                                                        <td>{{ $demand_unit->type->t('name') }}</td>
                                                        <td>{{ $demand_unit->details }}</td>
                                                        <td><a href="{{ asset($demand_unit->attachment) }}"
                                                               target="_blank">@lang('dashboard.attachment')</a></td>
                                                        <td>
                                                            <div class="operations-btns" style="">
                                                                @if(auth()->user()->hasPermission('purchase-orders-delete'))
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
                                                                                        action="{{ route('demand-units.destroy', $demand_unit->id) }}"
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
                                    @permission('purchase-orders-inquiries-read')
                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.inquiries') @lang('dashboard.details')</h3>
                                        </div>

                                        <ul class="card-body row">
                                            @forelse($purchase_order->inquiries as $item)
                                                <div class="card mb-3 w-100">
                                                    <div class="card-header">
                                                        <div class=" align-items-center">
                                                            <img src="{{ asset($item->company->logo) }}"
                                                                 alt="{{ $item->company->t('name') }}"
                                                                 class="rounded-circle mr-2"
                                                                 style="width: 40px; height: 40px;">
                                                            <span>{{ $item->company->t('name') }}</span>

                                                            <div class="card-tools">


                                                                @if(!$item->is_published)
                                                                    <div class="btn btn-sm btn-success ml-auto">
                                                                        <button class="btn btn-success waves-effect waves-light"
                                                                                data-toggle="modal"
                                                                                data-target="#approve-inquire-modal{{ $loop->iteration }}">@lang('dashboard.approve')</button>
                                                                    </div>
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
                                                                                        action="{{ route('inquiries.approve', $item->id) }}"
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


                                                                <div class="btn btn-sm btn-danger ml-auto">
                                                                    <button class="btn btn-danger waves-effect waves-light"
                                                                            data-toggle="modal"
                                                                            data-target="#delete-inquire-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                </div>
                                                                <div id="delete-inquire-modal{{ $loop->iteration }}"
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
                                                                                    action="{{ route('inquiries.destroy', $item->id) }}"
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
                                                            </div>



                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="card-text ">{{ $item->content }}</p>
                                                        @if($item->reply)
                                                            <div class="card bg-light mt-3">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="btn btn-sm btn-danger ml-auto">
                                                                            <button
                                                                                class="btn btn-danger waves-effect waves-light"
                                                                                data-toggle="modal"
                                                                                data-target="#delete-reply-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                        </div>
                                                                        <div
                                                                            id="delete-reply-modal{{ $loop->iteration }}"
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
                                                                                            action="{{ route('inquiries.destroy', $item->reply->id) }}"
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
                                                                    </div>
                                                                    <p class="card-text">
                                                                        <strong>Reply:</strong> {{ $item->reply->content }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No inquiries available.</p>
                                        @endforelse
                                    </div>
                                    @endpermission
                                    @permission('purchase-orders-offers-read')
                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.offers') @lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>@lang('dashboard.company')</th>
                                                    <th>@lang('dashboard.price')</th>
                                                    <th>@lang('dashboard.reference_id')</th>
                                                    <th>@lang('dashboard.logo')</th>
                                                    <th>@lang('dashboard.Operations')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($purchase_order->offers as $offer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $offer->company->t('name') }}</td>
                                                        <td>{{ $offer->totalPrice }}</td>
                                                        <td>{{ $offer->reference_id }}</td>
                                                        <td><img src="{{ asset($offer->company->logo) }}"
                                                                 alt="{{ $offer->company->t('name') }}"
                                                                 class="rounded-circle mr-2"
                                                                 style="width: 40px; height: 40px;"></td>
                                                        <td>
                                                            <div class="operations-btns" style="">
                                                                @permission('purchase-orders-offers-read')
                                                                <a href="{{ route('offers.show', $offer->id) }}"
                                                                   class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                                @endpermission

                                                                @if(!$offer->is_published)
                                                                        <button class="btn btn-success waves-effect waves-light"
                                                                                data-toggle="modal"
                                                                                data-target="#approve-offer-modal{{ $loop->iteration }}">@lang('dashboard.approve')</button>
                                                                    <div id="approve-offer-modal{{ $loop->iteration }}"
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
    <script>
        $(document).ready(function () {
            $('[id^="statusSelect_"]').change(function () {
                var selectedStatus = $(this).val();
                var purchaseOrderId = $(this).attr('id').split('_')[1];
                console.log(selectedStatus)
                console.log(purchaseOrderId)
                $.ajax({
                    url: '{{ route('purchase-orders.update', ['purchase_order' => '__purchase_order_id__']) }}'
                        .replace('__purchase_order_id__', purchaseOrderId),
                    type: 'PUT',
                    data: {
                        status: selectedStatus,
                        purchase_order_id: '{{ $purchase_order->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        toastr.success('@lang('messages.updated_successfully')');
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection

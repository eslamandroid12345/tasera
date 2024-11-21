@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.purchase_orders'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.purchase_orders')</h1>
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
                            <h3 class="card-title">@lang('dashboard.purchase_orders')</h3>
                            @permission('purchase_orders-create')
                            <div class="card-tools">
                                <a href="{{ route('purchase_orders.create') }}"
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
                                    <th>@lang('dashboard.title')</th>
                                    <th>@lang('dashboard.company')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($purchase_orders as $purchase_order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase_order->reference_id }}</td>
                                        <td>{{ $purchase_order->title }}</td>
                                        <td>{{ $purchase_order->company->t('name') }}</td>
                                        <td>
                                            <select class="custom-select" id="statusSelect_{{ $purchase_order->id }}">
                                                <option value="under_review" {{$purchase_order->status=='under_review'?'selected':''}}>@lang('dashboard.under_review')</option>
                                                <option value="available" {{$purchase_order->status=='available'?'selected':''}}>@lang('dashboard.available')</option>
{{--                                                <option value="available_urgently" {{$purchase_order->status=='available_urgently'?'selected':''}}>@lang('dashboard.available_urgently')</option>--}}
                                                <option value="canceled" {{$purchase_order->status=='canceled'?'selected':''}}>@lang('dashboard.canceled')</option>
                                                <option value="expired" {{$purchase_order->status=='expired'?'selected':''}}>@lang('dashboard.expired')</option>
                                                <option value="approved" {{$purchase_order->status=='approved'?'selected':''}}>@lang('dashboard.approved')</option>
                                            </select>
                                        </td>
                                        <td>{{ $purchase_order->full_published_at }}</td>
                                        <td>{{ $purchase_order->typeValue }}</td>
{{--                                        <td><img src="{{ asset($purchase_order->logo) }}" width="50px" height="50px"></td>--}}
                                        <td>
                                            <div class="operations-btns" style="">
                                                @permission('purchase-orders-read')
                                                <a href="{{ route('purchase-orders.show', $purchase_order->id) }}"
                                                   class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                @endpermission
                                                @if(auth()->user()->hasPermission('purchase-orders-delete'))
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
                                                                        action="{{ route('purchase-orders.destroy', $purchase_order->id) }}"
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $purchase_orders->appends(request()->all())->links() }}
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
        $(document).ready(function() {
            $('[id^="statusSelect_"]').change(function() {
                var selectedStatus = $(this).val();
                var purchaseOrderId = $(this).attr('id').split('_')[1];
                $.ajax({
                    url: '{{ route('purchase-orders.update', ['purchase_order' => '__purchase_order_id__']) }}'
                        .replace('__purchase_order_id__', purchaseOrderId),
                    type: 'PUT',
                    data: {
                        status: selectedStatus,
                        purchase_order_id: purchaseOrderId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('@lang('messages.updated_successfully')');
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection

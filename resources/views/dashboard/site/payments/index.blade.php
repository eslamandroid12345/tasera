@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.payments'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.payments')</h1>
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
                            <h3 class="card-title">@lang('dashboard.payments')</h3>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.company')</th>
                                    <th>@lang('dashboard.method')</th>
                                    <th>@lang('dashboard.amount')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->company?->t('name') }}</td>
                                        <td>{{ $payment->methodValue }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>
                                            @if($payment->method=='bank_transfer')
                                                <select class="custom-select" id="statusSelect_{{ $payment->id }}">
                                                    <option value="being_reviewed" {{$payment->status=='being_reviewed'?'selected':''}}>@lang('dashboard.being_reviewed')</option>
                                                    <option value="confirmed" {{$payment->status=='confirmed'?'selected':''}}>@lang('dashboard.confirmed')</option>
                                                </select>
                                            @else
                                                {{ $payment->statusValue }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @if($payment->method=='bank_transfer')
                                                    @permission('payments-read')
                                                    <a href="{{ route('payments.show', $payment->id) }}"
                                                       class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                    @endpermission
                                                @endif
                                                {{-- <a target="_blank" href="{{ route('payments.loginFromAdmin', $payment->id) }}" class="btn  btn-success">@lang('dashboard.Login')</a> --}}

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
                            {{ $payments->appends(request()->all())->links() }}
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
                var paymentId = $(this).attr('id').split('_')[1];
                $.ajax({
                    url: '{{ route('payments.update', ['payment' => '__payment_id__']) }}'
                        .replace('__payment_id__', paymentId),
                    type: 'PUT',
                    data: {
                        status: selectedStatus,
                        payment_id: paymentId,
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

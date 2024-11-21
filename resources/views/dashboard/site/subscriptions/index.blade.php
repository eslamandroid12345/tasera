@extends('dashboard.core.app')
@php
    use \Illuminate\Support\Facades\Gate;
@endphp
@section('title', __('dashboard.subscriptions'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.subscriptions')</h1>
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
                            <h3 class="card-title">@lang('dashboard.subscriptions')</h3>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.company')</th>
                                    <th>@lang('dashboard.package')</th>
                                    <th>@lang('dashboard.payment')</th>
                                    <th>@lang('dashboard.ends_at')</th>
                                    <th>@lang('dashboard.Active')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($subscription->company)
                                                <a target="_blank" href="{{route('companies.show',$subscription->company?->id)}}">{{ $subscription->company?->t('name') }}</a>
                                            @else

                                            @endif
                                        </td>
                                        <td>
                                            @if($subscription->package)
                                                <a target="_blank" href="{{route('packages.show',$subscription->package?->id)}}">{{ $subscription->package?->t('name') }}</a>
                                        </td>
                                        @else

                                        @endif
                                        <td>
                                            @if($subscription->payment)
                                                <a target="_blank" href="{{route('payments.show',$subscription->payment?->id)}}">@lang('dashboard.details')</a>
                                        </td>
                                        @else

                                        @endif
                                        <td> {{$subscription->ends_at}} </td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" {{$subscription->is_active=='1'?'checked':''}} class="custom-control-input status-toggle" id="customSwitch{{ $subscription->id }}" data-item-id="{{ $subscription->id }}">
                                                <label class="custom-control-label" for="customSwitch{{ $subscription->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                    @permission('subscriptions-update')
                                                    <a href="{{ route('subscriptions.edit', $subscription->id) }}"
                                                       class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                    @endpermission
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
                            {{ $subscriptions->appends(request()->all())->links() }}
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
                    url: "{{ route('toggleSubscription') }}", // Replace with your actual route
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

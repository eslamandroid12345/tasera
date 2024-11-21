@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.inquiry'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.inquiry')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 w-100">
                        <div class="card-header">
                            <div class=" align-items-center">
                                <img src="{{ asset($inquiry->company->logo) }}"
                                     alt="{{ $inquiry->company->t('name') }}"
                                     class="rounded-circle mr-2"
                                     style="width: 40px; height: 40px;">
                                <span>{{ $inquiry->company->t('name') }}</span>

                                <div class="card-tools">


                                    @if(!$inquiry->is_published)
                                        <div class="btn btn-sm btn-success ml-auto">
                                            <button class="btn btn-success waves-effect waves-light"
                                                    data-toggle="modal"
                                                    data-target="#approve-inquire-modal">@lang('dashboard.approve')</button>
                                        </div>
                                        <div id="approve-inquire-modal"
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
                                                            action="{{ route('inquiries.approve', $inquiry->id) }}"
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
                                                data-target="#delete-inquire-modal">@lang('dashboard.delete')</button>
                                    </div>
                                    <div id="delete-inquire-modal"
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
                                                        action="{{ route('inquiries.destroy', $inquiry->id) }}"
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
                            <p class="card-text ">{{ $inquiry->content }}</p>
                            @if($inquiry->reply)
                                <div class="card bg-light mt-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="btn btn-sm btn-danger ml-auto">
                                                <button
                                                    class="btn btn-danger waves-effect waves-light"
                                                    data-toggle="modal"
                                                    data-target="#delete-reply-modal">@lang('dashboard.delete')</button>
                                            </div>
                                            <div
                                                id="delete-reply-modal"
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
                                                                action="{{ route('inquiries.destroy', $inquiry->reply->id) }}"
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
                                            <strong>Reply:</strong> {{ $inquiry->reply->content }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
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

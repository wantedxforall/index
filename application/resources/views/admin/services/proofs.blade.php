@extends('admin.layouts.app')
@section('panel')
<div class="d-flex flex-wrap justify-content-end mb-3">
    <div class="d-inline">
        <div class="input-group justify-content-end">
            <input type="text" name="search_table" class="form-control bg--white" placeholder="@lang('Search')...">
            <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('Screenshot')</th>
                                <th>@lang('Service')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Submitted At')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proofs as $proof)
                            <tr>
                                <td>
                                     <a href="{{ asset('assets/images/proofs/'.$proof->screenshort) }}" target="_blank">
                                        <img src="{{ asset('assets/images/proofs/'.$proof->screenshort) }}" alt="@lang('proof')" style="width: 50px">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.service.edit', @$proof->service->id) }}">{{ __(@$proof->service->name) }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.detail', $proof->user->id) }}">{{ @$proof->user->username }}</a>
                                </td>
                                <td>{{ showDateTime($proof->created_at) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('No data found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($proofs->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($proofs) }}
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>
@endsection
@extends('layouts.app')

@section('page-title', __('Users'))
@section('page-heading', __('Users'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Users')
</li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">
        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="v-col-sm-4 v-col-12">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control input-solid" name="search" value="{{ Request::get('search') }}" placeholder="@lang('Search for users...')">

                        <span class="input-group-append">
                            @if (Request::has('search') && Request::get('search') != '')
                            <a href="{{ route('users.index') }}" class="btn btn-light d-flex align-items-center text-muted" role="button">
                                <i class="fas fa-times"></i>
                            </a>
                            @endif
                            <button class="btn btn-light" type="submit" id="search-users-btn">
                                <i class="fas fa-search text-muted"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="v-col-sm-4 v-col-12">
                    {!!
                    Form::select(
                    'status',
                    $statuses,
                    Request::get('status'),
                    ['id' => 'status', 'class' => 'form-control input-solid']
                    )
                    !!}
                </div>
                <div class="v-col-sm-4 v-col-12">
                    <a href="{{ route('users.create') }}" class="float-right">
                        <button type="button" class="v-btn v-btn--elevated v-theme--light bg-primary v-btn--density-default v-btn--size-default v-btn--variant-elevated">
                            <span class="v-btn__overlay"></span>
                            <span class="v-btn__underlay"></span>
                            <span class="v-btn__prepend">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m-7-7h14"></path>
                                </svg>
                            </span>
                            <span class="v-btn__content" data-no-activator="">Add User</span>
                        </button>
                    </a>
                </div>
            </div>
        </form>

        <hr class="v-divider v-theme--light" aria-orientation="horizontal" role="separator">

        <div class="v-table v-table--has-bottom v-theme--light v-table--density-default v-data-table text-no-wrap">
            <div class="v-table__wrapper" id="users-table-wrapper">
                <table class="table-borderlessble  table-striped">
                    <thead class="v-data-table__thead" role="rowgroup">
                        <tr>
                            <th></th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable v-data-table__th v-data-table__th--sortable">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Username')</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m6-8l-6-6m-6 6l6-6">
                                        </path>
                                    </svg>
                                </div>
                            </th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable v-data-table__th v-data-table__th--sortable">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Full Name')</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m6-8l-6-6m-6 6l6-6">
                                        </path>
                                    </svg>
                                </div>
                            </th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable v-data-table__th v-data-table__th--sortable">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Email')</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m6-8l-6-6m-6 6l6-6">
                                        </path>
                                    </svg>
                                </div>
                            </th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable v-data-table__th v-data-table__th--sortable">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Registration Date')</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m6-8l-6-6m-6 6l6-6">
                                        </path>
                                    </svg>
                                </div>
                            </th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th--sortable v-data-table__th v-data-table__th--sortable">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Status')</span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default v-data-table-header__sort-icon iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v14m6-8l-6-6m-6 6l6-6">
                                        </path>
                                    </svg>
                                </div>
                            </th>
                            <th class="v-data-table__td v-data-table-column--align-start v-data-table__th v-data-table__th">
                                <div class="v-data-table-header__content">
                                    <span>@lang('Action')</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="v-data-table__tbody" role="rowgroup">
                        @if (count($users))
                        @foreach ($users as $user)
                        @include('user.partials.row')
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7"><em>@lang('No records found.')</em></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{!! $users->render() !!}

@stop

@section('scripts')
<script>
    $("#status").change(function() {
        $("#users-form").submit();
    });
</script>
@stop

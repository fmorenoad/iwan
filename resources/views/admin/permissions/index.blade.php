@extends('layouts/app', [
    'activePage' => $info_page['activePage'], 
    'activeButton' => $info_page['activeButton'], 
    'title' => $info_page['title'], 
    'navName' => $info_page['navName']
    ])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card data-tables">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Permissions') }}</h3>
                                    <p class="text-sm mb-0">
                                        {{ __('This is an example of permissions management. This is a minimal setup in order to get started fast.') }}
                                    </p>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-outline btn-wd">{{ __('New Permission')}}</a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12 mt-2">
                            @include('layouts.partials.alerts.success')
                            @include('layouts.partials.alerts.errors')
                        </div> --}}

                        <div class="table-responsive py-4" id="roles-table">
                            <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->guardname }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-link btn-warning edit d-inline-block"><i class="fa fa-edit"></i></a>
                                                <form class="d-inline-block" action="{{ route('admin.permissions.destroy', $permission) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <a class="btn btn-link btn-danger " onclick="confirm('{{ __('Are you sure you want to delete this permission?') }}') ? this.parentElement.submit() : ''"s><i class="fa fa-times"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
    </script>
@endpush


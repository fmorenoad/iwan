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
                                    <h3 class="card-title">{{ __('Roles') }}</h3>
                                    <p class="card-category">
                                        {{ __('This is an example of Roles management. This is a minimal setup in order to get started fast.') }}
                                    </p>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-outline btn-wd">{{ __('Back')}}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            @include('layouts.partials.alerts.success')
                            @include('layouts.partials.alerts.errors')
                        </div>

                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="card-body ">
                                    <form action="{{route('admin.roles.update', $role)}}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Role')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $role->name) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Permissions')}}</label>
                                                <div class="col-md-8">
                                                    @foreach($permissions as $permission)
                                                        <div class="checkbox">
                                                            <label>
                                                            <input type="checkbox" 
                                                                    name="{{ $permission->name }}"
                                                                    @foreach($role_has_permissions as $role_has_permission)
                                                                        @if($role_has_permission->permission_id == $permission->id)
                                                                        checked
                                                                        @endif
                                                                    @endforeach
                                                                    >
                                                            {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            
                                        </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-info btn-wd btn-next pull-right">{{__('Submit')}}</button>
                                    <div class="clearfix"></div>
                                </div>
                                    </form>
                            </div>    
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


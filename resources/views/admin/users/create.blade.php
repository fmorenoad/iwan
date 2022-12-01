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
                                    <h3 class="card-title">{{ __('Users') }}</h3>
                                    <p class="card-category">
                                        {{ __('This is an example of users management. This is a minimal setup in order to get started fast.') }}
                                    </p>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-default btn-outline btn-wd">{{ __('Back')}}</a>
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
                                    <form action="{{route('admin.users.store')}}" method="post" class="form-horizontal">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Name')}}</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" id="name" placeholder="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Email')}}</label>
                                                <div class="col-md-8">
                                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Password')}}</label>
                                                <div class="col-md-8">
                                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 control-label">{{__('Password Confirm')}}</label>
                                                <div class="col-md-8">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="role" class="col-md-4 control-label">Rol en el Sistema</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="role" id="role">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->name}}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
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


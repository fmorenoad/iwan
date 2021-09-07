@extends('layouts.app', ['activePage' => $activePage, 'activeButton' => $activeButton, 'title' => $title, 'navName' => $navName])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">{{ __($title) }}</h3>
                                <a href="{{route('users.index')}}" class="btn btn-secondary btn-fill pull-right"><i class="w3-xxlarge fa fa-arrow-left"></i>{{ __('Return') }}</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('users.store')}}" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" id="name" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="lastname">{{__('Lastname')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="enterprise_id">{{__('Enterprise')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="enterprise_id" id="enterprise_id" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="email">{{__('Email')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" id="email" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    La contraseña se debe generar sola y llegar por email
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="roles">{{__('Role')}}</label>
                                                <div class="col-sm-10">
                                                    @foreach ($roles as $role)
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="roles[]" type="checkbox" value="{{$role->id}}">
                                                            <span class="form-check-sign"></span>
                                                            {{$role->name}}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-info btn-fill pull-right" type="submit">{{ __('Save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

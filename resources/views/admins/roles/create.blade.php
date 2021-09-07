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
                                <a href="{{route('roles.index')}}" class="btn btn-secondary btn-fill pull-right"><i class="w3-xxlarge fa fa-arrow-left"></i>{{ __('Return') }}</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('roles.store')}}" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="name">{{__('Role Name')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" id="name" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="guard_name">{{__('Guard Name')}}</label>
                                                <div class="col-sm-10">
                                                    <select name="guard_name" id="guard_name" class="form-control">
                                                        <option value="web">web</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="name">{{__('Action')}}</label>
                                                <div class="col-sm-10">
                                                    <ul class="list-unstyled">
                                                        @foreach ($permissions as $permission)
                                                        <div class="">
                                                            <li>
                                                            <input type="checkbox" name="permissions[]" value={{$permission->name}}>
                                                            {{$permission->name}}
                                                            </li>
                                                        </div>
                                                        @endforeach
                                                        </ul>
                                                    </select>
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

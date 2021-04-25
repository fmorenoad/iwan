@extends('layouts.app', ['activePage' => 'register', 'title' => 'Light Bootstrap Dashboard PRO Laravel by Creative Tim & UPDIVISION'])

@section('content')
    <div class="full-page register-page section-image" data-color="blue" data-image="{{ asset('img/bg5.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="card card-register card-plain text-center">
                    <div class="card-header ">
                        <div class="row  justify-content-center">
                            <div class="col-md-8">
                                <div class="header-text">
                                    <h2 class="card-title">{{ __('Welcome to ') .  env('APP_NAME')}}</h2>
                                    <h4 class="card-subtitle">{{ __('Registrate para comenzar una nueva experiencia de la Operación') }}</h4>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="icon">
                                            <i class="nc-icon nc-circle-09"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ __('User Account') }}</h4>
                                        <p>{{ __('Una vez creado el usuario, el administrador de la plataforma autorizará y te asignará un rol en el sistema.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mr-auto">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="card card-plain">
                                        <div class="content">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="{{ __('Lastname') }}" value="{{ old('lastname') }}" required autofocus>
                                            </div>

                                            <div class="form-group" >
                                                <div class="input-group input-group-alternative">
                                                    <select class="form-control" id="enterprise_id" name="enterprise_id" required autofocus >
                                                        <option value="" selected hidden >{{ __('Enterprise') }}</option>
                                                        <option value="1" @if (old('enterprise_id') == 1) selected @endif>{{ __('Admin') }}</option>
                                                        <option value="2" @if (old('enterprise_id') == 2) selected @endif>{{ __('Creator') }}</option>
                                                        <option value="3" @if (old('enterprise_id') == 3) selected @endif>{{ __('Member') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">   {{-- is-invalid make border red --}}
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="Password" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control" required autofocus>
                                            </div>
                                            <div class="form-group d-flex justify-content-center">

                                                <div class="form-check rounded col-md-10 text-left">

                                                    <label class="form-check-label text-white">
                                                        <input style="visibility:visible; opacity:1" class="form-check-input" name="agree" type="checkbox" required >
                                                        {{-- <span class="form-check-sign"></span> --}}
                                                        <b>{{ __('Agree with terms and conditions') }}</b>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="footer text-center">
                                                <button type="submit" class="btn btn-fill btn-neutral btn-wd">{{ __('Create Account') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible fade show" >
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush

@extends('layouts/app', ['activePage' => 'login', 'title' => 'iWan Solution'])

@section('content')
    <div class="full-page section-image" data-color="orange" data-image="{{ asset('img/full-screen-image-2.jpg') }}">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content pt-5">
            <div class="container ">
                <div class="col-md-8 col-sm-9 ml-auto mr-auto mb-7">
                    <div class="text-center">
                        <h3 class="text-white">{{ __('Welcome to iWan Solutions.') }}</h1>
                        <p class="text-lead text-light mt-3 mb-0"> {{ __('Platform to manage information and more.') }}</p>
                    </div>
                </div>
            </div>
            <div class="container mt-5">    
                <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header ">
                                <h3 class="header text-center">{{ __('Login') }}</h3>
                            </div>
                            <div class="card-body ">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>
            
                                        <div class="col-md-14">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'admin@lightbp.com') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>
                
                                            <div class="col-md-14">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="secret" required autocomplete="current-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="remember"  id="remember">
                                                <span class="form-check-sign"></span>
                                                {{ __('Remember me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="container text-center" id="login">
                                        <button type="submit" class="btn btn-warning btn-wd">{{ __('Login') }}</button>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-link" style="color:#23CCEF" href="{{ route('password.request') }}">{{ __('Forgot password?') }}
                                        </a>
                                        <a class="btn btn-link" style="color:#23CCEF" href="{{ route('register') }}">
                                            {{ __('Create account') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            /* demo.checkFullPageBackgroundImage(); */

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush
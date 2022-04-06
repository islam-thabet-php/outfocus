@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><!-- login page start -->
        <section id="auth-login" class="row flexbox-container">
            <div class="col-xl-8 col-11">
                <div class="card bg-authentication mb-0">
                    <div class="row m-0">
                        <!-- left section-login -->
                        <div class="col-md-6 col-12 px-0">
                            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h4 class="text-center mb-2">OUTFOCUS</h4>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="divider">
                                        <div class="divider-text text-uppercase text-muted"><small>{{ __('System Login') }}</small>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="exampleInputEmail1">{{__('Email')}}</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                                   placeholder="{{__('Enter Email')}}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold-600" for="exampleInputPassword1">{{__('Password')}}</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1"
                                                   placeholder="{{__('Enter Password')}}">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                        </div>
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative">
                                            {{__('Login')}}<i
                                                id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- right section image -->
                        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                            <img class="img-fluid" src="{{ asset('xlstart-assets') }}/app-assets/images/pages/lock-screen.png" alt="branding logo">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- login page ends -->

    </div>
</div>


@endsection

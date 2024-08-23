@extends('Master.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-form.input name="name" type="text" id="name" label="Username" />
                        </div>

                        <div class="mb-3">
                            <x-form.input name="email" type="email" id="email" label="Email" />
                        </div>

                        <div class="mb-3">
                            <x-form.input name="password" type="password" id="password" label="Password" />
                        </div>

                        <div class="mb-3">
                            <x-form.input name="password_confirmation" type="password" id="confirm-password"
                                label="Confirm Password" />
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                    <a href="{{route('login.index')}}">Go to Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection

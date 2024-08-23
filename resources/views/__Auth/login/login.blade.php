@extends('Master.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-form.input name="email" type="email" id="email" label="Email" />
                        </div>

                        <div class="mb-3">
                            <x-form.input name="password" type="password" id="password" label="Password" />
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    <a href="">Go to Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection

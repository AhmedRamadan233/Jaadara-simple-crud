@extends('Master.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-form.input name="email" type="email" id="email" label="Email" />
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <x-form.input name="password" type="password" id="password" label="Password" />
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('register.index') }}">Go to Register</a>

                        </div>
                        <div>
                            <a href="{{ route('verify.index') }}">Go to Verify</a>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

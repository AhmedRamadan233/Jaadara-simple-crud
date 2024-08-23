@extends('Master.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Verification</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('verify') }}" method="POST">
                        @csrf


                        <div class="mb-3">
                            <x-form.input name="email" type="email" id="email" label="Email"
                                value="{{ session('email', '') }}" placeholder="Enter your email" />



                            <x-form.input name="verification_code" type="text" id="verification_code"
                                label="Verification Code" value="{{ old('verification_code') }}" />

                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

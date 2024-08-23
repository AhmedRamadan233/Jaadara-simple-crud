@extends('Master.master')

@section('content')
    <div class="col-12 col-lg-12 pt-4 pt-lg-0">
        <div class="tab-content p-2">

            <!-- Basic Bootstrap Table -->
            <div class="card p-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>romiooooooooooooooooo</h5>
                        </div>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Launch demo modal
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-white table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">USER NAME</th>
                                <th scope="col">TITLE</th>
                                <th scope="col">BODY</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user_id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td><img src="{{ url($post->image) }}" alt="Post Image" style="width: 150px; height: auto;"></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @include('website.posts.includes.create')
            @include('website.posts.includes.edit')
        </div>
    </div>
    </div>
@endsection

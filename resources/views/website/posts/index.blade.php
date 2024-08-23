@extends('Master.master')

@section('content')
    <div class="col-12 col-lg-12 pt-4 pt-lg-0">
        <div class="tab-content p-2">

            <!-- Basic Bootstrap Table -->
            <div class="card p-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>POSTS</h5>
                        </div>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createPostModal">
                                Create new post
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="postsTable">
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
                                    <td>{{ $post->user_id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td><img src="{{ url($post->image) }}" alt="Post Image"
                                            style="width: 150px; height: auto;">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editPostModal" href="javascript:;"
                                            onclick="editPost({{ $post->id }})">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-icon btn-danger"
                                            onclick="confirmDelete('{{ $post->id }}')">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
            @include('website.posts.includes.create')
            @include('website.posts.includes.edit')
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        // added Post
        $(document).ready(function() {
            $('#create-post-Form').on('submit', function(e) {
                e.preventDefault();
                var storePostUrl = "{{ route('posts.store') }}";
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: storePostUrl,
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#postsTable').load(location.href + ' #postsTable>*', '');
                            $('#create-post-Form').load(location.href + ' #create-post-Form>*',
                                '');
                            $('#create-post-Form')[0].reset();
                            $('#createPostModal').modal('hide');
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (var key in errors) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + errors[key][0] +
                                '</div>');
                        }
                    }
                });
            });
        });


        function editPost(postId) {
            $.ajax({
                url: '/website/postsx/edit/' + postId,
                type: 'GET',
                success: function(response) {
                    console.log(response.editPost.id)

                    $('.id').val(response.editPost.id);
                    $('.title').val(response.editPost.title);
                    $('.body').val(response.editPost.body);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function() {
            $('#edit-post-form').on('submit', function(e) {
                e.preventDefault();
                var updatePostUrl = "{{ route('posts.update') }}";
                console.log(updatePostUrl);
                var formData = new FormData(this);

                $.ajax({
                    url: updatePostUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.success);
                        if (response.success) {
                            $('#postsTable').load(location.href + ' #postsTable>*', '');
                            $('#edit-post-form')[0].reset();
                            $('#editPostModal').modal('hide');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON.errors);
                        var errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        for (var key in errors) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + errors[key][0] +
                                '</div>');
                        }
                    }
                });
            });
        });


        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                deletePost(postId);
            }
        }

        function deletePost(postId) {
            var deleteUrl = `/website/postsx/delete/${postId}`;

            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.message);
                    $('#post-row-' + postId).remove();
                    $('#postsTable').load(location.href + ' #postsTable>*', '');
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        alert('You are not authorized to delete this post.');
                    } else {
                        alert('An error occurred while trying to delete the post.');
                    }
                }
            });
        }
    </script>
@endpush

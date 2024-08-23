<!-- Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h1 class="modal-title fs-5 text-primary" id="createPostModalLabel">Create Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <!-- Form starts here -->
                <form id="create-post-Form" method="POST" action="{{ route('posts.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- Start title --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input name="title" type="text" id="title" label="Title" />
                        </div>
                    </div>
                    {{-- End title --}}

                    {{-- Start body --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input name="body" type="text" id="body" label="Body" />
                        </div>
                    </div>
                    {{-- End body --}}

                    {{-- Start image --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input name="image" type="file" id="image" label="Image" />
                        </div>
                    </div>
                    {{-- End image --}}

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                <!-- Form ends here -->
            </div>
        </div>
    </div>
</div>

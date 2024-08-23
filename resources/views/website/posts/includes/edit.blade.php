<!-- Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                <h1 class="modal-title fs-5 text-primary" id="editPostModalLabel">Edit Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <!-- Form starts here -->
                <form id="edit-post-form" method="POST" action="{{ route('posts.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input class="id" type="hidden" name="id" id="id" class="form-control">

                    {{-- Start title --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input class="title" name="title" type="text" id="title" label="Title" />
                        </div>
                    </div>
                    {{-- End title --}}

                    {{-- Start body --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input class="body" name="body" type="text" id="body" label="Body" />
                        </div>
                    </div>
                    {{-- End body --}}

                    {{-- Start image --}}
                    <div class="row">
                        <div class="col mb-3">
                            <x-form.input name="image" type="file" id="image" label="Image" />
                            <!-- Display existing image if available -->
                            @if (isset($post) && $post->image)
                                <div class="mt-2">
                                    <img src="{{ url($post->image) }}" alt="Current Image"
                                        style="max-width: 20%; height: auto;">
                                </div>
                            @else
                                <div class="mt-2">
                                    No image available.
                                </div>
                            @endif
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

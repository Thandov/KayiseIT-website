<x-app-layout>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <!-- First Table -->
            <div class="col-md-6">
                <div class="card">
                    <form name="businessdash" id="businessdash" action="{{ url('storeblog-form') }}" method="post"
                        enctype="multipart/form-data" class="px-3 py-3">
                        @csrf

                        <!-- First Form -->
                        <div class="m-3 row">
                            <label for="logo" class="col-sm-3 form-label fw-bold text-md-end">Icon:</label>
                            <div class="col-sm-9">
                                <input name="icon" class="form-control" type="file" id="logo">
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="title" class="col-sm-3 form-label fw-bold text-md-end">Title:</label>
                            <div class="col-sm-9">
                                <input type="title" name="title" id="title" class="form-control" />
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="subtitle" class="col-sm-3 form-label fw-bold text-md-end">Sub Title:</label>
                            <div class="col-sm-9">
                                <input type="title" name="subtitle" id="subtitle" class="form-control" />
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="content" id="task-textarea" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end">
                                    <button style="background-color: green" class="btn btn-success m-3" type="submit">Post</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Second Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="m-3 row">
                        <label for="subtitle2" class="col-sm-3 form-label fw-bold text-md-end">Category:</label>
                        <div class="col-sm-9">
                            <select name="subtitle2" id="subtitle2" class="form-control">
                                <option value="">Select a category</option>
                                @foreach($postCategories as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    ClassicEditor
        .create(document.querySelector('#task-textarea'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#task-textarea2'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

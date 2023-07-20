<x-app-layout>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-full">
                <div class="card">

                    <form name="businessdash" id="businessdash" action="{{url('storeblog-form')}}" method="post" enctype="multipart/form-data" class="px-3 py-3">
                        @csrf
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
                            <label for="category" class="col-sm-3 form-label fw-bold text-md-end">Category:</label>
                            <div class="col-sm-9">
                                <input type="title" name="category" id="category" class="form-control" />
                            </div>
                        </div>

                        <div class="m-3 row">
                            <label for="content" class="col-sm-3 form-label fw-bold text-md-end">Post:</label>
                            <div class="col-sm-9">
                                <div id="toolbarOptions">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-indent" value="-1"></button>
                                        <button class="ql-indent" value="+1"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-direction" value="rtl"></button>
                                        <select class="ql-align"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        <button class="ql-video"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-clean"></button>
                                    </span>
                                </div>

                                <div id="content" class="form-control"></div>
                            </div>
                        </div>
                        <!-- Add this hidden input field -->
                        <input type="hidden" name="content" id="hiddenContent" />



                        <div class="row">
                            <div class="col">
                                <div class="d-flex align-items-center py-5 justify-content-end">
                                    <button style="background-color: green" class="btn btn-success m-5" type="submit">Post</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    $(document).ready(function() {

        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],

            [{
                'header': 1
            }, {
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['link', 'image', 'video'], // add's image support
            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];

        var quill = new Quill('#content', {
            modules: {
                syntax: true,
                toolbar: '#toolbarOptions'
            },
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            $('#hiddenContent').val(quill.root.innerHTML);
            console.log(delta, oldDelta, source);
        });
        
       


    });
</script>
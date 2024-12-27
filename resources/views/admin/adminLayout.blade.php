<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-brown left_sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start text-white min-vh-100">
                    <a href="{{ route('home') }}"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="custom_logo d-sm-inline"><img style="max-width: 100%"
                                src="{{ asset('img/logo-admin.png') }}"></span>
                    </a>
                    <ul class="nav nav-pills flex-column w-100 mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item hav_child w-100">
                            <span class="nav-link align-middle px-0">
                                <i class="fa-solid fa-thumbtack"></i> <span class="ms-1 d-none d-sm-inline">Pages</span>
                            </span>
                            <ul class="remove_bullets ">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/home') }}" class="@if (Route::is('home.index') || Route::is('home.edit') || Route::is('home.create')) active_nav @endif  nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Home</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('posts.index') }}" class="@if (Route::is('posts.index') || Route::is('posts.edit') || Route::is('posts.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Blogs</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('career.edit') }}" class="@if (Route::is('career.edit') || Route::is('career.update') || Route::is('posts.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Career Page</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('reports.create') }}" class="@if (Route::is('reports.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Report Page</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('about.index') }}" class="@if (Route::is('about.index') || Route::is('about.edit') || Route::is('about.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">About</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('privacy.list') }}" class="@if (Route::is('privacy.list') || Route::is('edit.policy')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Privacy Policy</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sections.index') }}" class="@if (Route::is('sections.edit') || Route::is('sections.create') || Route::is('sections.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">List With Us</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('property_management.create') }}" class="@if (Route::is('property_management.create') || Route::is('property_management.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Manage Property</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page_branded_residence.index') }}" class="@if (Route::is('page_branded_residence.create') || Route::is('page_branded_residence.edit') || Route::is('page_branded_residence.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Branded Residence</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item hav_child w-100">
                            <a href="javascript:void(0);" class="nav-link align-middle px-0">
                                <i class="fa-regular fa-building"></i> <span
                                    class="ms-1 d-none d-sm-inline">Properties</span>
                            </a>
                            <ul class="remove_bullets ">
                                <li class="nav-item">
                                    <a href="{{ route('buy_properties.index') }}"
                                        class="@if (request()->is('buy_properties*') || Route::is('buy_properties.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Buy</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('rent_properties.index') }}"
                                        class="@if (request()->is('rent_properties*') || Route::is('rent_properties.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Rent</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('private_properties.index') }}"
                                        class="@if (request()->is('private-properties*') || Route::is('private_properties.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Private</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('investment_properties.index') }}"
                                        class="@if (request()->is('investment_properties*') || Route::is('investment_properties.index') || Route::is('investment_properties.edit') || Route::is('investment_properties.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Investment</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('international_properties.index') }}"
                                        class="@if (request()->is('international_properties*') || Route::is('international_properties.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">International</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('project_properties.index') }}"
                                        class="@if (request()->is('project_properties*') || Route::is('project_properties.index')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Development/Project</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('branded_properties.index') }}"
                                        class="@if (request()->is('branded_properties*') || Route::is('branded_properties.index') || Route::is('branded_properties.edit') || Route::is('branded_properties.create')) active_nav @endif nav-link align-middle px-0">
                                        <span class="ms-1 d-none d-sm-inline">Branded Residences</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('faq.index') }}"
                                class="@if (request()->is('faq*') || Route::is('faq.index')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-solid fa-circle-question"></i> <span
                                    class="ms-1 d-none d-sm-inline">Faq</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.show') }}"
                                class="@if (request()->is('contact*') || Route::is('contact.show')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-solid fa-id-card"></i> <span class="ms-1 d-none d-sm-inline">Contact
                                    us</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form_data.index') }}"
                                class="@if (request()->is('form_data*') || Route::is('form_data.index')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-solid fa-id-card"></i> <span class="ms-1 d-none d-sm-inline">Form Data</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agents.index') }}"
                                class="@if (request()->is('agents*') || Route::is('agents.index')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-brands fa-teamspeak"></i> <span
                                    class="ms-1 d-none d-sm-inline">Agents</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('communities.index') }}"
                                class="@if (request()->is('communities*') || Route::is('communities.index') || Route::is('communities.create') || Route::is('communities.edit')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-solid fa-group-arrows-rotate"></i> <span
                                    class="ms-1 d-none d-sm-inline">Community</span>
                            </a>
                        </li>

                        

                        <li class="nav-item">
                            <a href="{{ route('testimonials.index') }}"
                                class="@if (request()->is('testimonials*') || Route::is('testimonials.index') || Route::is('testimonials.edit') || Route::is('testimonials.create')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-regular fa-comment-dots"></i> <span
                                    class="ms-1 d-none d-sm-inline">Testimonials</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gallery.index') }}"
                                class="@if (request()->is('gallery*') || Route::is('gallery.index') || Route::is('gallery.edit') || Route::is('gallery.create')) active_nav @endif nav-link align-middle px-0">
                                <i class="fa-solid fa-photo-film"></i> <span
                                    class="ms-1 d-none d-sm-inline">Media Mention</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listing.index') }}"
                                class="@if (request()->is('listing*') || Route::is('listing.index') || Route::is('listing.edit') || Route::is('gallery.create')) active_nav @endif nav-link align-middle px-0">
                                <!-- <i class="fa-solid fa-photo-film"></i>  -->
                                <i class="fa-solid fa-thumbtack"></i>
                                <span
                                    class="ms-1 d-none d-sm-inline">Listing</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="@if (request()->is('users*') || Route::is('admin.users.index')) active_nav @endif nav-link align-middle px-0">
                                <!-- <i class="fa-solid fa-photo-film"></i>  -->
                                <i class="fa-solid fa-thumbtack"></i>
                                <span
                                    class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('report_inidividual.index') }}"
                                class="@if (request()->is('report_inidividual*') || Route::is('admin.report_inidividual') || Route::is('admin.report_inidividual.edit') || Route::is('admin.report_inidividual.create')) active_nav @endif nav-link align-middle px-0">
                                <!-- <i class="fa-solid fa-photo-film"></i>  -->
                                <i class="fa-solid fa-thumbtack"></i>
                                <span class="ms-1 d-none d-sm-inline">Reports</span>
                            </a>
                        </li>

                        <li  class="nav-item">
                            <a href="{{ route('regions.index') }}" class="@if (Route::is('regions.edit') || Route::is('regions.create') || Route::is('careers.index')) active_nav @endif nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-thumbtack"></i> Region</span>
                            </a>
                        </li>

                        <li  class="nav-item">
                            <a href="{{ route('careers.index') }}" class="@if (Route::is('careers.edit') || Route::is('careers.create') || Route::is('careers.index')) active_nav @endif nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-thumbtack"></i> Career</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown admin-user">
                        @if (Auth::check())
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('img/user.svg') }}" alt="hugenerd" width="30" height="30"
                                    class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1 self_captilize">{{ Auth::user()->name }}</span>
                            </a>
                        @endif
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <!-- <li><a class="dropdown-item" href="{{ route('settings') }}">Settings</a></li> -->
                            <li><a class="dropdown-item" href="{{ route('settings') }}"><i
                                        class="fa-solid fa-gear"></i> Settings</a></li>
                            <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                    out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col offset-md-3 offset-xl-2 py-3" id="header_right_block">
                <div class="p-3 admin_block_wrraper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tiny.cloud/1/0bhoqku69v9e5xlhdurqb41r41h8ibv8xq2d47hpb5zpr9y5/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Heading,
        Underline,
        Strikethrough,
        Table,
        TableToolbar,
        SourceEditing,
        MediaEmbed,
        GeneralHtmlSupport,
        Image,
        List,
        AutoLink,
        Link,
        ImageInsert
    } from 'ckeditor5';

    // Loop over each textarea element
    const textareas = document.querySelectorAll('textarea');

    textareas.forEach(textarea => {
    

        if (!textarea.classList.contains('normal-textbox') && textarea.classList.value != "normal_textbox") {
        ClassicEditor
            .create(textarea, {
                plugins: [
                    Essentials, Bold, List,Italic, Font, Paragraph, Heading, Underline, 
                    Strikethrough, Table, TableToolbar, SourceEditing, MediaEmbed,Link, AutoLink,GeneralHtmlSupport,ImageInsert,Image
                ],
                extraPlugins: [ SimpleUploadAdapterPlugin ],
                toolbar: [
                    'heading', 'bold', 'italic', 'underline', 'link','strikethrough', '|', 'undo', 'redo',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 
                    'bulletedList', 'numberedList', 'insertTable', 'tableColumn', 'tableRow', '|', 'SourceEditing', '|','insertImage'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .then(editor => {
                console.log('Editor initialized for textarea', textarea, editor);

                // Sync the content from CKEditor to the textarea on every change.
                editor.model.document.on('change:data', () => {
                    textarea.value = editor.getData();  // Update textarea with editor content
                });

                // You can also use the keyup event if you prefer instant updates on keypresses
                editor.editing.view.document.on('keyup', () => {
                    textarea.value = editor.getData();  // Update textarea on each keypress
                });

                // Handle form submission by ensuring the latest data is in the textarea
                const form = textarea.closest('form');  // Find the closest form element
                if (form) {
                    form.addEventListener('submit', (event) => {
                        // Make sure the textarea is updated with the editor data when submitting the form
                        textarea.value = editor.getData(); // Sync editor data to textarea before submitting
                    });
                }
            })
            .catch(error => {
                console.error('There was a problem initializing the editor for', textarea, error);
            });
        }
    });

    class MyUploadAdapter {
        constructor( loader ) {
            // The file loader instance to use during the upload. It sounds scary but do not
            // worry — the loader will be passed into the adapter later on in this guide.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{ route('ck.upload') }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve( {
                    default: response.url
                } );
            } );

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'upload', file );

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send( data );
        }

        // ...
    }

    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter( loader );
        };
    }

    function createEditor(selector) {
        console.log(selector);return "hello";
        return ClassicEditor.create(document.querySelector(selector), {
            plugins: [Essentials, Bold, Italic, Font, Paragraph, Heading, Underline, Strikethrough, Table, TableToolbar],
            toolbar: [
                'heading', 'bold', 'italic', 'underline', 'strikethrough', '|', 'undo', 'redo',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 
                'insertTable', 
                'tableColumn', 'tableRow', 'mergeTableCells'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            console.log(`Editor for ${selector} was initialized`, editor);
        })
        .catch(error => {
            console.error(`There was a problem initializing the editor for ${selector}.`, error);
        });
    }
    </script>
        <script src="{{ asset('js/admin.js') }}"></script>
@yield('scripts')
</body>

</html>

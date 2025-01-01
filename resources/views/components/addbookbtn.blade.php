<!-- Button trigger modal -->
<button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#addbookmodal">
    add new book
</button>

<!-- Modal -->
<div class="modal fade" id="addbookmodal" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addbook">add a new book</h1>
                <button type="button" class="btn-close x-close-create" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('books.create') }}" method="POST" autocomplete="off">
                    @csrf
                    <ul class='errors '>
                    </ul>
                    <div class="mb-3">
                        <label class='mb-2'>title</label>
                        <input type="text" class="title form-control" placeholder="book title">
                    </div>
                    <div class="mb-3">
                        <label class='mb-2'>author</label>
                        <input type="text" class="author form-control" placeholder="author">
                    </div>
                    <div class="mb-3">
                        <label class='mb-2'>upload book</label>
                        <input type="file" class="upload form-control">
                        <div class="preview-file mt-3 position-relative">
                            <button type="button" class="border-0 bg-transparent remove-file position-absolute top-0">
                                <i class="fas fa-xmark">
                                </i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-create" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn add-book btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>






<script>
    $(document).ready(function() {
        $('.upload').on('change', function(event) {
            const file = event.target.files[0];
            $('.preview-file').show();
            $('.remove-file').show();
            if (file) {
                const fileType = file.type;
                $('.preview-file').find('.pdf-wrapper').remove();
                $('.preview-file').append(
                    `
                    <div class='pdf-wrapper d-flex justify-content-center align-items-center gap-1'>
                    <div class=pdf-image>
                        <img src=../gallery/pdf-file-svgrepo-com.png alt=pdf image/>
                        </div>
                        ${file.name}
                    </div>
                    `
                );
            }

        });
        $(document).on('click', '.remove-file', function() {
            $('.upload').val('');
            $('.pdf-wrapper').remove();
            $(this).hide();
            $('.preview-file').hide();

        });
        fetchBooks();
        //fetch books
        async function fetchBooks() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/books');
                
                if (response && response.data && response.data.message.length > 0) {
       
                    $('.show-books-container').find('.found').show();
                    $('.show-books-container').find('.not-found').hide();
                    $('.show-books').empty();
                    $.each(response.data.message, function(index, element) {
                        let user =
                            `
                         <div class='mt-3 fetched-books col-12 col-md-3'>
                            
                            <div class='title'>${element.title}</div>
                            <div class='author'>${element.author}</div>
                            <a class='download-book' href="/storage/" download="${element.upload}">
                               download ${element.upload}    
                            </a>
                            <div class='mt-2 status d-flex gap-1 fw-bold'>status:
                                <h6 class='text text-primary-emphasis mb-0' style="line-height: 1.4">
                                 ${element.status}
                                </h6>
                            </div>
                            <div class="action mt-2 d-flex gap-2">
                                <a class='btn btn-success edit-book' data-id='${element.id}' title="update book" href="api/books/${element.id}/edit"><i
                                    class='fas fa-pen-to-square'></i>
                                </a>
                            <form >
                                <button class='btn btn-danger delete-book' data-id='${element.id}'  title="delete book">
                                    <i class='fas fa-trash-can'></i>
                                </button>
                            </form>
                        </div>
                        `
                       
                        $('.show-books-container .show-books').append(user);

                    });
                }
            } catch (error) {
                if (error && error.response && error.response.status == 404) {
                    $('.show-books').empty();
                    $('.show-books-container').find('.not-found').show();
                    $('.show-books-container').find('.found').hide();
                }

            };
        }
        // edit book
        function editBook() {
            $(document).on('click', '.edit-book', async function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#updatebookmodal').attr('book-id', id);
                $('#updatebookmodal').modal('show');

                try {
                    const response = await axios.get(`http://127.0.0.1:8000/api/books/${id}/edit`);
                    if (response && response.data) {
                        $('.title').val(response.data.message.title);
                        $('.author').val(response.data.message.author);
                        $('.current_book').val(response.data.message.upload);
                    }
                } catch (error) {
                    if (error && error.response) {
                        //
                    }
                }
            });
        }
        editBook();
        // clear form when closing it and reopening it again
        $(document).on('click', '.x-close-update , .close-update , .x-close-create , .close-create',
            function() {
                $('.modal-body .title_error').text('');
                $('.modal-body .author_error').text('');
                $('.upload_error').text('');
                $('.upload').val('');
                $('#addbookmodal .title , #addbookmodal .author').val('');
                $('.preview-file').hide().find('.pdf-wrapper').remove();
                $('.errors').removeClass('alert alert-danger').empty();

            });
        //update book 
        async function updateBook() {
            $(document).on('click', '.update-book', async function(e) {
                e.preventDefault();
                let id = $('#updatebookmodal').attr('book-id');
                let title = $('#updatebookmodal .modal-body .title').val();
                let author = $('#updatebookmodal .modal-body .author').val();
                let file = $('#updatebookmodal .modal-body .upload')[0].files[0];

                var formData = new FormData();
                formData.append('title', title);
                formData.append('author', author);
                formData.append('upload', file);

                try {
                    const response = await axios.post(`http://127.0.0.1:8000/api/books/${id}`,
                        formData, {
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                    "content"),
                                "Content-Type": "multipart/form-data"

                            },
                        })
                    if (response && response.data && response.status == 200) {
                        fetchBooks();
                        $('.show-books-container').find('.update-success').remove();
                        $('.show-books-container').prepend(
                            `<div class='text-center mt-3 update-success alert alert-success'>Book Updated Successfully</div>`
                        );
                        $('#updatebookmodal .modal-body').find('input').val('');
                        $('#updatebookmodal').modal('hide');
                        $('.preview-file').hide().find('.pdf-wrapper').remove();
                        setTimeout(() => {
                            $('.update-success').css({
                                'transition': 'all .4s ease-in-out'
                            });
                            $('.update-success').hide();
                        }, 3000);

                    }
                } catch (error) {
                    if (error && error.response) {
                        console.log(error);
                        $.each(error.responseJSON, function(index, element) {
                            // console.log(element);
                            $('.title_error').text(element.title);
                            $('.author_error').text(element.author);
                            $('.upload_error').text(element.upload);
                        });
                    }
                }
            });
        }
        updateBook();
        //delete book
        function deleteBook() {
            $(document).on('click', '.delete-book', async function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                try {
                    const response = await axios.delete(`http://127.0.0.1:8000/api/books/${id}`, {
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"),
                        },
                    });
                    if (response && response.status == 200) {
                        fetchBooks();
                    }
                } catch (error) {
                    if (error && error.response) {
                        console.log(error);
                    }
                }

            });
        }
        deleteBook();
        // create book
        newBook();

        function newBook() {
            $(document).on('click', '.modal-footer .add-book', async function(e) {
                e.preventDefault();
                // Create a FormData object
                var formData = new FormData();
                formData.append('title', $('.title').val());
                formData.append('author', $('.author').val());
                formData.append('upload', $('.upload')[0].files[0]);

                try {
                    const response = await axios.post('http://127.0.0.1:8000/api/books', formData, {
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            'Content-Type': 'multipart/form-data',
                        },
                    });
                    if (response && response.data && response.status == 200) {
                        fetchBooks();
                        $('#addbookmodal').modal('hide');
                        $('.preview-file').hide().find('.pdf-wrapper').remove();
                        $('#addbookmodal').find('input').val('');
                    }

                } catch (error) {
                    if (error && error.response && error.status == 422) {
                        $('.errors').empty();
                        $('.errors').addClass('alert alert-danger');
                         $.each(error.response.data.errors, function (index, element) { 
                             $('.errors').append(`<li>${element}</li>`)
                         });
                    }
                }
            });
        }

    });
</script>

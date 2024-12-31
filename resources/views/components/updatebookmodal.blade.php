<!-- Button trigger modal -->
<button type="button" hidden class="nav-link" id="updatebookbtn" data-bs-toggle="modal" data-bs-target="#updatebookmodal">
    update book
</button>
<!-- Modal -->
<div class="modal fade" id="updatebookmodal" book-id="" tabindex="-1" aria-labelledby="updatebook" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updatebook">update book</h1>
                <button type="button" class="btn-close x-close-update" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label class='mb-2'>title</label>
                        <input type="text" class="title form-control" value placeholder="book title">
                         <div class=" mt-2 text text-danger title_error"></div>
                    </div>
                    <div class="mb-3">
                        <label class='mb-2'>author</label>
                        <input type="text" class="author form-control" value placeholder="author">
                        <div class=" mt-2 text text-danger author_error"></div>
                    </div>
                    <div class="mb-3">
                        <label class='mb-2'>upload book</label>
                        <input type="file" value class="upload form-control">
                        <div class=" mt-2 text text-danger upload_error"></div>
                       <div class='d-flex mt-4 align-items-center gap-2'>
                        <span>current book</span>
                        <input readonly class='focus-ring focus-ring-danger current_book form-control w-75' type="text" value=''>
                       </div>
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
                <button type="button" class="btn btn-secondary close-update" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn update-book btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

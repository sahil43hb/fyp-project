@extends('admin.layouts.master')

@section('title')
    Footcase - Categories
@endsection

@section('css')
@endsection

@section('content')
    <div class="d-flex flex-row justify-content-end">
        <button class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#basicModal">Add
            category</button>
    </div>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="addCategory">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="activeStatus" aria-label="Default select example"
                                    required>
                                    <option selected>Select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="editCategory">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="categoryTitle" name="title" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-select" id="categoryActiveStatus" name="active_status"
                                    aria-label="Default select example" required>
                                    <option selected>Select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="deleteCategory">
                    <div class="modal-body">
                        @method('DELETE')
                        @csrf
                        <div class="mb-3">
                            <h5>Are you sure you want to delete the category?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            No
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Yes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table id="example" class="display text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>


    </table>
@endsection

@section('script')
@endsection

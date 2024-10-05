@extends('admin.layouts.master')
@section('title')
AgileSole - Sub Categories
@endsection

@section('css')

@endsection

@section('content')
        <div class="d-flex flex-row justify-content-end">
            <button class="btn bg-color text-white my-4" data-bs-toggle="modal" data-bs-target="#basicModal">Add Sub Category</button>
        </div>
        <div class="modal fade" id="basicModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title theme-color">New Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="addSubCategory">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label theme-color">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label theme-color">Status</label>
                                <div class="col-sm-12">
                                    <select class="form-select" name="activeStatus" aria-label="Default select example" required>
                                        <option value="" selected>Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label theme-color">Category</label>
                                <div class="col-sm-12">
                                    <select class="form-select" name="category_id" aria-label="Default select example" required>
                                        <option value="" selected>Select Category</option>

                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn bg-color text-white">
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
                        <h5 class="modal-title theme-color">Edit Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="editSubCategory">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label theme-color">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="subCategoryTitle" name="title" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label theme-color">Status</label>
                                <div class="col-sm-12">
                                    <select class="form-select" id="subCategoryStatus" name="active_status" aria-label="Default select example" required>
                                        <option value="" selected>Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label theme-color">Category</label>
                                <div class="col-sm-12">
                                    <select class="form-select" name="category_id" id="categoryStatus" aria-label="Default select example" required>
                                        <option value="" selected>Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn bg-color text-white">
                                Update
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
                        <h5 class="modal-title text-danger">Delete Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="deleteSubCategory">
                        <div class="modal-body">
                            @method('DELETE')
                            @csrf
                            <div class="mb-3">
                                <h5>Are you sure you want to delete the Sub Category?</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn bg-danger text-white">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table id="sub_category_table" class="display text-center">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>


        </table>
@endsection
@section('script')
@endsection
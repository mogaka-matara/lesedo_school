@extends('admin.layouts.master')
@section('title', 'All Students')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Desks and Chairs</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{'dashboard'}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Desks and Chairs</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">

                        <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                           data-bs-target="#add_library_book"><i class="ti ti-square-rounded-plus me-2"></i>Add
                            Item</a>
                    </div>
                </div>
            </div>

            {{ $dataTable->table() }}


        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Book -->
    <div class="modal fade" id="add_library_book">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Book</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" name="item_name"  class="form-control">
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Stock</label>
                                            <input type="text" name="total_stock" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Supplied Items</label>
                                            <input type="text" name="supplied_stock" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Remaining Items</label>
                                    <input type="text" name="remaining_stock" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Book -->

    <div class="modal fade" id="add_stock">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Assign Item</h4>
                        <span class="badge badge-sm bg-primary ms-2"></span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('inventory.restock') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="item_id" id="itemId" value="">

                    <div class="modal-body">
                        <!-- Amount -->
                        <div class="mb-3">
                            <label class="form-label">Add Quantity</label>
                            <input type="number" name="add_stock" class="form-control" placeholder="Enter Quantity" step="0.01" required>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Stock</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="assign_item">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Assign Item</h4>
                        <span class="badge badge-sm bg-primary ms-2"></span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('inventory.assign-item') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="item_id" id="itemAssignId" value="">

                    <div class="modal-body">
                        <!-- Amount -->
                        <div class="mb-3">
                            <label class="form-label">Assign Item</label>
                            <input type="number" name="assign_item" class="form-control" placeholder="Enter Quantity" step="0.01" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Assign Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $('#add_stock').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('item-id');
                $('#itemId').val(itemId);
            });
        </script>

    <script>
        $('#assign_item').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var itemAssignId = button.data('item-assign-id');
            $('#itemAssignId').val(itemAssignId);
        });
    </script>

@endpush


@extends('admins.layouts.app')

@section('title')
    <title>Quan li phuong tien </title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Phuong tien</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Tài khoản</li>
        </ol>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="mb-3">
                                <label>Tìm kiếm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên" id="keywords">
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>bien so</label>
                                <input type="date" class="form-control" id="establish">
                            </div>
                        </div> --}}
                        <div
                            class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal"
                                    data-target="#ModalAddNew">
                                    <i class="fas fa-plus-circle mr-1"></i> Thêm phuong tien
                                </button>
                                {{-- <a href="{{ route('users.export') }}" class="btn btn-outline-success" id="export-excel">
                                    <i class="fas fa-file-download mr-1"></i> Xuất excel
                                </a> --}}
                            </div>
                        </div>
                    </div>


                    <table id="datatables" class="table table-hover w-100">
                        <thead class="panels">
                            <tr>
                                <th> loại phương tiện </th>
                                <th> Name car </th>
                                <th> tài xế </th>
                                <th> note </th>
                                <th> status </th>
                                <th> seri </th>
                                <th> avavtar car </th>
                                {{-- <th> a </th> --}}


                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal create --}}
    <div class="modal fade" id="ModalAddNew" tabindex="-1" aria-labelledby="ModalAddNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddNewLabel">
                        <b>Thêm phuong tien</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('cardetail.add') }}" method="POST" id="submit_form_add"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Tên phuong tien:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">note:</label>
                            <textarea type="text" class="form-control" name="note"></textarea>
                            <div id="note-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1" >status</label>
                            <select name='status' class="form-control">
                                <option value="1">tạm ngưng</option>
                                <option value="2">đang hoạt động</option>
                                <option value="3">sắp ra mắt</option>
                            </select>
                            <div id="status-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">seri:</label>
                            <input type="text" class="form-control" name="seri">
                            <div id="status-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Thông tin ảnh:</label>
                            <input  type="file" class="form-control" name="avatar_car">
                            <div id="avatar-error" class="text-danger fs-6"></div>
                        </div>

                        <div class="form-group">
                            <label class="mb-1" >Chọn tài xế</label>
                            <select name='user_id' class="form-control">
                                @foreach ($driver as $value)
                                <option  value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-1" >chọn loại phương tiện</label>
                            <select name='type_traffic_id' class="form-control">
                                @foreach ($type_car as $typecar)
                                    <option  value="{{ $typecar->id }}">{{ $typecar->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit-add">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


            {{-- modal edit --}}
            {{-- <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditLabel">Sửa Loại phương tiện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="ModalEditContent">

                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        var datatables = $('#datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            autofill: true,
            "order": [
                [0, "DESC"]
            ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_",
                "sZeroRecords": "<div class='alert alert-info'>Danh sách trống</div>",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
                "sProcessing": "<div id='loader-datatable'></div>",
            },
            ajax: {
                url: '{{ route('cardetail.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.establish = $("#establish").val();
                }
            },
            columns: [
                {
                    data: 'type_traffic.name',
                    name: 'type_traffic.name'
                },

                {
                    data: 'name_car',
                    name: 'name_car'
                },
                {
                    data: 'user.name',
                    name: 'user.name',
                    render: function(data, type, row) {
                        var html = `<div>
                                <div>
                                    <b>Name: </b><span class="">${row?.user?.name}</span>
                                </div>
                                <div>
                                    <b>Email: </b><span class="text-info">${row?.user?.email}</span>
                                </div>
                            </div>`

                        return html;
                    }
                },



                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        let status = 1;
                        if (row.status == 1) {

                            status = "<div class='text-danger'>tạm ngưng </div>";
                        } else if (row.status == 2) {
                            status = "<div class='text-success'>đang hoạt động </div>";
                        } else {
                            status = "<div class='text-warning'>sắp ra mắt </div>";
                        }

                        return status;
                    }

                },
                {
                    data: 'seri',
                    name: 'seri'
                },
                {
                    data: 'avatar_car',
                    name: 'avatar_car',
                    render: function(data, type, row) {
                        // cons
                        let html =
                         //   `<img class="border rounded-circle border-1" width="80" height="80" src="${row?.avatar_car}" />`
                        `<img class="border rounded-circle border-1" width="80" src="{{ config('app.url') }}/${row?.avatar_car}" />`
                        return html
                    }
                },

                {
                    data: 'action',
                    orderable: false,
                    render: function(data, type, row) {
                        let html = `<div class="text-center">
                                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item modal-edit" data-id="${row?.id}" data-url="{{ route('car.show', ['id' => '/']) }}/${row?.id}" href="#">
                                                Edit
                                            </a>
                                            <a class="dropdown-item detele_item" data-id="${row?.id}" data-url="{{ route('car.delete', ['id' => '/']) }}/${row?.id}" href="#">
                                                Delete
                                            </a>
                                        </div>
                                    </div>`
                        return html
                        return ""
                    }
                },

            ],
        });

        $(document).on('click', '#btn-search', function() {
            datatables.ajax.reload();
        })

        $(document).on('change', '#keywords', debounce(function() {
            datatables.ajax.reload();
        }, 300))

        $(document).on('change', '#establish', debounce(function() {
            datatables.ajax.reload();
        }, 300))
    </script>
@endpush

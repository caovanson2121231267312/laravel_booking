@extends('admins.layouts.app')

@section('title')
    <title>Quan li Order </title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Đơn Hàng</h1>
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
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>bien so</label>
                                <input type="date" class="form-control" id="establish">
                            </div>
                        </div>
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
                                    <i class="fas fa-plus-circle mr-1"></i> ADD ROAD
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
                                <th>Start</th>
                                <th>End </th>
                                <th>tạo lúc</th>
                                <th>phương tiện</th>
                                <th>số lượng khách</th>
                                <th>price </th>
                                <th>total_price </th>
                                <th>status_car </th>
                                <th>status_payment</th>




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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddNewLabel">
                        <b>Thêm lịch trình</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('order.add') }}" method="POST" id="submit_form_add" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">start:</label>
                            <input type="text" class="form-control" name="start">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">end:</label>
                            <input type="text" class="form-control" name="end">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">price:</label>
                            <input type="text" class="form-control" name="price">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">phương tiện:</label>
                            <select name="traffic" class="form-control" id="">
                                @foreach ($traffic as $value)
                                    <option value="{{ $value->id }}"> {{ $value->name_car }}</option>
                                @endforeach

                            </select>
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">status_car:</label>
                            <select name="status_car" class="form-control" id="">
                                <option value="0"> chờ duyệt</option>
                                <option value="1"> đã xác nhận</option>
                                <option value="2"> đang di chuyện</option>
                                <option value="3"> đã hoàn thành</option>
                                <option value="4"> hủy chuyến </option>
                            </select>
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">status_payment:</label>
                            <select name="status_payment" class="form-control" id="">
                                <option value="0"> chưa thanh toán</option>
                                <option value="1"> đã thanh toán</option>
                            </select>
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>

                        <div class="form-group">
                            <label class="mb-1">Danh sách khác hàng: <a href="javascript:void(0)" id="add_customer"
                                    class="ms-2 text-primary">+ Thêm khách hàng mới</a></label>
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>

                        <div id="customers">

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
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditLabel">Sửa đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="ModalEditContent">

                </div>
            </div>
        </div>
    </div>


    {{-- modal Email --}}
    {{-- <div class="modal fade" id="ModalSendMail" tabindex="-1" aria-labelledby="ModalSendMailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="ModalSendMailLabel">
                        <b>SendEmail</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.sendmail') }}" method="POST" id="submit_SendMail" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Nội Dung:</label>
                            <textarea class="form-control" id="text-content"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn-send-mail">Send</button>
                    </div>
                </form>
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
                url: '{{ route('order.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.establish = $("#establish").val();
                }
            },
            columns: [

                {
                    data: 'start',
                    name: 'start'
                },


                {
                    data: 'end',
                    name: 'end'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'traffic.name_car',
                    name: 'traffic.name_car'
                },
                {
                    data: 'order_detail_count',
                    name: 'order_detail_count'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
                },
                {
                    data: 'status_car',
                    name: 'status_car',
                    render: function(data, type, row) {
                        let status_car = 0;
                        if (row.status_car == 0) {

                            status_car = "<div class='badge bg-warning'>chờ duyệt </div>";
                        } else if (row.status_car == 1) {
                            status_car = "<div class='badge bg-light text-dark'>đã xác nhận </div>";
                        } else if (row.status_car == 2) {
                            status_car = "<div class='badge bg-primary'>đang di chuyển </div>";
                        } else if (row.status_car == 3) {
                            status_car = "<div class='badge bg-success'>đã hoàn thành</div>";
                        } else {
                            status_car = "<div class='badge bg-danger'>hủy chuyến </div>";
                        }

                        return status_car;
                    }

                },
                {
                    data: 'status_payment',
                    name: 'status_payment',
                    render: function(data, type, row) {
                        let status_payment = 0;
                        if (row.status_payment == 0) {
                            status_payment = "<div class='text-danger'>chưa thanh toán </div>";
                        } else {
                            status_payment = "<div class='text-warning'>đã thanh toán </div>";
                        }

                        return status_payment;
                    }
                },
                {
                    data: 'action',
                    orderable: false,
                    render: function(data, type, row) {
                        var html_action = "";
                        if (row.status_car != 4) {

                            if (row.status_car != 1) {
                                html_action += `<a class="dropdown-item confirm_order" data-id="${row?.id}" data-url="{{ route('order.confirm', ['id' => '/']) }}/${row?.id}" href="#">
                                                Xác nhận đơn
                                            </a>`
                            }

                            html_action += `<a class="dropdown-item cancel_order" data-id="${row?.id}" data-url="{{ route('order.cancel', ['id' => '/']) }}/${row?.id}" href="#">
                                            hủy đơn
                                        </a>`;
                        }


                        let html = `<div class="text-center">
                                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item modal-edit" data-id="${row?.id}" data-url="{{ route('order.show', ['id' => '/']) }}/${row?.id}" href="#">
                                                Edit
                                            </a>
                                            ${html_action}

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


        var id = 0;
        $(document).on("click", ".modal-password", function() {
            id = $(this).data("id");
            $("#ModalPassword").modal("show");
        })

        $(document).on("click", ".modal-sendmail", function() {
            id = $(this).data("id");
            $("#ModalSendMail").modal("show");
        })

        $(document).on('click', '.cancel_order', function() {
            var id = $(this).data('id');
            var url = $(this).data('url');

            Swal.fire({
                title: "Bạn chắc chắn muốn hủy chuyến",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xác nhận"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            toastr.success(response?.success)
                            datatables.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            check_message_error(xhr)
                            datatables.ajax.reload();
                        }
                    });
                }
            });
        })
        $(document).on('click', '.confirm_order', function() {
            var id = $(this).data('id');
            var url = $(this).data('url');

            Swal.fire({
                title: "Bạn chắc chắn muốn xác nhận chuyến",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xác nhận"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            toastr.success(response?.success)
                            datatables.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            check_message_error(xhr)
                            datatables.ajax.reload();
                        }
                    });
                }
            });
        })

        $customer_number = 1;

        $(document).on("click", "#add_customer", function() {

            var html = `<div class="row mt-2">
                                <div class="w-100 pl-2 fw-bold text-info">
                                    Khách hàng số ${ $customer_number }
                                </div>
                                <div class="col-3">
                                    <label class="mb-1">Tên khách hàng:</label>
                                    <input type="text" class="form-control" name="name_customer[]">
                                </div>
                                <div class="col-3">
                                    <label class="mb-1">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="phone_customer[]">
                                </div>
                                <div class="col-3">
                                    <label class="mb-1">Loại khách hàng:</label>
                                    <select name="customer_type_id[]" class="form-control">
                                        @foreach ($customer_types as $value)
                                            <option value="{{ $value->id }}">{{ $value->name_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="mb-1">Ghi chú:</label>
                                    <input type="text" class="form-control" name="note[]">
                                </div>
                            </div>`;

            $("#customers").append(html)

            $customer_number++
        })
    </script>
@endpush

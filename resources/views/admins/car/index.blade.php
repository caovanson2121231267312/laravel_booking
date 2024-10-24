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
                                    <i class="fas fa-plus-circle mr-1"></i> Thêm loai phuong tien
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
                                <th> Name car </th>
                                <th> create at </th>

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
                <form action="{{ route('car.add') }}" method="POST" id="submit_form_add" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Tên phuong tien:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
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
                    <h5 class="modal-title" id="ModalEditLabel">Sửa Loại phương tiện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="ModalEditContent">

                </div>
            </div>
        </div>
    </div>

    {{-- modal changepassword --}}
    {{-- <div class="modal fade" id="ModalPassword" tabindex="-1" aria-labelledby="ModalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalPasswordLabel">
                        <b>Password</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.changepassword') }}" method="POST" id="submit_changepasssword"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Mật khẩu hiện tại:</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>

                        <div class="form-group">
                            <label class="mb-1">Nhập lại mật khẩu:</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation">
                            <div id="password_confirmation-error" class="text-danger fs-6"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn-change-password">Xác nhận đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
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
                url: '{{ route('car.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.establish = $("#establish").val();
                }
            },
            columns: [

                {
                    data: 'name',
                    name: 'name'
                },


                {
                    data: 'created_at',
                    name: 'created_at'
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


        var id = 0;
        $(document).on("click", ".modal-password", function() {
            id = $(this).data("id");
            $("#ModalPassword").modal("show");
        })

        $(document).on("click", ".modal-sendmail", function() {
            id = $(this).data("id");
            $("#ModalSendMail").modal("show");
        })

        $(document).on("submit", "#submit_changepasssword", function(event) {
            event.preventDefault();

            var button_html = $('#btn-change-password').text();
            $('#btn-change-password').html(`<div class="spinner-border text-light spin-size-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);

            var formData = new FormData();
            formData.append("user_id", id);
            formData.append("password", $("#password").val());
            formData.append("password_confirmation", $("#password_confirmation").val());

            var url = $('#submit_changepasssword').attr('action');
            console.log(url)

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    datatables.ajax.reload();
                    $('#btn-change-password').html(button_html)
                    toastr.success(response?.success)
                    $('#ModalPassword').modal('hide')
                    document.getElementById("submit_changepasssword").reset();
                },
                error: function(xhr) {
                    check_message_error(xhr, "edit")
                    $('#btn-change-password').html(button_html)
                }
            });
        })
        $(document).on("submit", "#submit_SendMail", function(event) {
            event.preventDefault();

            var button_html = $('#btn-send-mail').text();
            $('#btn-send-mail').html(`<div class="spinner-border text-light spin-size-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);

            var formData = new FormData();
            formData.append("user_id", id);
            formData.append("text_content", $("#text-content").val());


            var url = $('#submit_SendMail').attr('action');
            console.log(url)

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    datatables.ajax.reload();
                    $('#btn-send-mail').html(button_html)
                    toastr.success(response?.success)
                    $('#ModalSendMail').modal('hide')
                    document.getElementById("submit_SendMail").reset();
                },
                error: function(xhr) {
                    check_message_error(xhr, "edit")
                    $('#btn-send-mail').html(button_html)
                }
            });
        })




    </script>
@endpush

<form action="{{ route('car.edit',['id'=>$data->id]) }}" method="POST" id="submit_form_edit"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label class="mb-1">tên phương tien</label>
            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            <div id="name-error" class="text-danger fs-6"></div>
        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-add">Thêm mới</button>
    </div>
</form>

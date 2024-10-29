<form action="{{ route('cardetail.edit', ['id' => $data->id]) }}" method="POST" id="submit_form_edit"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label class="mb-1" >chọn loại phương tiện</label>
            <select name='type_traffic_id' class="form-control">
                @foreach ($type_car as $typecar)
                    <option  value="{{ $typecar->id }}" @selected($typecar->id == $data->type_traffic_id)>{{ $typecar->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="mb-1" >Chọn tài xế</label>
            <select name='user_id' class="form-control">
                @foreach ($driver as $value)
                    <option  value="{{ $value->id }}" @selected($value->id==$data->user_id)>{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="mb-1">Tên phuong tien:</label>
            <input type="text" class="form-control" name='name' value="{{$data->name_car}}">
            <div id="name-error" class="text-danger fs-6"></div>
        </div>
        <div class="form-group">
            <label class="mb-1">note:</label>
            <textarea type="text" class="form-control" name="note">{{$data->note}}</textarea>
            <div id="note-error" class="text-danger fs-6"></div>
        </div>
        <div class="form-group">
            <label class="mb-1">Avatar:</label>
            <input type="file" class="form-control" name="avatar_car">
            <div id="avatar_car-error" class="text-danger fs-6"></div>
            <div class="border mt-2">
                <img width="80" src="{{ asset($data->avatar_car) }}" alt="">
            </div>
        </div>
        <div class="form-group">
            <label class="mb-1">status</label>
            <select name='status' class="form-control">
                <option value="1" @if ($data->status == 1)
                    {{ 'selected' }}
                @endif>tạm ngưng</option>
                <option value="2" @selected($data->status == 2)>đang hoạt động</option>
                <option value="3" @selected($data->status == 3)>sắp ra mắt</option>
            </select>
            <div id="status-error" class="text-danger fs-6"></div>
        </div>
        <div class="form-group">
            <label class="mb-1">seri:</label>
            <input type="text" class="form-control" name="seri" value="{{ $data->seri }}">
            <div id="establish-error" class="text-danger fs-6"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-add">sửa mới</button>
    </div>
</form>

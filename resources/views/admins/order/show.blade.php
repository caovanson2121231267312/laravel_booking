<form action="{{ route('order.edit', ['id' => $order->id]) }}" method="POST" id="submit_form_edit"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label class="mb-1">start:</label>
                <input type="text" class="form-control" name='start' value="{{$order->start}}">
                <div id="start-error" class="text-danger fs-6"></div>
            </div>
            <div class="form-group">
                <label class="mb-1">end:</label>
                <textarea type="text" class="form-control" name="end">{{$order->end}}</textarea>
                <div id="end-error" class="text-danger fs-6"></div>
            </div>
            <label class="mb-1" >chọn loại phương tiện</label>
            <select name='type_traffic_id' class="form-control">
                @foreach ($traffic as $typecar)
                    <option  value="{{ $typecar->id }}" @selected($typecar->id == $order->type_traffic_id)>{{ $typecar->name_car }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="mb-1" >Chọn tài xế</label>
            <select name='user_id' class="form-control">
                @foreach ($driver as $value)
                    <option  value="{{ $value->id }}" @selected($value->id==$order->user_id)>{{ $value->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label class="mb-1">status</label>
            <select name='status' class="form-control">
                <option value="1" @if ($order->status == 1)
                    {{ 'selected' }}
                @endif>tạm ngưng</option>
                <option value="2" @selected($order->status == 2)>đang hoạt động</option>
                <option value="3" @selected($order->status == 3)>sắp ra mắt</option>
            </select>
            <div id="status-error" class="text-danger fs-6"></div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-add">sửa mới</button>
    </div>
</form>

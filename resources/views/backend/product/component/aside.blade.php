<div class="form-group col-md-12 card-box p-2">
    <div class="form-row mb-2">
        <label class="col-form-label">Mã sản phẩm
            <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control text-right" value="{{ (isset($post)) ? $post->code : old('code') }}"
               name="code">
    </div>

    <div class="form-row">
        <label>Thương hiệu</label>
        <select name="brand_id" class="form-control mb-2">
            <option value="">Chọn thương hiệu</option>
            <option value="1">Levent</option>
            <option value="2">Apple</option>
            <option value="3">H & M</option>
        </select>
    </div>
    <div class="form-row">
        <label for="" class="col-form-label">Giá tiền
            <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            class="form-control productPrice text-right"
            name="price"
            value="{{ (isset($post)) ? $post->price : old('price') }}"
        >
    </div>
    <div class="form-row">
        <label for="" class="col-form-label">{{ __('post_message.option') }}
            <span class="text-danger">*</span> <br>
        </label>
        @php
            $status = [
                1 => __('dashboard.publish'),
                2 => __('dashboard.un_publish'),
            ]
        @endphp
        <select name="publish" class="form-control mb-2">
            @foreach($status as $key => $val)
                <option value="{{ $key }}"
                    {{ isset($post) && $post->publish == $key ? 'selected' : '' }}>
                    {{ $val }}
                </option>
            @endforeach
        </select>
    </div>
</div>

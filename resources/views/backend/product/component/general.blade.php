<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('Tên sản phẩm') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control productName"
                name="name"
                placeholder="{{ __('Tên sản phẩm') }}..."
                value="{{ (isset($post)) ? $post->name : old('name') }}"
            >
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('Mô tả ngắn cho sản phẩm') }}</label>
            <textarea
                type="text"
                class="form-control ck-editor"
                id="description"
                name="description"
                placeholder="{{ __('Nhập mô tả sản phẩm') }}..."
                data-height=""
            >{{ (isset($post)) ? $post->description : old('description') }}</textarea>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('Nội dung sản phẩm') }}
                <span id="charCount" class="count_meta-title">0 kí tự</span>
            </label>
            <textarea
                type="text"
                class="form-control ck-editor countVachar"
                name="content"
                id="content"
                placeholder="{{ __('Nội dung sản phẩm') }}..."
                data-height="500"
            >{{ (isset($post)) ? $post->content : old('content') }}</textarea>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.name') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control"
                name="name"
                placeholder="{{ __('post_message.name') }}..."
                value="{{ (isset($post)) ? $post->name : old('name') }}"
            >
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.description') }}</label>
            <textarea
                type="text"
                class="form-control ck-editor"
                id="description"
                name="description"
                placeholder="{{ __('post_message.description') }}..."
                data-height=""
            >{{ (isset($post)) ? $post->description : old('description') }}</textarea>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.content') }}
                <span id="charCount" class="count_meta-title">0 kí tự</span>
            </label>
            <textarea
                type="text"
                class="form-control ck-editor countVachar"
                name="content"
                id="content"
                placeholder="{{ __('post_message.content') }}..."
                data-height="500"
            >{{ (isset($post)) ? $post->content : old('content') }}</textarea>
        </div>
    </div>
</div>

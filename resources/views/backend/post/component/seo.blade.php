<div class="ibox-content">
    <div class="seo-container">
        <div class="meta_title">
            {{ (old('meta-title')) ?? __('post_message.not_meta_title') }}
        </div>
        <div class="canonical">
            {{ (old('canonical')) ? config('app.url').(old('canonical')).config('apps.general.suffix') : __('post_message.not_slug') }}
        </div>
        <div class="meta_description">
            {{ (old('meta_description')) ?? __('post_message.not_meta_description') }}
        </div>
    </div>
    <div class="seo-wrapper">
        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.meta_title') }}
                <span class="count_meta-title">0 kí tự</span>
            </label>
            <input
                type="text"
                class="form-control"
                name="meta_title"
                placeholder="{{ __('post_message.meta_title') }}..."
                value="{{ (isset($post)) ? $post->meta_title : old('meta_title') }}"
            >
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.meta_keyword') }}</label>
            <input
                type="text"
                class="form-control"
                name="meta_keyword"
                placeholder="{{ __('post_message.meta_keyword') }}..."
                value="{{ (isset($post)) ? $post->meta_keyword : old('meta_keyword') }}"
            >
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.meta_description') }}
                <span class="count_meta-title">0 kí tự</span>
            </label>
            <textarea
                type="text"
                class="form-control"
                name="meta_description"
                placeholder="{{ __('post_message.meta_description') }}..."
                value="{{ old('meta_description') }}"
            >{{ (isset($post)) ? $post->meta_description : old('meta_description') }}</textarea>
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('post_message.slug') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control input-wapper"
                name="slug"
                value="{{ (isset($post)) ? $post->slug : old('slug') }}"
            >
            <span class="baseUrl">{{ config('app.url') }}</span>
        </div>
    </div>
</div>

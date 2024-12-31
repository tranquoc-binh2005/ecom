<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('postCatalogue_message.name') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control"
                name="name"
                placeholder="{{ __('postCatalogue_message.name') }}"
                value="{{ (isset($postCatalogue)) ? $postCatalogue->name : old('name') }}"
            >
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('postCatalogue_message.description') }}
                <span class="count_meta-title">0 kí tự</span>
            </label>
            <textarea
                type="text"
                class="form-control"
                name="description"
                placeholder="{{ __('postCatalogue_message.description') }}..."
            >{{ (isset($postCatalogue)) ? $postCatalogue->description : old('description') }}</textarea>
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('postCatalogue_message.slug') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control input-wapper"
                name="slug"
                value="{{ (isset($postCatalogue)) ? $postCatalogue->slug : old('slug') }}"
            >
            <span class="baseUrl">{{ config('app.url') }}</span>
        </div>
    </div>
</div>

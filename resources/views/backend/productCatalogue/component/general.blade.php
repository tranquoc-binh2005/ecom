<div class="col-md-12">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="" class="col-form-label">{{ __('productCatalogue_message.name') }}
                <span class="text-danger">*</span>
            </label>
            <input
                type="text"
                class="form-control"
                name="name"
                placeholder="{{ __('productCatalogue_message.name') }}"
                value="{{ (isset($postCatalogue)) ? $postCatalogue->name : old('name') }}"
            >
        </div>

        <div class="col-md-12">
            <label for="" class="col-form-label">{{ __('productCatalogue_message.slug') }}
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

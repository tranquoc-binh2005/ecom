<div class="form-group col-md-12">
    <label for="" class="col-form-label">Cấu hình nâng cao
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
                {{ isset($postCatalogue) && $postCatalogue->publish == $key ? 'selected' : '' }}>
                {{ $val }}
            </option>
        @endforeach
    </select>
</div>

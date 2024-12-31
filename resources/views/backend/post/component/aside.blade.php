<div class="form-group col-md-12">
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

    <!--@php
        $follows = [
            2 => __('dashboard.follow'),
            1 => __('dashboard.un_follow'),
        ]
    @endphp
    <select name="follow" class="form-control mb-2">
        @foreach($follows as $key => $val)
            <option value="{{ $key }}"
                {{ isset($post) && $post->follow == $key ? 'selected' : '' }}>
                {{ $val }}
            </option>
        @endforeach
    </select>-->

    <div class="">
        <label for="" class="col-form-label">{{ __('post_message.tag') }}</label>
        <textarea
            type="text"
            class="form-control"
            name="tags"
            placeholder="{{ __('post_message.tag') }}..."
            value="{{ old('tags') }}"
        >{{ (isset($post)) ? $post->tags : old('tags') }}</textarea>
    </div>
</div>

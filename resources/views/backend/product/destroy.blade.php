@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-6">
            <h4 class="header-title">{{ config('apps.title.postCatalogue.title.delete') }}</h4>
            <p class="text-muted font-13">
            {!! __('post_message.delete_confirm', ['name' => $post->name]) !!}
            </p>
            <p>
                {{ __('post_message.note') }}
            </p>
        </div>

        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('post_message.name') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        readonly
                        value="{{ $post->name }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('post_message.slug') }}</label>
                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        readonly
                        value="{{ $post->slug }}"
                    >
                </div>
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('post_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

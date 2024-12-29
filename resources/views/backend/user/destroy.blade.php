@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-6">
            <h4 class="header-title">{{ config('apps.title.user.title.delete') }}</h4>
            <p class="text-muted font-13">
                {!! __('user_message.delete_confirm', ['name' => $user->name]) !!}
            </p>
            <p class="text-danger font-13">
                {{ __('user_message.note') }}
            </p>
        </div>

        <form action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('user_message.name') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        readonly
                        value="{{ $user->name }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">Email</label>
                    <input
                        type="text"
                        name="email"
                        class="form-control"
                        readonly
                        value="{{ $user->email }}"
                    >
                </div>
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('user_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

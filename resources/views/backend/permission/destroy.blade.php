@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-6">
            <h4 class="header-title">{{ $breadcrumb['title'] }}</h4>
            <p class="text-muted font-13">
                {!! __('role_message.delete_confirm', ['name' => $permission->name]) !!}
            </p>
            <p class="text-muted font-13">
                {{ __('role_message.note') }}
            </p>
        </div>

        <form action="{{ route('permission.destroy', ['id' => $permission->id]) }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('role_message.group') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        readonly
                        value="{{ $permission->name }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('role_message.slug') }}</label>
                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        readonly
                        value="{{ $permission->slug }}"
                    >
                </div>
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('role_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

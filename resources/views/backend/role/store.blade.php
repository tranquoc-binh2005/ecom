@extends('backend.dashboard')

@section('content')
    <div class="card-body row">
        <div class="col-md-4">
            <h4 class="header-title">{{ $breadcrumb['title'] }}</h4>
            <p class="text-muted font-13">
                {!!  __('role_message.required') !!}
            </p>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">-{{ $error }}</div>
                @endforeach
            @endif
        </div>

        <form class="col-md-8" action="{{ (isset($role)) ? route('role.update', ['id' => $role->id]) : route('role.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('role_message.group') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="{{ __('role_message.group') }}"
                        value="{{ isset($role) ? $role->name : old('name') }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('role_message.slug') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        name="slug"
                        value="{{ isset($role) ? $role->slug : old('slug') }}"
                        placeholder="{{ __('role_message.slug') }}"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-form-label">{{ __('role_message.description') }}</label>
                <input
                    type="text"
                    value="{{ isset($role) ? $role->description : old('description') }}"
                    class="form-control"
                    name="description"
                    placeholder="{{ __('role_message.description') }}">
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('role_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

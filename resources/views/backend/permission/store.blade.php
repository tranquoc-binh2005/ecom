@extends('backend.dashboard')

@section('content')
    <div class="card-body row">
        <div class="col-md-4">
            <h4 class="header-title">{{ $breadcrumb['title'] }}</h4>
            <p class="text-muted font-13">
                {!!  __('permission_message.required') !!}
            </p>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">-{{ $error }}</div>
                @endforeach
            @endif
        </div>

        <form class="col-md-8" action="{{ (isset($permission)) ? route('permission.update', ['id' => $permission->id]) : route('permission.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('permission_message.name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="{{ __('permission_message.name') }}"
                        value="{{ isset($permission) ? $permission->name : old('name') }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('permission_message.slug') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        name="slug"
                        value="{{ isset($permission) ? $permission->slug : old('slug') }}"
                        placeholder="{{ __('permission_message.slug') }}"
                    >
                </div>
            </div>


            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('permission_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

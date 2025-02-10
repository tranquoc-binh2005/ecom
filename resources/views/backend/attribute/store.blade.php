@extends('backend.dashboard')

@section('content')
    <form class="" method="POST" action="{{ (isset($attribute)) ? route('attribute.update', ['id' => $attribute->id]) : route('attribute.store') }}">
        @csrf
        <div class="d-flex">
            <div class="col-md-12">
                <div class="ibox col-md-12">
                    <h5 class="title">{{ $breadcrumb['title'] }}</h5>
                    <hr>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">-{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="ibox-content">
                        <div class="form-group col-md-12">
                            <label for="" class="col-form-label">{{ __('Nhóm thuộc tính') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                placeholder="{{ __('Nhóm thuộc tính') }}"
                                value="{{ (isset($attribute)) ? $attribute->name : old('name') }}"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right mb-0">
            <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Lưu lại</button>
        </div>
    </form>
@endsection

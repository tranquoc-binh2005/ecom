@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-6">
            <h4 class="header-title">Xoá sản phẩm</h4>
            <p class="text-muted font-13">
            {!! __('post_message.delete_confirm', ['name' => $product->name]) !!}
            </p>
            <p>
                {{ __('post_message.note') }}
            </p>
        </div>

        <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('Tên sản phẩm') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        readonly
                        value="{{ $product->name }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('Đường dẫn sản phẩm') }}</label>
                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        readonly
                        value="{{ $product->slug }}"
                    >
                </div>
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('Lưu lại')
                }}</button>
            </div>

        </form>

    </div>
@endsection

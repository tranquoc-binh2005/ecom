@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-6">
            <h4 class="header-title">{{ $breadcrumb['title'] }}</h4>
            <p class="text-muted font-13">
                {!! __('postCatalogue_message.delete_confirm', ['name' => $attrValue->name]) !!}
            </p>
            <p class="text-danger font-13">
                {{ __('postCatalogue_message.note') }}
            </p>
        </div>

        <form action="{{ route('attribute.value.destroy', ['id' => $attrValue->id]) }}" method="POST"
              class="col-md-6">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="" class="col-form-label">{{ __('postCatalogue_message.name') }}</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        readonly
                        value="{{ $attrValue->value }}"
                    >
                </div>
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('postCatalogue_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

@extends('backend.dashboard')

@section('content')
    <form class="" method="POST" action="{{ (isset($attrValue)) ? route('attribute.value.update', ['id' => $attrValue->id]) : route('attribute.value.store') }}">
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
                    <div>
                        <label for="" class="col-form-label">{{ __('postCatalogue_message.select_parent') }}
                            <span class="text-danger">*</span> <br>
                            <span class="text-danger notion">{{ __('postCatalogue_message.root') }}</span>
                        </label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="" class="col-form-label">{{ __('user_message.gender') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select name="attribute_id" class="form-control">
                                <option value="">[Chọn thuộc tính cần thêm giá trị]</option>
                                @foreach($attributes as $val)
                                    <option value="{{ $val->id }}" {{ (isset($attrValue) && $attrValue->attribute->id ==
                                    $val->id) ||
                                    old('attribute_id') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="" class="col-form-label">{{ __('user_message.name') }}</label>
                            <input
                                type="text"
                                value="{{ (isset($attrValue)) ? $attrValue->value : old('value') }}"
                                class="form-control"
                                name="value">
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

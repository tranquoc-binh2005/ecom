@extends('backend.dashboard')

@section('content')
    <form class="" method="POST" action="{{ (isset($postCatalogue)) ? route('post.catalogue.update', ['id' => $postCatalogue->id]) : route('post.catalogue.store') }}">
        @csrf
        <h4 class="header-title">{{ config('apps.title.postCatalogue.title.create') }}</h4>
        <div class="d-flex gap-10">
            <div class="col-md-10 border-right">
                <div class="ibox col-md-12">
                    <h5 class="title">{{ $breadcrumb['title'] }}</h5>
                    <hr>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">-{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="ibox-content">
                        @include('backend.postCatalogue.component.general')
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="col-form-label">{{ __('postCatalogue_message.select_parent') }}
                            <span class="text-danger">*</span> <br>
                            <span class="text-danger notion">{{ __('postCatalogue_message.root') }}</span>
                        </label>
                        <select name="parent_id" class="form-control">
                            <option value="">Root</option>
                            @foreach($viewModel->getPostCatalogues() as $val)
                                {{$val['id']}}
                                <option
                                    {{ (old('parent_id') == $val['id'] || (isset($postCatalogue) && $postCatalogue->parent_id == $val['id'])) ? 'selected' : '' }}
                                    value="{{ $val['id'] }}">{{ str_repeat('|--', $val['depth']) . ' ' .$val['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    @include('backend.postCatalogue.component.aside')
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right mb-0">
            <button type="submit" class="btn btn-outline-danger waves-effect waves-light">Lưu lại</button>
        </div>
    </form>
@endsection

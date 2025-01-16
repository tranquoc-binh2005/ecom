@extends('backend.dashboard')

@section('content')
    <form class="" method="POST" action="{{ (isset($post)) ? route('product.update', ['id' => $post->id]) : route
    ('product.store') }}">
        @csrf
        <h4 class="header-title">{{ config('apps.title.post.title.create') }}</h4>
        <div class="d-flex gap-10">
            <div class="col-md-10 border-right">
                <div class="ibox col-md-12">
                    <h5 class="title">{{ __('post_message.general') }}</h5>
                    <hr>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">-{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="ibox-content">
                        @include('backend.product.component.general')
                    </div>
                    <div class="ibox-content">
                        <div class="album-wrapper">
                            <div class="title">
                                <p>ALBUM ẢNH</p>
                                <p class="multipleUploadImage">Chọn ảnh</p>
                            </div>
                            <div class="contentmultipleUploadImage content">
                                <p>
                                    <img class="multipleUploadImage" id="ckAlbum"
                                         src="templates/admin/assets/images/noimage.png" alt="">
                                </p>
                                <p>Sử dụng nút chọn hình hoặc nhấn vào đây để chọn hình ảnh</p>
                            </div>
                            <div id="imageContainer" class="image-container">
                                <?php
                                if(isset($data['post']['album']) && is_array($data['post']['album'])){
                                foreach ($data['post']['album'] as $key => $value) {
                                    ?>
                                <span class="image-wrapper">
                                    <img class="multipleUploadImage uploaded-image" id="ckAlbum" src="<?=$value?>" alt="<?=$value?>">
                                    <input type="hidden" name="album[]" value="<?=$value?>">
                                    <span class="delete-icon">x</span>
                                </span>
                                <?php }}?>
                            </div>
                        </div>
                    </div>

                    <div class="ibox-content">
                        @include('backend.product.component.variant')
                    </div>
                </div>
                <div class="ibox col-md-12 mt-2">
                    <h5 class="title">{{ __('post_message.seo') }}</h5>
                    <hr>
                    @include('backend.product.component.seo')
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="col-form-label">{{ __('post_message.parent_id') }}
                            <span class="text-danger">*</span> <br>
                        </label>
                        <select name="parent_id" class="form-control">
                            <option value="0">Root</option>
                            @foreach($viewModel->getProductCatalogue() as $val)
                                {{$val['id']}}
                                <option
                                    {{ (old('parent_id') == $val['id'] || (isset($post) && $post->parent_id ==
                                    $val['id'])) ? 'selected' : '' }}
                                    value="{{ $val['id'] }}">{{ str_repeat('|--', $val->depth) . $val['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <label for="" class="col-form-label">{{ __('post_message.image') }}</label> <br>
                    <div class="form-group col-md-12 bg-light text-center">
                        <span class="image img-cover">
                            <img id="ckAvataImg" width="150px" class="image-target"
                                 src="{{ isset($post->image) && $post->image ? $post->image : (old('image') ?? 'templates/admin/assets/images/no-image-icon.png') }}"
                                 alt="no images">
                        </span>
                        <input type="hidden" id="ckAvata" class="ck-target" name="image" value="{{ isset($post->image) && $post->image ? $post->image : (old('image') ?? '') }}">
                    </div>
                </div>

                <div class="form-row">
                    @include('backend.product.component.aside')
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right mb-0">
            <button type="submit" class="btn btn-outline-danger waves-effect waves-light">{{ __('post_message.save')
            }}</button>
        </div>
    </form>
@endsection

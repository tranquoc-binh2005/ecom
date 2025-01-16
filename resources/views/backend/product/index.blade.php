@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-box">
        <h4 class="header-title">{{ $title }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
        </ol>

        <div class="tools-box col bg-danger mb-4">
            <div class="ul right-0 position">
                <li>
                    <p class="dropdown-toggle btn btn-outline-secondary"><i class="fe-settings noti-icon"></i> {{ __
                    ('dashboard.option') }}</p>
                    <ul class="dropdown-menu">
                        <li>
                            <a
                                class="publishAll"
                                data-field="posts"
                                data-column="publish"
                                data-value="2"
                                href="#"
                            >{{ __('dashboard.publish') }}</a>
                        </li>
                        <li>
                            <a
                                class="publishAll"
                                data-field="posts"
                                data-column="publish"
                                data-value="1"
                                href="#"
                            >{{ __('dashboard.un_publish') }}</a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>

        <form action="{{ route('product.index') }}" method="GET">
            <div class="filter-box">
                <a class="btn btn-info" href="{{ route('product.create') }}">{{ __('post_message.add') }}</a>
                <div class="app-search-box bg-light mr-2">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search..."
                               value="{{ request('keyword') }}">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mr-2">
                    <select name="publish" class="form-control">
                        <option value="">{{ __('dashboard.select_publish') }}</option>
                        <option value="1" {{ request('publish') == 1 ? 'selected' : '' }}>{{ __('dashboard.publish') }}</option>
                        <option value="2" {{ request('publish') == 2 ? 'selected' : '' }}>{{ __('dashboard.un_publish')
                         }}</option>
                    </select>
                </div>

                <div class="mr-2">
                    <select name="parent_id" class="form-control">
                        <option value="">{{ __('dashboard.select_catalogue') }}</option>
                        @foreach($viewModel->getProductCatalogue() as $val)
                            <option value="{{ $val->id }}" {{ request('parent_id') == $val->id ? 'selected' : ''
                            }}>{{ str_repeat('|--', $val->depth) . $val->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="entries right-0 col-2">
                    <select name="perpage" class="form-control">
                        @for($i = 10; $i <= 50; $i += 10)
                            <option value="{{ $i }}" {{ request('perpage') == $i ? 'selected' : ''}}>{{ $i }}
                                entries</option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="inputCheckAll">
                    </th>
                    <th width="800px">{{ __('post_message.name') }}</th>
                    <th class="text-center">{{ __('post_message.image') }}</th>
                    <th width="120px">{{ __('post_message.publish') }}</th>
                    <th width="120xp" class="text-center">{{ __('post_message.follow') }}</th>
                    <th class="text-center" width="100px">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr class="">
                        <th scope="row">
                            <input
                                type="checkbox"
                                data-id="{{ $product->id }}"
                                class="inputCheck"
                                name="checked"
                                id="checked">
                        </th>
                        <td>
                            <p class="title_post">{{ $product->name }}</p>
                            {{ __('post_message.catalogue') }}: {{ $product->post_catalogues->name }}
                            <br>
                            {{ __('post_message.slug') }}: {{ config('app.url') . $product->post_catalogues->slug . '/' .
                            $product->slug }}
                            <br>
                            {{ __('post_message.author') }}: {{ $product->users->name }}
                            <hr>
                            <p class="box_description">"{{ $product->description }}"</p>
                        </td>
                        <td class="image_post">
                            <img width="100px" src="{{ $product->image }}" alt="{{ $product->name }}">
                        </td>
                        <th class="text-center">
                            <input
                                type="checkbox"
                                {{ ($product->publish == 1) ? 'checked' : '' }}
                                data-plugin="switchery"
                                data-color="#64b0f2"
                                data-size="small"
                                data-switchery="true"
                                style="display: none;"
                                class="changeStatusPublish location-{{$product->id}}"
                                data-field="posts"
                                data-column="publish"
                                data-id="{{ $product->id }}"
                                data-status="{{ $product->publish }}"
                            >
                        </th>
                        <th class="text-center">
                            <input type="number" data-id="{{ $product->id }}" data-field="posts" name="order" value="{{
                            $product->order }}"
                                   min="0"
                                   max="1000">
                        </th>
                        <th class="text-center">
                            <a style="font-size: 20px;" href="{{ route('product.edit', ['id' =>
                            $product->id]) }}"><i
                                    class="fe-edit"></i> </a>
                            <a style="font-size: 20px; color:rgb(241, 55, 55);"
                               href="{{ route('product.delete', ['id' => $product->id]) }}"><i
                                    class="fe-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
                @if($products->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Không tìm thấy nhóm bài viết nào.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if (count($products) > 10)
        {{ $products->links('vendor.pagination.ui-paginate') }}
    @endif
@endsection

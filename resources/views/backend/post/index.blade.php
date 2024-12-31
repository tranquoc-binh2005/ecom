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

        <form action="{{ route('post.index') }}" method="GET">
            <div class="filter-box">
                <a class="btn btn-info" href="{{ route('post.create') }}">{{ __('post_message.add') }}</a>
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
                        @foreach($viewModel->getPostCatalogues() as $val)
                            <option value="{{ $val->id }}" {{ request('parent_id') == $val->id ? 'selected' : ''
                            }}>{{$val->name}}</option>
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
                @foreach ($posts as $post)
                    <tr class="">
                        <th scope="row">
                            <input
                                type="checkbox"
                                data-id="{{ $post->id }}"
                                class="inputCheck"
                                name="checked"
                                id="checked">
                        </th>
                        <td>
                            <p class="title_post">{{ $post->name }}</p>
                            {{ __('post_message.catalogue') }}: {{ $post->post_catalogues->name }}
                            <br>
                            {{ __('post_message.slug') }}: {{ config('app.url') . $post->post_catalogues->slug . '/' .
                            $post->slug }}
                            <br>
                            {{ __('post_message.author') }}: {{ $post->users->name }}
                            <hr>
                            <p class="box_description">"{{ $post->description }}"</p>
                        </td>
                        <td class="image_post">
                            <img width="100px" src="{{ $post->image }}" alt="{{ $post->name }}">
                        </td>
                        <th class="text-center">
                            <input
                                type="checkbox"
                                {{ ($post->publish == 1) ? 'checked' : '' }}
                                data-plugin="switchery"
                                data-color="#64b0f2"
                                data-size="small"
                                data-switchery="true"
                                style="display: none;"
                                class="changeStatusPublish location-{{$post->id}}"
                                data-field="posts"
                                data-column="publish"
                                data-id="{{ $post->id }}"
                                data-status="{{ $post->publish }}"
                            >
                        </th>
                        <th class="text-center">
                            <input type="number" data-id="{{ $post->id }}" data-field="posts" name="order" value="{{
                            $post->order }}"
                                   min="0"
                                   max="1000">
                        </th>
                        <th class="text-center">
                            <a style="font-size: 20px;" href="{{ route('post.edit', ['id' =>
                            $post->id]) }}"><i
                                    class="fe-edit"></i> </a>
                            <a style="font-size: 20px; color:rgb(241, 55, 55);"
                               href="{{ route('post.delete', ['id' => $post->id]) }}"><i
                                    class="fe-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
                @if($posts->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Không tìm thấy nhóm bài viết nào.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if (count($posts) > 10)
        {{ $posts->links('vendor.pagination.ui-paginate') }}
    @endif
@endsection

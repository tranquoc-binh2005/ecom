@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-box">
        <h4 class="header-title">{{ $title }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
        </ol>

        <div class="tools-box col bg-danger mb-4">
            <div class="ul right-0 position">
                <li>
                    <p class="dropdown-toggle btn btn-outline-secondary"><i class="fe-settings noti-icon"></i> {{ __
                    ('dashboard.option')
                    }}</p>
                    <ul class="dropdown-menu">
                        <li>
                            <a
                                class="publishAll"
                                data-field="post_catalogue"
                                data-column="publish"
                                data-value="2"
                                href="#"
                            >Xuất bản</a>
                        </li>
                        <li>
                            <a
                                class="publishAll"
                                data-field="post_catalogue"
                                data-column="publish"
                                data-value="1"
                                href="#"
                            >Huỷ xuất bản</a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>

        <form action="{{ route('post.catalogue.index') }}" method="GET">
            <div class="filter-box">
                <a class="btn btn-info" href="{{ route('post.catalogue.create') }}">{{ __('postCatalogue_message.add') }}</a>
                <div class="app-search-box bg-light mr-2">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('postCatalogue_message.search')
                         }}"
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
                        <option value="1" {{ request('publish') == 1 ? 'selected' : '' }}>{{ __('dashboard.publish')
                        }}</option>
                        <option value="2" {{ request('publish') == 2 ? 'selected' : '' }}>{{ __('dashboard.un_publish')
                        }}</option>
                    </select>
                </div>
                <div class="entries right-0 col-2">
                    <select name="perpage" class="form-control">
                        @for ($i = 10; $i <= 100; $i+= 20)
                            <option value="{{ $i }}" {{ request('perpage') == $i ? 'selected' : '' }}>{{ $i }} entries
                            </option>
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
                    <th>{{ __('postCatalogue_message.name') }}</th>
                    <th class="text-center">{{ __('postCatalogue_message.description') }}</th>
                    <th class="text-center">{{ __('postCatalogue_message.slug') }}</th>
                    <th width="120px" class="text-center">{{ __('postCatalogue_message.publish') }}</th>
                    <th width="100px">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($viewModel->getPostCatalogues() as $postCatalogue)
                    <tr class="">
                        <td width="50px" scope="row">
                            <input
                                type="checkbox"
                                data-id="{{ $postCatalogue->id }}"
                                class="inputCheck"
                                name="checked"
                                id="checked">
                        </td>
                        <td class="col-info text-left" width="350px">
                            {{ str_repeat('|--', $postCatalogue['depth']) . ' ' . $postCatalogue['name'] }}
                        </td>
                        <td>{{ $postCatalogue->description }}</td>
                        <td class="text-center">
                            {{ $postCatalogue->slug }}
                        </td>
                        <th class="text-center">
                            <input
                                type="checkbox"
                                {{ ($postCatalogue->publish == 1) ? 'checked' : '' }}
                                data-plugin="switchery"
                                data-color="#64b0f2"
                                data-size="small"
                                data-switchery="true"
                                style="display: none;"
                                class="changeStatusPublish location-{{ $postCatalogue->id }}"
                                data-field="post_catalogue"
                                data-column="publish"
                                data-id="{{ $postCatalogue->id }}"
                                data-status="{{ $postCatalogue->publish }}"
                            >
                        </th>
                        <th>
                            <a style="font-size: 20px;" href="{{ route('post.catalogue.edit', ['id' => $postCatalogue->id]) }}"><i
                                    class="fe-edit"></i> </a>
                            <a style="font-size: 20px; color:rgb(241, 55, 55);"
                               href="{{ route('post.catalogue.delete', ['id' => $postCatalogue->id]) }}"><i class="fe-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
                @if(count($viewModel->getPostCatalogues()) == 0)
                    <tr>
                        <td colspan="6" class="text-center">{{ __('postCatalogue_message.not_found') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    {{ $viewModel->getPostCatalogues()->links('vendor.pagination.ui-paginate') }}
@endsection

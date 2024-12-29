@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-box mt-10">
        <h4 class="header-title">{{ $title }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
        </ol>

        <form action="{{ route('role.index') }}" method="GET">
            <div class="filter-box">
                <a class="btn btn-info" href="{{ route('role.create') }}">{{ __('role_message.add') }}</a>
                <div class="app-search-box bg-light mr-2">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('role_message.search')
                         }}"
                               value="{{ request('keyword') }}">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th>{{ __('role_message.group') }}</th>
                    <th>{{ __('role_message.slug') }}</th>
                    <th>{{ __('role_message.description') }}</th>
                    <th class="text-center">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr class="">
                        <td >{{ $role->name }}</td>
                        <td >{{ $role->slug }}</td>
                        <td >{{ $role->description }}</td>
                        <th class="text-center">
                            <a style="font-size: 20px;" href="{{ route('role.edit', ['id' => $role->id]) }}"><i
                                    class="fe-edit"></i> </a>
                            <a style="font-size: 20px; color:rgb(241, 55, 55);"
                               href="{{ route('role.delete', ['id' => $role->id]) }}"><i
                                    class="fe-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
                @if($roles->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">{{ __('role_message.not_found') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if (count($roles) > 1)
        {{ $roles->links('vendor.pagination.ui-paginate') }}
    @endif
@endsection('content')

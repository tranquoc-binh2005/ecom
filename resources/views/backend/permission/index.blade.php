@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-box mt-10">
        <h4 class="header-title">{{ __('permission_message.add')}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
        </ol>

        <form action="{{ route('permission.index') }}" method="GET">
            <div class="filter-box">
                <a class="btn btn-info" href="{{ route('permission.create') }}">{{ __('permission_message.add') }}</a>
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
            </div>
        </form>

        <form id="formChangeStatusPermission" action="{{ route('changePermission.index') }}"
              method="post">
            @csrf
        <div class="table-responsive">
            <table class="table mb-0" id="permission_sortable">
                <thead>
                <tr>
                    <th width="250px">{{ __('permission_message.name') }}</th>
                    <th width="200px">{{ __('permission_message.slug') }}</th>
                    <th width="80px" class="text-center">#</th>
                    <th class="text-center box-permission">
                        @foreach($roles as $role)
                            <span>{{ $role->name }}</span>
                        @endforeach
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr class="">
                        <td >{{ $permission->name }}</td>
                        <td >{{ $permission->slug }}</td>
                        <th class="text-center">
                            <a style="font-size: 20px;" href="{{ route('permission.edit', ['id' => $permission->id]) }}"><i
                                    class="fe-edit"></i> </a>
                            <a style="font-size: 20px; color:rgb(241, 55, 55);"
                               href="{{ route('permission.delete', ['id' => $permission->id]) }}"><i
                                    class="fe-trash"></i></a>
                        </th>

                        <td class="box-permission">
                            @foreach($roles as $role)
                                <input
                                    type="checkbox"
                                    class="permissionCheck"
                                    name="permission[{{$role->id}}][]"
                                    value="{{ $permission->id }}"
                                    @if($role->permissions->contains('id', $permission->id)) checked @endif
                                >
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                @if($permissions->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">{{ __('permission_message.not_found') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        </form>
        <div class="form-group text-right mb-0">
            <button id="submitChangePermission" type="submit" class="btn btn-danger waves-effect waves-light">{{ __
            ('role_message.save')
                }}</button>
        </div>
    </div>
@endsection('content')

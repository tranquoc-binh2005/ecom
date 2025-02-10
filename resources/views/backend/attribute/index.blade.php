@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="d-flex gap-10">
        <div class="card-box col-md-12">
            <h4 class="header-title">{{ $title }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
            </ol>

            <form action="{{ route('attribute.index') }}" method="GET">
                <div class="filter-box d-flex gap-10">
                    <a class="btn btn-primary" href="{{ route('attribute.create') }}">{{ __('Thêm nhóm thuộc tính sản
                phẩm')}}</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th width="100px" class="text-left">{{ __('Thuộc tính') }}</th>
                        <th width="100px" class="text-left">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($attributes as $attr)
                        <tr class="">
                            <th width="100px">
                                {{ $attr->name }}
                            </th>
                            <th>
                                <a style="font-size: 20px;" href="{{ route('attribute.edit', ['id' => $attr->id]) }}"><i
                                        class="fe-edit"></i> </a>
                                <a style="font-size: 20px; color:rgb(241, 55, 55);"
                                   href="{{ route('attribute.delete', ['id' => $attr->id]) }}"><i class="fe-trash"></i></a>
                            </th>
                        </tr>
                    @endforeach
                    @if(count($attributes) == 0)
                        <tr>
                            <td colspan="6" class="text-center">{{ __('productCatalogue_message.not_found') }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            @if(count($attributes) > 10)
                {{ $attributes->links('vendor.pagination.ui-paginate') }}
            @endif
        </div>
    </div>
@endsection

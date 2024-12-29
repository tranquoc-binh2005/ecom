@extends('backend.dashboard') <!-- Đường dẫn tới file layout -->

@section('content')
    <div class="card-body row">
        <div class="col-md-4">
            <h4 class="header-title">{{ $breadcrumb['title'] }}</h4>
            <p class="text-muted font-13">
            {!! __('user_message.required') !!}
            </p>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">-{{ $error }}</div>
                @endforeach
            @endif

        </div>
        <form class="col-md-8" action="{{ (isset($user)) ? route('user.update', ['id' => $user->id]) : route('user.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('user_message.name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="{{ __('user_message.name') }}"
                        value="{{ (isset($user)) ? $user->name : old('name') }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">Email
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        value="{{ (isset($user)) ? $user->email : old('email') }}"
                        placeholder="Email">
                </div>
            </div>

            @if(!isset($user))
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="" class="col-form-label">{{ __('user_message.password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="col-form-label">{{ __('user_message.confirm_password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="password"
                            class="form-control"
                            name="re_password"
                            placeholder="Re_Password">
                    </div>
                </div>
            @endif
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="" class="col-form-label">{{ __('user_message.address') }}</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ (isset($user)) ? $user->address : old('address') }}"
                        name="address">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="col-form-label">{{ __('user_message.phone') }}</label>
                    <input
                        type="number"
                        min="0"
                        value="{{ (isset($user)) ? $user->phone : old('phone') }}"
                        class="form-control"
                        name="phone">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="col-form-label">{{ __('user_message.gender') }}
                        <span class="text-danger">*</span>
                    </label>
                    @php
                    $genders = [
                        'Chọn giới tính',
                        'Nam',
                        'Nữ',
                        'Không xác định'
                    ];
                    @endphp
                    <select name="gender" class="form-control">
                        @foreach($genders as $key => $gender)
                            <option value="{{ $key }}" {{ (isset($user) && $user->gender == $key) || old
                            ('gender') == $key ? 'selected' : '' }}>{{ $gender }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <label for="" class="col-form-label">{{ __('user_message.role') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="role_id[]" multiple="multiple" class="form-control setupSelect2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{(isset($user) && in_array($role->id, $user->roles->pluck('id')->toArray()))
                                    || (old('role_id') && in_array($role->id, old('role_id'))) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-form-label">{{ __('user_message.description') }}</label>
                <input
                    type="text"
                    value="{{ (isset($user)) ? $user->description : old('description') }}"
                    class="form-control"
                    name="description"
                    placeholder="Đôi nét về bạn...">
            </div>

            <div class="form-group">
                <label for="" class="col-form-label">{{ __('user_message.image') }}</label>
                <input
                    type="text"
                    id="ckAvata"
                    value="{{ (isset($user)) ? $user->image : old('image') }}"
                    class="form-control upload-image"
                    data-type="Images"
                    name="image"
                    placeholder="{{ __('user_message.image') }}">
            </div>

            <div class="form-group text-right mb-0">
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('user_message.save')
                }}</button>
            </div>

        </form>

    </div>
@endsection

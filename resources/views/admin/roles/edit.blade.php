@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{ asset('admins/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('title')
    Edit Role
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Role</h3>
        </div>
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <h3>Role Permissions:</h3>
                <div class="form-group">
                    <select class="js-example-basic-multiple w-100" name="permissions[]" multiple="multiple">
                        @forelse ($permissions as $permission)
                            @if (!$role->permissions->isEmpty())
                                @foreach ($role->permissions as $role_permission)
                                    @if ($role_permission->id == $permission->id)
                                        <option value="{{ $permission->id }}" selected="selected">
                                            {{ $permission->name }}
                                        </option>
                                    @break
                                @endif
                            @endforeach
                            @if ($role_permission->id != $permission->id)
                                <option value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                </option>
                            @endif
                        @else
                            <option value="{{ $permission->id }}">
                                {{ $permission->name }}
                            </option>
                        @endif
                    @empty
                    @endforelse

                </select>

            </div>
            <div class="form-group">
                <label for="name">ID</label>
                <input type="text" class="form-control" value="{{ $role->id }}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                    value="{{ $role->name }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('admins/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $('.js-example-basic-multiple').trigger({
        type: 'select2:select',
        params: {
            data: 'Alabama'
        }
    })
</script>
@endsection

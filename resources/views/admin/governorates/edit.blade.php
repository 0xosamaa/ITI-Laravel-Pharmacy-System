@extends('admin.layouts.app')
@section('title')
    Governorates
@endsection
@section('content')
    <div class="container">
        <h1>Edit Governorate</h1>
        <form method="POST" action="{{ route('admin.governorates.update', $governorate->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $governorate->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

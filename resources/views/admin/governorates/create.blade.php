@extends('admin.layouts.app')
@section('title')
    Governorates
@endsection

@section('content')
<div class="container">
    <h1>Create Governorate</h1>
    <form method="POST" action="{{ route('admin.governorates.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

<form method="POST" action="{{ route('admin.areas.update', $area->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $area->name }}">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $area->address }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

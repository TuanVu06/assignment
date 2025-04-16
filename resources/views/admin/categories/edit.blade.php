<!-- resources/views/admin/categories/edit.blade.php -->
@extends('admin.layout.app')

@section('content')
    <h1 class="mb-4">Sửa loại tin</h1>
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tên loại tin</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                <option value="1" {{ old('is_active', $category->is_active) == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('is_active', $category->is_active) == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
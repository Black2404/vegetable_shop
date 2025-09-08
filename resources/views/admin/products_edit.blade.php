<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Sửa sản phẩm</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Playfair Display', serif; padding-top: 80px; }
        h2 { text-align: center; color: #4b4b32; margin-bottom: 20px; margin-top: 50px; }
    </style>
</head>
<body>
    @include('admin/header')

<div class="container">
    <h2>Sửa thông tin sản phẩm</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control" value="{{ old('image', $product->image) }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>

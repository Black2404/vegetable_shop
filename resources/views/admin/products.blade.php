<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Quản lý sản phẩm</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            padding-top: 80px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .img-thumbnail {
            display: block;
            margin: auto;
        }
        .pagination .page-link {
            color: #6d6a4b;
            border: 1px solid #6d6a4b;
            background-color: #fff;
        }
        .pagination .page-item.active .page-link {
            background-color: #6d6a4b;
            border-color: #6d6a4b;
            color: #fff;
        }
        .pagination .page-link:hover {
            background-color: #c7c6aa;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4b4b32;
        }
    </style>
</head>
<body>
    @include('admin/header')

<div class="container mt-4">
    <h2>Danh sách sản phẩm</h2>

    <!-- Form thêm sản phẩm -->
    <div class="card mb-4">
        <div class="card-header">Thêm sản phẩm</div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="price" class="form-control" placeholder="Giá" required>
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="image" class="form-control" placeholder="Ảnh">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng sản phẩm -->
    <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
            <tr>
                <th style="width:5%">ID</th>
                <th style="width:35%">Tên sản phẩm</th>
                <th style="width:15%">Giá</th>
                <th style="width:20%">Ảnh</th>
                <th style="width:25%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] ?? '' }}</td>
                <td class="text-start">{{ $product['name'] ?? '' }}</td>
                <td>{{ number_format($product['price'] ?? 0) }}đ</td>
                <td>
                    <img src="{{ asset('images/' . ($product['image'] ?? 'default.jpg')) }}" 
                         class="img-thumbnail" 
                         style="width:80px; height:80px; object-fit:cover;">
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product['id']) }}" 
                       class="btn btn-warning btn-sm me-1">Sửa</a>

                    <form action="{{ route('admin.products.delete', $product['id']) }}" 
                          method="POST" 
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger btn-sm" 
                                onclick="return confirm('Xóa sản phẩm này?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>

</div>
</body>
</html>

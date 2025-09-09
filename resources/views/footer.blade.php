<footer style="background-color: #f2efec; padding: 60px 0; font-family: 'Playfair Display', serif;">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h3 style="color: #4b4b32;">Rau Củ Quả</h3>
                <p><strong>Địa chỉ:</strong><br>74 Nguyễn Thái Học, Đông Hà, Quảng Trị</p>
                <p><strong>Liên hệ:</strong><br>012.3344.566<br>raucu@gmail.com</p>
            </div>
            <div class="col-md-4">
                <h5 style="color: #4b4b32;">Giờ mở cửa</h5>
                <p><strong>Thứ 2 - Thứ 6:</strong><br>8:00 - 21:00</p>
                <p><strong>Thứ 7 - Chủ nhật:</strong><br>8:00 - 20:00</p>
            </div>
            <div class="col-md-4">
                <h5 style="color: #4b4b32;">Viết đánh giá</h5>
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="text" class="form-control" name="name" placeholder="Tên" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-2">
                        <textarea class="form-control" name="message" rows="3" placeholder="Viết đánh giá của bạn" required>{{ old('content') }}</textarea>
                    </div>
                    <button type="submit" class="btn" style="background-color: #7d7d52; color: white; width: 100%;">Gửi đánh giá</button>
                </form>

            </div>
        
</footer>

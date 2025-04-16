<!-- Footer với thông báo thành công -->
<footer class="bg-light text-dark pt-5 pb-4 mt-5 border-top">
    <div class="container text-md-left">
        <div class="row">

            <!-- Thông tin -->
            <div class="col-md-6 col-lg-5 mb-4">
                <h5 class="text-uppercase fw-bold">Về chúng tôi</h5>
                <p>VUExpress Clone - Website tin tức học tập mô phỏng giao diện và chức năng báo điện tử.</p>
                <p><i class="bi bi-envelope"></i> tuanvu280605@gmail.com</p>
                <p><i class="bi bi-telephone"></i> 039 256 3323</p>
            </div>

            <!-- Form liên hệ -->
            <div class="col-md-6 col-lg-6 mb-4">
                <h5 class="text-uppercase fw-bold">Liên hệ / Góp ý / Hợp tác</h5>

                <!-- Hiển thị thông báo thành công -->
                <!-- Thêm vào footer -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <script>
                        // Tự động ẩn thông báo sau 5 giây
                        setTimeout(function() {
                            let alert = document.getElementById('successAlert');
                            if (alert) {
                                let bsAlert = new bootstrap.Alert(alert);
                                bsAlert.close();
                            }
                        }, 5000); // 5000ms = 5 giây
                    </script>
                @endif

                <form id="feedbackForm" action="{{ route('send.feedback') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="type" class="form-label">Chủ đề</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="gopy">Góp ý</option>
                            <option value="phanhoi">Phản hồi</option>
                            <option value="hoptac">Hợp tác</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="name" class="form-control" placeholder="Tên của bạn" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-2">
                        <label for="attachment" class="form-label">Đính kèm file (nếu có)</label>
                        <input type="file" name="attachment" id="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="message" rows="3" class="form-control" placeholder="Nội dung" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Gửi</button>
                </form>
            </div>

        </div>

        <hr>

        <!-- Bản quyền -->
        <div class="text-center">
            <p>© <?php echo date('Y'); ?> VUExpress Clone. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn form gửi theo cách mặc định

        let formData = new FormData(this);

        fetch("{{ route('send.feedback') }}", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Thêm thông báo thành công
                    let alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.role = 'alert';
                    alertDiv.innerHTML = `
                    ${data.success}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                    document.querySelector('#feedbackForm').prepend(alertDiv);

                    // Reset form
                    document.getElementById('feedbackForm').reset();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            });
    });
</script>

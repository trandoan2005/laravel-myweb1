document.querySelectorAll('.img-input').forEach(input => {
    input.addEventListener('change', function () {
        // this.closest('.group-img'): block cha
        // querySelector('.preview-image'): tìm element con(.preview-image)
        const preview = this.closest('.img-group').querySelector('.img-preview');
        preview.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.width = 150;
            img.style.margin = '5px';
            preview.appendChild(img);
        });
    });
});

// AJAX Delete Product Sub Image (Câu G)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-delete-sub-img');
    if (btn) {
        if (confirm('Bạn có chắc chắn muốn xóa ảnh phụ này?')) {
            const imgId = btn.getAttribute('data-id');
            const url = btn.getAttribute('data-url');
            const container = document.getElementById('sub-img-container-' + imgId);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Lỗi hệ thống khi gửi yêu cầu.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    if (container) {
                        container.remove();
                    }
                } else {
                    alert(data.message || 'Lỗi khi xóa ảnh');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi hệ thống khi xóa ảnh.');
            });
        }
    }
});

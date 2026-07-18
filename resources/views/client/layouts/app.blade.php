<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyWeb Shop')</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Standard CSS (No Vite needed) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-client.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="px-3">
        @include('client.partials.header')
    </div>

    <!-- Padding top for fixed navbar -->
    <main class="container flex-grow-1" style="padding-top: 40px; padding-bottom: 50px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </main>

    @include('client.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.form-add-cart');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Ngăn submit form mặc định
                    const url = this.getAttribute('action');
                    const formData = new FormData(this);

                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status) {
                            // Cập nhật số lượng giỏ hàng
                            const cartBadge = document.getElementById('cart-count');
                            if(cartBadge) {
                                cartBadge.innerText = data.cartCount;
                                cartBadge.classList.remove('d-none');
                            }
                            // Thông báo thành công
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

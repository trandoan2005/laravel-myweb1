@extends('admin.layouts.admin')
@section('title', 'Quản lý Khách hàng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Quản lý Khách hàng</h4>
        <p class="text-muted mb-0">Danh sách khách hàng đã đăng ký hoặc đặt hàng</p>
    </div>
</div>

<div class="admin-card card border-0 mb-4 p-4">
    <!-- Tìm kiếm -->
    <form method="GET" action="{{ route('admin.customers.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Tìm kiếm theo Tên, Email, SĐT..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary bg-gradient-primary border-0 w-100 fw-medium">Lọc danh sách</button>
            </div>
            @if(request('search'))
            <div class="col-md-2">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-light w-100 fw-medium">Xóa lọc</a>
            </div>
            @endif
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-muted" style="font-size: 13px;">
                <tr>
                    <th class="fw-bold text-uppercase">#</th>
                    <th class="fw-bold text-uppercase">Khách hàng</th>
                    <th class="fw-bold text-uppercase">Liên hệ</th>
                    <th class="fw-bold text-uppercase">Địa chỉ</th>
                    <th class="fw-bold text-uppercase text-center">Đơn hàng</th>
                    <th class="fw-bold text-uppercase text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td class="fw-bold text-muted">{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-gradient-info text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm me-3" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $customer->name }}</h6>
                                <small class="text-muted">ID: CUS-{{ $customer->id }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mb-1"><i class="bi bi-envelope text-primary me-2"></i>{{ $customer->email }}</div>
                        <div><i class="bi bi-telephone text-success me-2"></i>{{ $customer->phone }}</div>
                    </td>
                    <td style="max-width: 250px;" class="text-truncate" title="{{ $customer->address }}">
                        {{ $customer->address ?: 'Chưa cập nhật' }}
                    </td>
                    <td class="text-center">
                        <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm">{{ $customer->orders->count() ?? 0 }}</span>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm" style="width: 32px; height: 32px;" title="Xóa">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Không tìm thấy khách hàng nào.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection

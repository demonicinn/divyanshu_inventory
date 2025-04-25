@php
    $segment2 = request()->segment(2);
@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('ab') }}" class="brand-link">
            <span class="brand-text fw-light">{{ $app }}</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('ab.dashboard') }}"
                        class="nav-link{{ $segment2==''||$segment2=='dashboard'?' active':'' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('ab.store') }}"
                        class="nav-link{{ $segment2=='store'?' active':'' }}">
                        <i class="bi bi-shop"></i>
                        <p>Store</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('ab.products') }}"
                        class="nav-link{{ $segment2=='products'?' active':'' }}">
                        <i class="bi bi-kanban"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ab.inword') }}"
                        class="nav-link{{ $segment2=='inword'?' active':'' }}">
                        <i class="bi bi-truck-front"></i>
                        <p>Inword</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ab.outword') }}"
                        class="nav-link{{ $segment2=='outword'?' active':'' }}">
                        <i class="bi bi-truck"></i>
                        <p>Outword</p>
                    </a>
                </li>





            </ul>
        </nav>
    </div>
</aside>

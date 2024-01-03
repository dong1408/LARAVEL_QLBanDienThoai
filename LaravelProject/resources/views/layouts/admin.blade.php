<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link href="{{ url('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/font-awesome/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href={{ url('css/style.css') }}>
    <link rel="stylesheet" href="{{ url('css/import/detail_order.css') }}">

    @yield('integration_file_manage')

    <title>Admintrator</title>
</head>

<script>
    function checkDate() {
        var dateFrom = document.getElementById('date-from').value;
        var dateTo = document.getElementById('date-to').value;
        if (dateFrom > dateTo){
            var popup = document.getElementById('popup-error-date');
            popup.style.display = "block";
            return false;
        }
    }

    function checkPrice(){
        var priceFrom = document.getElementById('price-from').value;
        var priceTo = document.getElementById('price-to').value;
        if (priceFrom > priceTo){
            var popup = document.getElementById('popup-error-price');
            popup.style.display = "block";
            return false;
        }
    }

    function hiddenPopupDate(){
        var popup = document.getElementById('popup-error-date');
        popup.style.display = "none";
    }

    function hiddenPopupPrice(){
        var popup = document.getElementById('popup-error-price');
        popup.style.display = "none";
    }
</script>

<body>
    <div id="warpper" class="nav-fixed">
        <div id="popup-error-date"
            style="position: absolute;
            display:none;
            top:330px;
            left: 630px;
            z-index: 1031;
            width: 380px;
            padding: 20px;
            background-color: white; 
            border: 1px solid;">
            <div class="popup-content">
                <span onclick="hiddenPopupDate()" class="close">&times;</span>
                <p>Giá trị ngày sau phải lớn hơn ngày bắt đầu</p>
            </div>
        </div>
        <div id="popup-error-price"
            style="position: absolute;
            display:none;
            top:330px;
            left: 630px;
            z-index: 1031;
            width: 380px;
            padding: 20px;
            background-color: white; 
            border: 1px solid;">
            <div class="popup-content">
                <span onclick="hiddenPopupPrice()" class="close">&times;</span>
                <p>Giá trị sau phải lớn hơn giá trị trước</p>
            </div>
        </div>
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="?">ADMIN</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="?view=add-post">Thêm bài viết</a>
                        <a class="dropdown-item" href="?view=add-product">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="?view=list-order">Thêm đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="#">Thoát</a> --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Tài khoản') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Thoát') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        @php
            $module_active = session('module_active');
        @endphp
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    @can('dashboard.view')
                        <li class="nav-link {{ $module_active == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Dashboard
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                        </li>
                    @endcan
                    @canany(['page.view', 'page.add', 'page.edit', 'page.delete'])
                        <li class="nav-link">
                            <a href="?view=list-post">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Trang
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                @can('page.add')
                                    <li><a href="?view=add-post">Thêm mới</a></li>
                                @endcan
                                @can('page.view')
                                    <li><a href="?view=list-post">Danh sách</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                    @canany(['post.view', 'post.edit', 'post.add', 'post.delete'])
                        <li class="nav-link">
                            <a href="?view=list-post">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Bài viết
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                @can('post.add')
                                    <li><a href="?view=add-post">Thêm mới</a></li>
                                @endcan
                                @can('post.view')
                                    <li><a href="?view=list-post">Danh sách</a></li>
                                @endcan
                                {{-- @can('post.category')
                                    <li><a href="?view=cat">Danh mục</a></li>
                                @endcan --}}
                            </ul>
                        </li>
                    @endcanany
                    @canany('product.view', 'product.add', 'product.edit', 'product.delete', 'category.view',
                        'category.add', 'category.edit', 'category.delete')
                        <li
                            class="nav-link {{ $module_active == 'category' || $module_active == 'product' ? 'active' : '' }}">
                            <a href="{{ route('admin.product.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Sản phẩm
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                @can('product.add')
                                    <li><a href="{{ route('admin.product.add') }}">Thêm mới</a></li>
                                @endcan
                                @can('product.view')
                                    <li><a href="{{ route('admin.product.show') }}">Danh sách</a></li>
                                @endcan
                                @can('category.view')
                                    <li><a href="{{ route('admin.category.show') }}">Danh mục</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                    @canany('sale.view')
                        <li class="nav-link {{ $module_active == 'order' ? 'active' : '' }}">
                            <a href="{{ route('admin.order.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Bán hàng
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.order.show') }}">Đơn hàng</a></li>
                            </ul>
                        </li>
                    @endcanany
                    @canany('user.view', 'user.add', 'user.edit', 'user.delete')
                        <li class="nav-link {{ $module_active == 'user' ? 'active' : '' }}">
                            <a href="{{ url('admin/user/') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Users
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                @can('user.view')
                                    <li><a href="{{ route('admin.user.show') }}">Danh sách</a></li>
                                @endcan
                                @can('user.add')
                                    <li><a href="{{ route('admin.user.add') }}">Thêm mới</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                    @canany(['permission.view', 'permission.add', 'permission.edit', 'permission.delete', 'role.view',
                        'role.add', 'role.edit', 'role.delete'])
                        <li class="nav-link {{ $module_active == 'permission' ? 'active' : '' }}">
                            <a
                                href="
                            @if (Auth::user()->hasPermission('permission.view')) {{ route('admin.permission.add') }}
                            @else
                                {{ route('admin.role.show') }} @endif
                            ">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Phân quyền
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                @can('role.view')
                                    <li><a href="{{ route('admin.role.show') }}">Danh sách vai trò</a></li>
                                @endcan
                                @can('role.add')
                                    <li><a href="{{ route('admin.role.add') }}">Thêm vai trò</a></li>
                                @endcan
                                @canany(['permission.view', 'permission.add', 'permission.edit', 'permission.delete'])
                                    <li><a href="{{ route('admin.permission.add') }}">Quyền</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany
                    <li class="nav-link {{ $module_active == 'statistical' ? 'active' : '' }}">
                        <a href="{{ route('admin.statistical.show') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Thống kê
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src={{ url('js/app.js') }}></script>
    <script src="{{ url('js/image.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>

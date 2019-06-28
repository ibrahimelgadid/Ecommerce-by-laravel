<nav class="navbar navbar-expand-sm navbar-dark bg-dark  mb-4">
        <div class="container ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault2" aria-controls="navbarsExampleDefault2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarsExampleDefault2">
                <ul class="navbar-nav mr-auto">
                
                    <li class="nav-item  {{Request::is('admin/dashboard') ? "active":''}}">
                        <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown {{Request::is('admin/categories')||Request::is('admin/categories/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/admin/categories">All Categories</a>
                            <a class="dropdown-item" href="/admin/categories/create">Add Category</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{Request::is('admin/brands')||Request::is('admin/brands/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Brands</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/admin/brands">All Brands</a>
                            <a class="dropdown-item" href="/admin/brands/create">Add Brand</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{Request::is('admin/products')||Request::is('admin/products/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Products</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/admin/products">All Products</a>
                            <a class="dropdown-item" href="/admin/products/create">Add Product</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown {{Request::is('admin/sliders')||Request::is('admin/sliders/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Sliders</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/admin/sliders">All Sliders</a>
                            <a class="dropdown-item" href="/admin/sliders/create">Add Slider</a>
                        </div>
                    </li>

                    <li class="nav-item  {{Request::is('admin/members') ? "active":''}}">
                        <a class="nav-link" href="/admin/members">Members</a>
                    </li>
        
                    <li class="nav-item  {{Request::is('admin/orders') ? "active":''}}">
                        <a class="nav-link" href="/admin/orders">Orders</a>
                    </li>
            
                </ul>
              </div>
              </div>
            </nav>
            <div class="container all">
                @include('inc.message')
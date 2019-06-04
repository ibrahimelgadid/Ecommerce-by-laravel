<nav class="navbar navbar-expand-sm navbar-dark bg-dark  mb-4">
        <div class="container ">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault2" aria-controls="navbarsExampleDefault2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <div class="collapse navbar-collapse" id="navbarsExampleDefault2">
                <ul class="navbar-nav mr-auto">
                 
                    <li class="nav-item dropdown {{Request::is('categories')||Request::is('categories/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/categories">All Categories</a>
                            <a class="dropdown-item" href="/categories/create">Add Category</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{Request::is('brands')||Request::is('brands/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Brands</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/brands">All Brands</a>
                            <a class="dropdown-item" href="/brands/create">Add Brand</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{Request::is('products')||Request::is('products/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Products</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/products">All Products</a>
                            <a class="dropdown-item" href="/products/create">Add Product</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown {{Request::is('sliders')||Request::is('sliders/create') ? "active":''}}">
                        <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Sliders</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="/sliders">All Sliders</a>
                            <a class="dropdown-item" href="/sliders/create">Add Slider</a>
                        </div>
                    </li>

                    <li class="nav-item  {{Request::is('members') ? "active":''}}">
                        <a class="nav-link" href="/members">Members</a>
                    </li>
        
                    <li class="nav-item  {{Request::is('orders') ? "active":''}}">
                        <a class="nav-link" href="/orders">Orders</a>
                    </li>
            
                </ul>
              </div>
              </div>
            </nav>
            <div class="container all">
                @include('inc.message')
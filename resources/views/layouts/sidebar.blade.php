<!-- Sidenav Menu Start -->
<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="assets/images/logo.png" alt="logo"></span>
            <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="assets/images/logo-dark.png" alt="dark logo"></span>
            <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>
        </span>
    </a>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ri-close-line align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a href="/dashboard" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="airplay"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title">Manage Users</li>

            <li class="side-nav-item">
                <a href="{{route('users.index')}}" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="users"></i></span>
                    <span class="menu-text"> Users </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('client.index')}}" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="contact" class="w-5 h-5 text-blue-500"></i></span>
                    <span class="menu-text"> Clients </span>
                </a>
            </li>

            <li class="side-nav-title">Manage Inventory</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInventory" aria-expanded="false" aria-controls="sidebarInventory"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="package" class="w-5 h-5 text-blue-500"></i></span>
                    <span class="menu-text">Inventory</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInventory">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{route('warehouse.index')}}" class="side-nav-link">
                                <span class="menu-text">Warehouses</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('category.index')}}" class="side-nav-link">
                                <span class="menu-text">Categories</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('item.index')}}" class="side-nav-link">
                                <span class="menu-text">Items</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('stock.index')}}" class="side-nav-link">
                                <span class="menu-text">Stock</span>
                                <span class="badge bg-danger rounded">{{$stock_min}} Stock Alert</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('transaction.index')}}" class="side-nav-link">
                                <span class="menu-text">Transactions</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-title">Manage Operations</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarOperations" aria-expanded="false" aria-controls="sidebarOperations"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="activity" class="w-5 h-5 text-blue-500"></i></span>
                    <span class="menu-text">Operations</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarOperations">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="#" class="side-nav-link">
                                <span class="menu-text">Contracts</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="/admin" class="side-nav-link">
                                <span class="menu-text">Work Orders</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="side-nav-title">Settings</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="settings"></i></span>
                    <span class="menu-text">Settings</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="settings">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="/admin" class="side-nav-link">
                                <span class="menu-text">Website Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
    </div>
    </li>
    </ul>

    <div class="clearfix"></div>
</div>
</div>
<!-- Sidenav Menu End -->
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
            @role('superadmin')
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


            <li class="side-nav-title">Manage HR</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarHR" aria-expanded="false" aria-controls="sidebarOperations"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="briefcase" class="w-5 h-5 text-blue-500"></i></span>
                    <span class="menu-text">HR</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarHR">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{route('hr.index')}}" class="side-nav-link">
                                <span class="menu-text">Contracts</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
                            <a href="{{route('stock.index')}}" class="side-nav-link">
                                <span class="menu-text">Stock</span>
                                <span class="badge bg-danger rounded">{{$stock_min}} Stock Alert</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('request.index')}}" class="side-nav-link">
                                <span class="menu-text">Requests</span>
                                <span class="badge bg-danger rounded">{{$pending_req}} Requests</span>
                            </a>
                        </li>
                          <li class="side-nav-item">
                            <a href="{{route('transaction.index')}}" class="side-nav-link">
                                <span class="menu-text">Transactions</span>
                            </a>
                        </li>
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
                          
                       
                      
                    </ul>
                </div>
            </li>


            <li class="side-nav-title">Manage Sales</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSales" aria-expanded="false" aria-controls="sidebarOperations"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i></span>
                    <span class="menu-text">Sales</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSales">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{route('client.index')}}" class="side-nav-link">
                                <span class="menu-text">Clients</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('contract.index')}}" class="side-nav-link">
                                <span class="menu-text">Contracts</span>
                                <span class="badge bg-danger rounded">{{$new_contract}} New</span>
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
                            <a href="{{route('pending.index')}}" class="side-nav-link">
                                <span class="menu-text">Pending Orders</span>
                                <span class="badge bg-danger rounded">0 order</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('attribution.index')}}" class="side-nav-link">
                                <span class="menu-text">Attributions</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('order.index')}}" class="side-nav-link">
                                <span class="menu-text">Work Orders</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('urgent.index')}}" class="side-nav-link">
                                <span class="menu-text">Urgent Orders</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>


            <li class="side-nav-title">Financial Management</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarFinancial" aria-expanded="false" aria-controls="sidebarOperations"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="pie-chart" class="w-5 h-5 text-green-500"></i></span>
                    <span class="menu-text">Financial</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarFinancial">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{route('chart.index')}}" class="side-nav-link">
                                <span class="menu-text">Dynamic Chart</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('journal.index')}}" class="side-nav-link">
                                <span class="menu-text">Journal Entries</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('invoice.index')}}" class="side-nav-link">
                                <span class="menu-text">Invoices</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('reports.index')}}" class="side-nav-link">
                                <span class="menu-text">Reports</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @endrole
            @role('technician')
            <li class="side-nav-title">Technical Assignments</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTechnical" aria-expanded="false" aria-controls="sidebarOperations"
                    class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="clipboard-list" class="w-5 h-5 text-green-500"></i></span>
                    <span class="menu-text">Assignments</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTechnical">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="{{route('month.index')}}" class="side-nav-link">
                                <span class="menu-text">Monthly Assignments</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('day.index')}}" class="side-nav-link">
                                <span class="menu-text">Daily Assignments</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{route('inventory.index')}}" class="side-nav-link">
                    <span class="menu-icon"><i data-lucide="box" class="w-5 h-5 text-green-500"></i></span>
                    <span class="menu-text"> My Inventory </span>
                </a>
            </li>
            @endrole
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
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
   <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
       <i class="fe fe-x"><span class="sr-only"></span></i>
   </a>
   <nav class="vertnav navbar navbar-light">
       <!-- Brand -->
       <div class="w-100 mb-4 d-flex">
           <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
               <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120">
                   <g>
                       <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                       <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                       <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                   </g>
               </svg>
           </a>
       </div>

       <!-- Dashboard -->
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item dropdown">
               <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                   <i class="fe fe-home fe-16"></i>
                   <span class="ml-3 item-text">Dashboard</span>
               </a>
               <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                   <li class="nav-item">
                       <a class="nav-link pl-3" href="{{ route('dashboard.admin') }}"><span class="ml-1 item-text">Master Dashboard</span></a>
                   </li>
               </ul>
           </li>
       </ul>

       <!-- User & Roles -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Master Data</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item dropdown">
               <a href="#masterRoles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                   <i class="fe fe-user fe-16"></i>
                   <span class="ml-3 item-text">Roles & Users</span>
               </a>
               <ul class="collapse list-unstyled pl-4 w-100" id="masterRoles">
                   <li class="nav-item">
                       <a class="nav-link pl-3" href="{{ route('admin.users.index') }}"><span class="ml-1 item-text">Users</span></a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link pl-3" href="{{ route('admin.roles.index') }}"><span class="ml-1 item-text">Roles</span></a>
                   </li>
               </ul>
           </li>
       </ul>

       <!-- Modules -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Modules</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
            <a href="#modules" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Modules</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="modules">
                <li class="nav-item">
                    <a class="nav-link pl-3 {{ request()->routeIs('admin.modules.*') ? 'active' : '' }}"
                       href="{{ route('admin.modules.index') }}">
                        <span class="ml-1 item-text">Module List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-3 {{ request()->routeIs('admin.module-settings.*') ? 'active' : '' }}"
                       href="{{ route('admin.module-settings.index') }}">
                        <i class="fas fa-cogs me-2"></i>
                        <span class="item-text">Module Settings</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
       <!-- Blog -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Blog</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item dropdown">
               <a href="#blog" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                   <i class="fe fe-book fe-16"></i>
                   <span class="ml-3 item-text">Blog Data</span>
               </a>
               <ul class="collapse list-unstyled pl-4 w-100" id="blog">
                   <li class="nav-item">
                       <a class="nav-link pl-3 {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}" href="{{ route('admin.blog-categories.index') }}"><span class="ml-1 item-text">Blog Categories</span></a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link pl-3 {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}" href="{{ route('admin.blog-posts.index') }}"><span class="ml-1 item-text">Blog Posts</span></a>
                   </li>
               </ul>
           </li>
       </ul>

       <!-- Products -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Products</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item dropdown">
               <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                   <i class="fe fe-box fe-16"></i>
                   <span class="ml-3 item-text">Product Data</span>
               </a>
               <ul class="collapse list-unstyled pl-4 w-100" id="products">
                <li class="nav-item">
                    <a class="nav-link pl-3 {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}" 
                       href="{{ route('admin.product-categories.index') }}">
                        <span class="ml-1 item-text">Product Categories</span>
                    </a>
                </li>
                
                   <li class="nav-item">
                       <a class="nav-link pl-3 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}"><span class="ml-1 item-text">Products</span></a>
                   </li>
               </ul>
           </li>
       </ul>

       <!-- Contact -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Contact</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item dropdown">
               <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                   <i class="fe fe-mail fe-16"></i>
                   <span class="ml-3 item-text">Contact Data</span>
               </a>
               <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                <li class="nav-item">
                    <a class="nav-link pl-3 {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}" 
                       href="{{ route('admin.contact-messages.index') }}">
                        <span class="ml-1 item-text">Contact Messages</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link pl-3 {{ request()->routeIs('admin.contact-settings.*') ? 'active' : '' }}" 
                       href="{{ route('admin.contact-settings.index') }}">
                        <span class="ml-1 item-text">Contact Settings</span>
                    </a>
                </li>                
               </ul>
           </li>
       </ul>

       <!-- Activity Logs -->
       <p class="text-muted nav-heading mt-4 mb-1"><span>Logs</span></p>
       <ul class="navbar-nav flex-fill w-100 mb-2">
           <li class="nav-item">
               <a class="nav-link pl-3" href="#">
                   <i class="fe fe-clock fe-16"></i>
                   <span class="ml-3 item-text">Activity Logs</span>
               </a>
           </li>
       </ul>

       <div class="btn-box w-100 mt-4 mb-1">
           <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
               <i class="fe fe-shopping-cart fe-12 mx-2"></i><span class="small">Buy now</span>
           </a>
       </div>
   </nav>
</aside>
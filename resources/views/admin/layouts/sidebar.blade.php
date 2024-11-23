 <aside id="sidebar" class="sidebar">
     <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item ">
             <a class="nav-link collapsed theme-color" href="{{ url('/admin-panel') }}">
                 <span>Dashboard</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link collapsed theme-color" href="{{ url('/admin-panel/products') }}">
                 <span>Products</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link collapsed theme-color" id='main-category' data-bs-target="#components-nav"
                 data-bs-toggle="collapse">
                 <span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ url('/admin-panel/categories') }}" class="theme-color">
                         <i class="bi bi-circle"></i><span>Main Categories</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('/admin-panel/sub_categories') }}" class="theme-color">
                         <i class="bi bi-circle"></i><span>Sub Categories</span>
                     </a>
                 </li>
             </ul>
         </li>
         
         <li class="nav-item  ">
             <a class="nav-link collapsed theme-color" href="{{ url('/admin-panel/brands') }}">
                 <span>Brands</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link collapsed theme-color" href="{{ url('/admin-panel/orders') }}">

                 <span>Orders</span>
             </a>
         </li>

         <li class="nav-item ">
             <a class="nav-link  collapsed theme-color" href="{{ url('/admin-panel/users') }}">
                 <span>Users</span>
             </a>
         </li>
     </ul>
 </aside>

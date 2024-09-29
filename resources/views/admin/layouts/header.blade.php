  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="{{ url('admin-panel/') }}" class="logo d-flex align-items-center">
              <img width="60px" height="40px" src="{{ asset('img/AgileSoleLogo.png') }}" alt="">
              <!-- <span class="d-none d-lg-block theme-color">AgileSole</span> -->
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->

      {{-- <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
              <input type="text" name="query" placeholder="Search" title="Enter search keyword">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
      </div><!-- End Search Bar --> --}}

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              <li class="nav-item d-block d-lg-none">
                  <a class="nav-link nav-icon search-bar-toggle " href="#">
                      <i class="bi bi-search"></i>
                  </a>
              </li>
              <!-- End Search Icon-->

              <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <div class="p-1"> 
                        <div class="rounded-circle border d-flex justify-content-center align-items-center"
                             style="width:40px;height:40px"
                          alt="Avatar">
                        <i class="fas fa-user-alt adminAvatar"></i>
                        </div>                      
                    </div>
                  </a>
                  <!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6 class="theme-color">{{ Auth::user()->name }}</h6>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin_profile') }}">
                              <i class="bi bi-person"></i>
                              <span class="theme-color">My Profile</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ url('admin-panel/logout') }}">
                              <i class="bi bi-box-arrow-right"></i>
                              <span class="theme-color">Sign Out</span>
                          </a>
                      </li>
                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav>
      <!-- End Icons Navigation -->

  </header><!-- End Header -->

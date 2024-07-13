      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
        <!-- Sidebar -->
        <div class="sidebar">
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item ">
                <a href="/dashboard" class="nav-link {{ ($title == "Dashboard") ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dataset" class="nav-link {{ ($title == "Dataset") ? 'active' : '' }}">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Dataset
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/naivebayes" class="nav-link {{ ($title == "Naive Bayes") ? 'active' : '' }}">
                  <i class="nav-icon fas fa-hourglass-start"></i>
                  <p>
                    Naive Bayes
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link">
                  <i class="nav-icon fas fa-arrow-right"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->      
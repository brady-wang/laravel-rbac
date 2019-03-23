<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/"><i class="fa fa-link"></i> <span>主页</span></a></li>
            <li class="treeview">
                <a href=""><i class="fa fa-link"></i> <span>用户管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/users') }}">用户列表</a></li>
                    <li><a href="{{ url('admin/user/add') }}">用户新增</a></li>
                </ul>
            </li>


            <li class="treeview menu-open">
                <a href="javascript:void(0);"><i class="fa fa-link"></i> <span>角色管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li ><a href="{{ url('admin/roles') }}">角色列表</a></li>
                    <li><a href="{{ url('admin/role/add') }}">角色新增</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0);"><i class="fa fa-link"></i> <span>权限管理</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/accesses') }}">权限列表</a></li>
                    <li><a href="{{ url('admin/access/add') }}">权限新增</a></li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
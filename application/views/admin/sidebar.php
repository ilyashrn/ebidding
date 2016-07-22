<!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li class="nav-item start <?php echo ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'main') ? 'active': '';?>">
                            <a href="<?php echo base_url().'admin/' ?>" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Users manager</h3>
                        </li>
                        <li class="nav-item  <?php echo ($this->uri->segment(2) == 'administrators') ? 'active' : ''; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Administrators</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php echo ($this->uri->segment(2) == 'administrators' && $this->uri->segment(3) == '') ? 'active open' : '' ?>">
                                    <a href="<?php echo base_url().'admin/administrators/' ?>" class="nav-link ">
                                        <span class="title">Administrators list</span>
                                        
                                    </a>
                                </li>
                                <li class="nav-item <?php echo ($this->uri->segment(2) == 'administrators' && $this->uri->segment(3) == 'add_new') ? 'active open' : '' ?> ">
                                    <a href="<?php echo base_url().'admin/administrators/add_new' ?>" class="nav-link ">
                                        <span class="title">Add new</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php echo ($this->uri->segment(2) == 'members') ? 'active' : '' ?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Members</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  <?php echo ($this->uri->segment(2) == 'members' && $this->uri->segment(3) == '') ? 'active open' : '' ?>">
                                    <a href="<?php echo base_url().'admin/members' ?>" class="nav-link ">
                                        <span class="title">Members list</span>
                                        
                                    </a>
                                </li>
                                <li class="nav-item  <?php echo ($this->uri->segment(2) == 'members' && $this->uri->segment(3) == 'add_new') ? 'active open' : '' ?>">
                                    <a href="<?php echo base_url().'admin/members/add_new' ?>" class="nav-link ">
                                        <span class="title">Add new</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Posts manager</h3>
                        </li>
                        <li class="nav-item  <?php echo ($this->uri->segment(2) == 'auctions') ? 'active open': '' ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-grid"></i>
                                <span class="title">Auction</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php echo ($this->uri->segment(2) == 'auctions') ? 'active open': '' ?> ">
                                    <a href="<?php echo base_url().'admin/auctions/' ?>" class="nav-link ">
                                        <span class="title">Auction list</span>
                                        
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  <?php echo ($this->uri->segment(2) == 'categories') ? 'active open': '' ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-tag"></i>
                                <span class="title">Categories</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?php echo base_url().'admin/categories/' ?>" class="nav-link ">
                                        <span class="title">Category manager</span>
                                        
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
        
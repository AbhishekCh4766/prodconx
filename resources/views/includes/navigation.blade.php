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
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 0px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <!-- <li class="sidebar-search-wrapper">
                            BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <!--<form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>-->
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        <!--</li> -->
                        <li class="nav-item start open dashboard">
                            <a href="{{ URL::to('/dashboard')}}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>

						<li class="nav-item usersList">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Users</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu inner-setting">
								<li class="nav-item start open " >
									<a href="{{ URL::to('/usersList')}}" class="nav-link nav-toggle">
										<span class="title">User List</span>
										<span class="selected"></span>
										
									</a>
								</li>
                                <li class="nav-item open ">
                                    <a href="{{ URL::to('/usersType')}}" class="nav-link ">
                                        <span class="title">User Type</span>
                                    </a>
                                </li>									
                            </ul>
                        </li>


						
                        <li class="nav-item start open Gender">
                            <a href="{{ URL::to('/Gender')}}" class="nav-link nav-toggle">
                                <i class="icon-social-dribbble"></i>
                                <span class="title">Gender</span>
                                <span class="selected"></span>
                            </a>
                        </li>	
                        <li class="nav-item start open contents">
                            <a href="{{ URL::to('/contents')}}" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Content</span>
                                <span class="selected"></span>
                                
                            </a>
                        </li>						
                        <li class="nav-item start open emailTemplates">
                            <a href="{{ URL::to('/emailTemplates')}}" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                <span class="title">Email Templates</span>
                                <span class="selected"></span>
                                
                            </a>
                        </li>	
	

                        <li class="nav-item start open membership">
                            <a href="{{ URL::to('/membership')}}" class="nav-link nav-toggle">
                                <i class="icon-briefcase"></i>
                                <span class="title">Membership</span>
                                <span class="selected"></span>
                                
                            </a>
                        </li>	
                        <li class="nav-item start open order">
                            <a href="{{ URL::to('/order')}}" class="nav-link nav-toggle">
                                <i class="icon-basket"></i>
                                <span class="title">Order</span>
                                <span class="selected"></span>
                                
                            </a>
                        </li>
                        <li class="nav-item start open role">
                            <a href="{{ URL::to('/role')}}" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Role</span>
                                <span class="selected"></span>
                                
                            </a>
                        </li>	
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-bank"></i>
                                <span class="title">Department</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu inner-setting">
								<li class="nav-item start open department">
									<a href="{{ URL::to('/department')}}" class="nav-link nav-toggle">
										<span class="title">Departments</span>
										
									</a>
								</li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/departmentRoles')}}" class="nav-link ">
                                        <span class="title">Department Roles</span>
                                    </a>
                                </li>						
                            </ul>
                        </li>

						
						<li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-file-text"></i>
                                <span class="title">Job</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu inner-setting">
								<li class="nav-item start open department">
									<a href="{{ URL::to('/jobCategory')}}" class="nav-link nav-toggle">
										<span class="title">Job Category</span>
										
									</a>
								</li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/joblisting')}}" class="nav-link ">
                                        <span class="title">Job Listing</span>
                                    </a>
                                </li>									
                            </ul>
                        </li>
						<li class="nav-item  my-setting">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Settings</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu inner-setting">
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/Settings')}}" class="nav-link ">
                                        <span class="title">General Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/imageSettings')}}" class="nav-link ">
                                        <span class="title">Image Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/mailSettings')}}" class="nav-link ">
                                        <span class="title">Mail Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ URL::to('/socialSettings')}}" class="nav-link ">
                                        <span class="title">Social Settings</span>
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
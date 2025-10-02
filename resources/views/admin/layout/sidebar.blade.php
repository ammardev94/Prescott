<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center border bg-white rounded p-2 mb-3">
                        <span class="avatar avatar-xl me-2 avatar-rounded">
                            <img src="{{ asset('storage/' . (optional(auth()->guard('admin')->user())->img ?? 'users/default.jpg')) }}" alt="img">
                        </span>
                        <span class="text-dark ms-2 fw-normal">Welcome <br> {{ auth()->guard('admin')->user()->name }}</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr"><span>Main</span></h6>
                    <ul>
                        <li class="@if(request()->path() == 'admin') active @endif">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr"><span>MENU</span></h6>
                    <ul>

                        <li class="@if(request()->path() == 'admin/cms/pages') active @endif">
                            <a href="{{ route('cms.page.index') }}">
                                <i class="ti ti-page-break"></i>
                                <span>CMS</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/news') active @endif">
                            <a href="{{ route('admin.news.index') }}">
                                <i class="ti ti-users-group"></i>
                                <span>News</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/teams') active @endif">
                            <a href="{{ route('admin.teams.index') }}">
                                <i class="ti ti-users-group"></i>
                                <span>Teams</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/projects') active @endif">
                            <a href="{{ route('admin.project.index') }}">
                                <i class="ti ti-users-group"></i>
                                <span>Projects</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/seo-scripts/1/edit') active @endif">
                            <a href="{{ route('admin.seo-scripts.edit', [1]) }}">
                                <i class="ti ti-building-skyscraper"></i>
                                <span>Seo Scripts</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/seo-pages') active @endif">
                            <a href="{{ route('admin.seo_pages.index') }}">
                                <i class="ti ti-building-skyscraper"></i>
                                <span>Seo Pages</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/careers') active @endif">
                            <a href="{{ route('admin.careers.index') }}">
                                <i class="ti ti-building-skyscraper"></i>
                                <span>Careers</span>
                            </a>
                        </li>

                        <li class="@if(request()->path() == 'admin/contacts') active @endif">
                            <a href="{{ route('admin.contacts.index') }}">
                                <i class="ti ti-building-skyscraper"></i>
                                <span>Contacts</span>
                            </a>
                        </li>


                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
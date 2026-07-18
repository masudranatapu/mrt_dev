<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:;">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:;">
                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                </a>
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link" href="{{ route('frontend.index') }}" target="__blank">
                    <i class="icon-base bx bx-globe-alt icon-md"></i>
                </a>
            </li>
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:;" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-globe icon-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item {{ Session::get('lang') == 'ar' ? 'active' : '' }}"
                            href="{{ route('admin.others.set.lang', 'ar') }}">
                            <span>{{ __('Arabic') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Session::get('lang') == 'bn' ? 'active' : '' }}"
                            href="{{ route('admin.others.set.lang', 'bn') }}">
                            <span>{{ __('Bengali') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Session::get('lang') == 'en' ? 'active' : '' }}"
                            href="{{ route('admin.others.set.lang', 'en') }}">
                            <span>{{ __('English') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:;"
                    data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-sun icon-md theme-icon-active"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                    <li>
                        <button type="button"
                            class="dropdown-item align-items-center {{ $settingInfo->theme_mood == 'light' ? 'active' : '' }}"
                            onclick="changeThemeMood('{{ route('admin.setting.theme.mood') }}', 'light')">
                            <span>
                                <i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>
                                {{ __('Light') }}
                            </span>
                        </button>
                    </li>
                    <li>
                        <button type="button"
                            class="dropdown-item align-items-center {{ $settingInfo->theme_mood == 'dark' ? 'active' : '' }}"
                            onclick="changeThemeMood('{{ route('admin.setting.theme.mood') }}', 'dark')">
                            <span>
                                <i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>
                                {{ __('Dark') }}
                            </span>
                        </button>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:;" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="icon-base bx bx-grid-alt icon-md"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">
                                {{ __('Add Shortcuts') }}
                            </h6>
                        </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-calendar icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">{{ __('Products') }}</a>
                                <small>{{ __('Add Product') }}</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-food-menu icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">
                                    {{ __('Category') }}
                                </a>
                                <small>{{ __('Create Category') }}</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-user icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">{{ __('Staff') }}</a>
                                <small>{{ __('Create Staff') }}</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-check-shield icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">
                                    {{ __('Role & Permission') }}
                                </a>
                                <small>{{ __('Role Create') }}</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-pie-chart-alt-2 icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">
                                    {{ __('Credential') }}
                                </a>
                                <small>{{ __('Update Credential') }}</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-cog icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">
                                    {{ __('Setting') }}
                                </a>
                                <small>{{ __('Website Settings') }}</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-help-circle icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">{{ __('Brands') }}</a>
                                <small>{{ __('Create Brands') }}</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                    <i class="icon-base bx bx-window-open icon-26px text-heading"></i>
                                </span>
                                <a href="" class="stretched-link">{{ __('Stock') }}</a>
                                <small>{{ __('Show Stock') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:;" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                        <i class="icon-base bx bx-bell icon-md"></i>
                        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Notification</h6>
                            <div class="d-flex align-items-center h6 mb-0">
                                <span class="badge bg-label-primary me-2">8 New</span>
                                <a href="javascript:;" class="dropdown-notifications-all p-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read">
                                    <i class="icon-base bx bx-envelope-open text-heading"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="avatar">
                                            <img src="{{ asset('backend') }}/img/avatars/1.png" alt
                                                class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="">
                                        <h6 class="small mb-0">Congratulation Lettie</h6>
                                        <small class="mb-1 d-block text-body">
                                            Won the monthly best seller gold badge
                                        </small>
                                        <small class="text-body-secondary">1h ago</small>
                                    </div>
                                    <div class="dropdown-notifications-actions">
                                        <a href="javascript:;" class="dropdown-notifications-read">
                                            <span class="badge badge-dot"></span>
                                        </a>
                                        <a href="javascript:;" class="dropdown-notifications-archive">
                                            <span class="icon-base bx bx-x"></span>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <h6 class="small mb-0">Charles Franklin</h6>
                                        <small class="mb-1 d-block text-body">
                                            Accepted your connection
                                        </small>
                                        <small class="text-body-secondary">12hr ago</small>
                                    </div>
                                    <div class="dropdown-notifications-actions">
                                        <a href="javascript:;" class="dropdown-notifications-read">
                                            <span class="badge badge-dot"></span>
                                        </a>
                                        <a href="javascript:;" class="dropdown-notifications-archive">
                                            <span class="icon-base bx bx-x"></span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="border-top">
                        <div class="d-grid p-4">
                            <a class="btn btn-primary btn-sm d-flex" href="">
                                <small class="align-middle">
                                    View all notifications
                                </small>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript;;" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ imageDemoUserPath(authAdmin()->avatar) }}" class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ imageDemoUserPath(authAdmin()->avatar) }}"
                                            class="w-px-40 rounded-circle" />
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">
                                        {{ authAdmin()->first_name . ' ' . authAdmin()->last_name }}
                                    </h6>
                                    <small class="text-body-secondary">
                                        Admin
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                        <a class="dropdown-item {{ Route::is('admin.profile.index') || Route::is('admin.profile.edit') || Route::is('admin.profile.setting') ? 'active' : '' }}"
                            href="{{ route('admin.profile.index') }}">
                            <i class="icon-base bx bx-user icon-md me-3"></i>
                            <span>{{ __('My Profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:;"
                            onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                            <i class="icon-base bx bx-power-off icon-md me-3"></i>
                            <span>{{ __('Log Out') }}</span>
                        </a>
                        <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<script>
    function changeThemeMood(urlRoute, theme_mood) {
        $.ajax({
            url: urlRoute,
            type: 'POST',
            data: {
                theme_mood: theme_mood,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('html').attr('data-bs-theme', theme_mood);
                $('.dropdown-item').removeClass('active');
                $('.dropdown-item[onclick*="' + theme_mood + '"]').addClass('active');
            },
        });
    }
</script>

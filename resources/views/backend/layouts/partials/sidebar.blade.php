<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img alt="image" src="{{ asset($settingInfo->site_logo) }}"
                        class="{{ $settingInfo->site_title }}" />
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">
                {{ $settingInfo->site_title }}
            </span>
        </a>
        <a href="javascript:;" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base bx bx-chevron-left"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-header small">
            <span class="menu-header-text">
                {{ __('Dashboard & Overview') }}
            </span>
        </li>

        <li class="menu-item {{ Route::is('admin.dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-home-smile"></i>
                <div>{{ __('Dashboard') }}</div>
            </a>
        </li>

        <li
            class="menu-item {{ Route::is('admin.lead-status.index') || Route::is('admin.project-status.index') || Route::is('admin.customer-status.index') || Route::is('admin.priority.index') || Route::is('admin.support-ticket-status.index') ? 'active open' : '' }}">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon icon-base bx bxl-product-hunt"></i>
                <div>{{ __('Projects') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.project-status.index') }}" class="menu-link">
                        {{ __('Project Status') }}
                    </a>
                </li>
                <li class="menu-item ">
                    <a href="" class="menu-link">
                        {{ __('Project') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text">
                {{ __('System & Settings') }}
            </span>
        </li>
        <li
            class="menu-item {{ Route::is('admin.setting.index') || Route::is('admin.setting.credential') || Route::is('admin.system.details') ? 'active open' : '' }}">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>{{ __('System') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('admin.setting.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.index') }}" class="menu-link">
                        {{ __('Setting') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.setting.credential') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.credential') }}" class="menu-link">
                        {{ __('Credential') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.system.details') ? 'active' : '' }}">
                    <a href="{{ route('admin.system.details') }}" class="menu-link">
                        {{ __('Application Details') }}
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.system.cache.clear') }}" class="menu-link">
                        {{ __('Cache Clear') }}
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ Route::is('admin.services.index') || Route::is('admin.blogs.*') || Route::is('admin.team.index') || Route::is('admin.faqs.index') || Route::is('admin.founder.index') || Route::is('admin.page-seo.index') || Route::is('admin.setting.privacy.terms') || Route::is('admin.contact-us.index') || Route::is('admin.subscribers.index') ? 'active open' : '' }}">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class='menu-icon bx bx-world'></i>
                <div>{{ __('Website Manage') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('admin.services.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}" class="menu-link">
                        {{ __('Services') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.blogs.*') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Blogs') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.faqs.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('FAQs') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.team.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Teams') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.page-seo.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Page SEO Settings') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.setting.privacy.terms') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Privacy & Terms') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.contact-us.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Contact List') }}
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.subscribers.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        {{ __('Subscribers') }}
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ Route::is('admin.activity-log.index') || Route::is('admin.timesheet-log.index') ? 'active open' : '' }}">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class='menu-icon icon-base bx bx-file'></i>
                <div>
                    {{ __('Activity Logs') }}
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('admin.activity-log.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        <div>
                            {{ __('Activity Log') }}
                        </div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admin.timesheet-log.index') ? 'active' : '' }}">
                    <a href="" class="menu-link">
                        <div>
                            {{ __('Login Timesheet') }}
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

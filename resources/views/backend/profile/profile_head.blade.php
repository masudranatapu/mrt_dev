<div class="row">
    <div class="col-12">
        <div class="card mb-6">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4">
                    <img src="{{ imageDemoUserPath(authAdmin()->avatar) }}" alt="user-avatar"
                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <h4>
                            {{ authAdmin()->first_name . ' ' . authAdmin()->last_name }}
                            @if (authAdmin()->is_email_verified == 'Yes' || authAdmin()->is_email_verified == 'Yes')
                                <i class='menu-icon icon-base bx bx-check-shield text-success'></i>
                            @else
                                <i class='menu-icon icon-base bx bxs-user-x text-danger'></i>
                            @endif
                        </h4>
                        <p>
                            {{ authAdmin()->bio }}
                        </p>
                        <div>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                <li class="list-inline-item">
                                    <i
                                        class="menu-icon icon-base bx bx-check-shield @if (authAdmin()->is_email_verified == 'Yes' || authAdmin()->is_email_verified == 'Yes') text-success @endif"></i>
                                    <span class="fw-medium">
                                        {{ authAdmin()->user_type }}
                                    </span>
                                </li>
                                <li class="list-inline-item">
                                    <i class="icon-base bx bx-calendar me-2 align-top"></i>
                                    <span class="fw-medium">
                                        {{ authAdmin()->join_date }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-sm-0 gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.profile.index') ? 'active' : '' }}"
                        href="{{ route('admin.profile.index') }}">
                        <i class="icon-base bx bx-user icon-sm me-1_5"></i>
                        Profile Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}"
                        href="{{ route('admin.profile.edit') }}">
                        <i class="icon-base bx bx-group icon-sm me-1_5"></i>
                        Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.profile.setting') ? 'active' : '' }}"
                        href="{{ route('admin.profile.setting') }}">
                        <i class="icon-base bx bx-grid-alt icon-sm me-1_5"></i>
                        Profile Setting
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

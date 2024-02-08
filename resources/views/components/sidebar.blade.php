<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo"
                src="{{ isset($setting->logo_default) ? asset('storage/' . $setting->logo_default) : asset('assets/images/logo-sahabat-jepang-indonesia.jpg') }}"
                class="h-60px ms-15 app-sidebar-logo-default" />
            <img alt="Logo"
                src="{{ isset($setting->logo_square) ? asset('storage/' . $setting->logo_square) : asset('assets/images/logo-sahabat-jepang-indonesia.jpg') }}"
                class="h-30px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('admin.kategori-test') ? 'active' : '' }}"
                        href="{{ route('admin.kategori-test') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </span>
                        <span class="menu-title">Kategori Test</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('admin.kategori') ? 'active' : '' }}"
                        href="{{ route('admin.kategori') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </span>
                        <span class="menu-title">Kategori Soal</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['PaketSoal*', 'SoalUjian*', 'ReadingUjian*']) ? 'show' : '' }}">
                    <span class="menu-link {{ request()->is(['PaketSoal*','SoalUjian*', 'ReadingUjian*']) ? 'active' : '' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                                    </svg>
                            </span>
                        </span>
                        <span class="menu-title">Ujian</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.paket-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.paket-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Paket Soal</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.ujian-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.ujian-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Soal Ujian</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.reading-ujian*') ? 'active' : '' }}"
                                href="{{ route('admin.reading-ujian') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Reading Content</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['LatihanSoal*', 'ReadingLatihanSoal*', 'PaketLatihanSoal*']) ? 'show' : '' }}">
                    <span class="menu-link {{ request()->is(['LatihanSoal*', 'ReadingLatihanSoal*', 'PaketLatihanSoal*']) ? 'active' : '' }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                                    </svg>
                            </span>
                        </span>
                        <span class="menu-title">Latihan Soal</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.paket-soal-latihan-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.paket-soal-latihan-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Paket Soal</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.latihan-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.latihan-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Soal</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.reading-latihan-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.reading-latihan-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Reading Content</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('changePassword') ? 'active' : '' }}"
                        href="{{ route('changePassword') }}">
                        <span class="menu-icon">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512"><path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
                            </span>
                        </span>
                        <span class="menu-title">Change Password</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
            @csrf
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click">
                <span class="btn-label">Logout</span>
                <span class="svg-icon btn-icon svg-icon-2 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 12h-9.5m7.5 3l3-3l-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
                    </svg>
                </span>
            </a>
        </form>
    </div>
</div>

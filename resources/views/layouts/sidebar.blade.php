<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand demo">
    <a href="/" class="app-brand-link">
        <img
        src="{{ asset('style/assets/img/logo/logo-mini.png') }}"
        alt="auth-login-cover"
        />
        <span class="app-brand-text demo menu-text fw-bold">Excellent</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
    <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
    <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>

@if (Auth::user()->role_id==1)
<!--MENU LOGIN : Sales-->
<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ ($title === "Dashboard Sales") ? 'active' : '' }}">
        <a href="/" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i>
            Dashboard
        </a>
    </li>

    <!-- Customer -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Sales & Customer</span>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ti ti-users"></i>
            Database Customer
        </a>
    </li>
    <li class="menu-item {{ ($title === "Cold Call Sales") || ($title === "Form Tambah Customer Cold Call") || ($title === "Warm Call Sales")
    || ($title === "Form Tambah Customer Warm Call") || ($title === "Lead Generated Sales")
    || ($title === "Form Tambah Customer Lead Generated") || ($title === "Sales Closing")
    || ($title === "Form Tambah Customer Sales Closing") ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-phone-call"></i>
            Customer Call
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ ($title === "Cold Call Sales") || ($title === "Form Tambah Customer Cold Call") ? 'active' : '' }}">
                <a href="/sales/cold-call" class="menu-link">
                    Cold Call
                </a>
            </li>
            <li class="menu-item {{ ($title === "Warm Call Sales") || ($title === "Form Tambah Customer Warm Call") ? 'active' : '' }}">
                <a href="/sales/warm-call" class="menu-link">
                    Warm Call
                </a>
            </li>
            <li class="menu-item {{ ($title === "Lead Generated Sales") || ($title === "Form Tambah Customer Lead Generated") ? 'active' : '' }}">
                <a href="/sales/lead-generated" class="menu-link">
                    Lead Generated
                </a>
            </li>
            <li class="menu-item {{ ($title === "Sales Closing") || ($title === "Form Tambah Customer Sales Closing") ? 'active' : '' }}">
                <a href="/sales/sales-closing" class="menu-link">
                    Sales Closing
                </a>
            </li>
        </ul>
    </li>

    <!-- Report -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Report</span>
    </li>
    <li class="menu-item {{ ($title === "Laporan Sales Pekanan") || ($title === "Laporan Sales Bulanan") || ($title === "Laporan Sales Tahunan") ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-file-report"></i>
            Laporan Sales
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ ($title === "Laporan Sales Pekanan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-pekanan" class="menu-link">
                    Pekanan
                </a>
            </li>
            <li class="menu-item {{ ($title === "Laporan Sales Bulanan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-bulanan" class="menu-link">
                    Bulanan
                </a>
            </li>
            <li class="menu-item {{ ($title === "Laporan Sales Tahunan") ? 'active' : '' }}">
                <a href="/sales/laporan-sales-tahunan" class="menu-link">
                    Tahunan
                </a>
            </li>
        </ul>
    </li>
</ul>
@endif
</aside>

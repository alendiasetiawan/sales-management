<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
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

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ ($title === "Dashboard Sales Manager") ? 'active' : '' }}">
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
                    <a href="/salesmanager/laporan-sales-pekanan" class="menu-link">
                        Pekanan
                    </a>
                </li>
                <li class="menu-item {{ ($title === "Laporan Sales Bulanan") ? 'active' : '' }}">
                    <a href="/salesmanager/laporan-sales-bulanan" class="menu-link">
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
</aside>

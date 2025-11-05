<nav class="navbar-modern">
    <div class="container-fluid">
        <!-- Mobile menu toggle -->
        <button class="btn btn-outline-light d-lg-none me-3 mobile-toggle" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar-modern">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand/Title for mobile -->
        <div class="d-flex align-items-center d-lg-none">
            <div class="logo-circle bg-gradient-primary text-white me-2">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="navbar-brand-mobile fw-bold text-white">Course System</span>
        </div>

        <!-- Desktop spacer -->
        <div class="flex-grow-1 d-none d-lg-block"></div>

        <!-- Right side content -->
        <div class="d-flex align-items-center">

            <!-- Notifications -->
            <button class="btn btn-outline-light me-3 position-relative notification-btn" type="button">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge">
                    3
                    <span class="visually-hidden">unread notifications</span>
                </span>
            </button>

            <!-- User dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle user-btn d-flex align-items-center" id="profileBtn">
                    <div class="avatar-circle bg-gradient-info text-white me-2">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="d-none d-md-block text-start">
                        <div class="fw-bold text-white small">{{ auth()->user()->name }}</div>
                        <small class="text-light opacity-75">{{ ucfirst(auth()->user()->role) }}</small>
                    </div>
                    <i class="fas fa-chevron-down ms-2 text-light"></i>
                </button>

                <ul class="dropdown-menu-modern dropdown-menu-end shadow-lg">
                    <li class="px-3 py-3 border-bottom border-secondary">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle bg-gradient-info text-white me-3">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-white">{{ auth()->user()->name }}</div>
                                <small class="text-light">{{ auth()->user()->email }}</small>
                                <div class="badge bg-primary mt-1">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item-modern" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit me-3"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item-modern" href="#">
                            <i class="fas fa-cog me-3"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-secondary">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item-modern logout-item">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 1030;
}

.logo-circle {
    width: 35px; height: 35px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
}

.user-btn {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 8px 12px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    
}

.avatar-circle {
    width: 35px; height: 35px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

/* ---- DROPDOWN ORIGINAL LOOK RESTORED ---- */
.dropdown-menu-modern {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 12px;
    min-width: 280px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    backdrop-filter: blur(10px);
    display: none;
    padding: 0;
}

.dropdown.show .dropdown-menu-modern {
    display: block;
}

/* menu item */
.dropdown-item-modern {
    display: flex; align-items: center;
    padding: 12px 16px;
    color: rgba(255,255,255,0.85) !important;
    text-decoration: none;
    transition: .25s;
    border-radius: 8px;
    margin: 2px 8px;
}

.dropdown-item-modern:hover {
    background: rgba(255,255,255,0.1);
    color: #fff !important;
    transform: translateX(5px);
}

/* logout color */
.logout-item {
    color: #e74c3c !important;
}
.logout-item:hover {
    background: rgba(231, 76, 60, 0.12);
    color: #ff6b6b !important;
}
</style>

<script>
// toggle dropdown on click
const drop = document.querySelector('.dropdown');
document.getElementById('profileBtn').addEventListener('click', () => {
    drop.classList.toggle('show');
});

// close on outside click
document.addEventListener('click', e => {
    if (!drop.contains(e.target)) drop.classList.remove('show');
});
</script>

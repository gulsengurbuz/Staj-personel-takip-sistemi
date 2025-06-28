<?php
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<style>
.navbar-custom {
    background: linear-gradient(135deg,rgba(229, 229, 229, 0.65) 0%,rgba(199, 199, 199, 0.34) 100%);
    border-bottom: 3px solidrgb(105, 105, 105);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    padding: 0.5rem 0;
}

.navbar-brand-custom {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white !important;
}

.logo-container {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,rgb(1, 61, 113) 0%,rgb(0, 8, 121) 100%);
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
    transition: all 0.3s ease;
    margin-right: 12px;
}

.logo-container:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.5);
}

.logo-icon i {
    color: white;
    font-size: 22px;
    text-shadow: 0 2px 4px rgba(255, 249, 249, 0.4);
}

.logo-text {
    color: white;
    font-size: 18px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 1px;
}

.logo-subtitle {
    color: rgba(255,255,255,0.9);
    font-size: 11px;
    font-weight: 400;
    margin-top: -2px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.admin-btn {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    border: none;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
}

.admin-btn:hover {
    background: linear-gradient(135deg, #ff5252 0%, #d63031 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    color: white;
    text-decoration: none;
}

.sidebar-toggle {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.sidebar-toggle:hover {
    background: rgba(255,255,255,0.3);
    color: white;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


<nav class="navbar navbar-expand-lg fixed-top navbar-custom">
    <div class="container-fluid">
        <button class="sidebar-toggle d-lg-none" type="button" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        
        <a class="navbar-brand-custom" href="/">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
            </div>
            <div class="d-flex flex-column">
                <span class="logo-text">PTS</span>
                <span class="logo-subtitle">Personel Takip Sistemi</span>
            </div>
        </a>
        
        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
               <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" style="color: #1f4ed8; border-color: #1f4ed8;">
    <i class="fas fa-user"></i> Admin
</button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Ayarlar</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="login.php"><i class="fas fa-sign-out-alt me-2"></i>Çıkış</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('show-mobile');
}
</script>
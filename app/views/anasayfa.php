<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Personel Takip Sistemi - Ana Sayfa</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
   <style>
    body {
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  min-height: 100vh;
  padding-top: 70px;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.main-content {
  margin-left: 0px;
  padding: 30px;
  transition: margin-left 0.3s ease;
}

.main-content.full-width {
  margin-left: 70px;
}

.dashboard-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  padding: 25px;
  margin-bottom: 25px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.dashboard-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.stat-card {
  background: linear-gradient(135deg, #1f4ed8 0%, #4f81ff 100%);
  color: white;
  border-radius: 15px;
  padding: 20px;
  text-align: center;
  transition: all 0.3s ease;
  border: none;
}

.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(31, 78, 216, 0.3);
}

.stat-card.success {
  background: linear-gradient(135deg, rgba(40, 167, 70, 0.81) 0%, #20c997 100%);
}

.stat-card.warning {
  background: linear-gradient(135deg, rgba(255, 193, 7, 0.72) 0%, #fd7e14 100%);
}

.stat-card.danger {
  background: linear-gradient(135deg, rgba(220, 53, 70, 0.7) 0%,rgb(232, 62, 62) 100%);
}

.stat-card.info {
  background: linear-gradient(135deg, rgba(23, 163, 184, 0.65) 0%, #6f42c1 100%);
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 5px;
}

.stat-label {
  font-size: 0.9rem;
  opacity: 0.9;
  font-weight: 500;
}

.stat-icon {
  font-size: 2rem;
  margin-bottom: 10px;
  opacity: 0.8;
}

.welcome-section {
  background: linear-gradient(135deg, rgba(0, 16, 85, 0.82) 0%, rgba(0, 5, 104, 0.83) 100%);
  color: white;
  border-radius: 20px;
  padding: 40px;
  margin-bottom: 30px;
  text-align: center;
}

.welcome-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 15px;
}

.welcome-subtitle {
  font-size: 1.1rem;
  opacity: 0.9;
}

.quick-actions {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-top: 30px;
}

.action-btn {
  background: white;
  border: none;
  border-radius: 15px;
  padding: 20px;
  text-align: center;
  transition: all 0.3s ease;
  text-decoration: none;
  color: #495057;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.action-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  color: rgb(255, 255, 255);
  background: linear-gradient(135deg, #1f4ed8 0%, #4f81ff 100%);
}

.action-btn i {
  font-size: 2rem;
  margin-bottom: 10px;
  color: rgb(255, 255, 255);
}

.recent-activities {
  max-height: 400px;
  overflow-y: auto;
}

.activity-item {
  display: flex;
  align-items: center;
  padding: 15px;
  border-bottom: 1px solid #e9ecef;
  transition: all 0.3s ease;
}

.activity-item:hover {
  background: #f8f9fa;
}

.activity-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
  color: white;
}

.activity-icon.success {
  background: rgba(40, 167, 70, 0.8);
}

.activity-icon.warning {
  background: rgba(255, 193, 7, 0.7);
}

.activity-icon.info {
  background: rgba(23, 163, 184, 0.65);
}

@media (max-width: 768px) {
  .main-content {
    margin-left: 0;
    padding: 15px;
  }

  .main-content.full-width {
    margin-left: 0;
  }

  .welcome-title {
    font-size: 2rem;
  }

  .stat-number {
    font-size: 2rem;
  }
}

   </style>
  </head>
  <body>
  <?php 
   include "../../public/php/navbar.php";
   $base_url = "https://orakoglu.net/gulsen/Personel_Takip_Sistemi/public/php/";
?>
  <?php 
   include "../../app/views/sidebar.php";
   $base_url = "https://orakoglu.net/gulsen/Personel_Takip_Sistemi/app/views/";
?>
   
 
   <div class="content">
     <div class="main-content" id="mainContent">
      <div class="welcome-section">
        <h1 class="welcome-title">
          <i class="fas fa-users-cog me-3"></i>
          Personel Takip Sistemi
        </h1>
        <p class="welcome-subtitle">
          Personel yönetimi, izin takibi ve maaş işlemlerinizi kolayca yönetin
        </p>
      </div>

      <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stat-card">
            <div class="stat-icon">
              <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">156</div>
            <div class="stat-label">Toplam Personel</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stat-card success">
            <div class="stat-icon">
              <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-number">142</div>
            <div class="stat-label">Aktif Personel</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stat-card warning">
            <div class="stat-icon">
              <i class="fas fa-calendar-times"></i>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">İzinli Personel</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stat-card danger">
            <div class="stat-icon">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">12</div>
            <div class="stat-label">Bekleyen Onay</div>
          </div>
        </div>
      </div>

      <div class="dashboard-card">
        <h4 class="mb-4">
          <i class="fas fa-bolt text-primary me-2"></i>
          Hızlı İşlemler
        </h4>
        <div class="quick-actions">
          <a href="personelEkle.php" class="action-btn">
            <i class="fas fa-user-plus"></i>
            <h6>Personel Ekle</h6>
            <small class="text-muted">Yeni personel kaydı</small>
          </a>
          <a href="izinyonetimipage.php" class="action-btn">
            <i class="fas fa-calendar-check"></i>
            <h6>İzin Onayı</h6>
            <small class="text-muted">İzin taleplerini onayla</small>
          </a>
          <a href="maas_odeme.php" class="action-btn">
            <i class="fas fa-money-bill-wave"></i>
            <h6>Maaş İşlemleri</h6>
            <small class="text-muted">Maaş ödemelerini yönet</small>
          </a>
          <a href="yoneticionay.php" class="action-btn">
            <i class="fas fa-chart-bar"></i>
            <h6>Yönetici Onay</h6>
            <small class="text-muted">talepleri yönet</small>
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="dashboard-card">
            <h4 class="mb-4">
              <i class="fas fa-history text-info me-2"></i>
              Son Aktiviteler
            </h4>
            <div class="recent-activities">
              <div class="activity-item">
                <div class="activity-icon success">
                  <i class="fas fa-check"></i>
                </div>
                <div>
                  <strong>Ahmet Yılmaz</strong> izin talebi onaylandı
                  <br /><small class="text-muted">2 saat önce</small>
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon info">
                  <i class="fas fa-user-plus"></i>
                </div>
                <div>
                  <strong>Ayşe Demir</strong> sisteme eklendi <br /><small
                    class="text-muted"
                    >4 saat önce</small
                  >
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon warning">
                  <i class="fas fa-clock"></i>
                </div>
                <div>
                  <strong>Mehmet Kaya</strong> izin talebi beklemede
                  <br /><small class="text-muted">6 saat önce</small>
                </div>
              </div>
              <div class="activity-item">
                <div class="activity-icon success">
                  <i class="fas fa-money-bill"></i>
                </div>
                <div>
                  <strong>Mayıs maaşları</strong> ödendi <br /><small
                    class="text-muted"
                    >1 gün önce</small
                  >
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="dashboard-card">
            <h4 class="mb-4">
              <i class="fas fa-server text-success me-2"></i>
              Sistem Durumu
            </h4>
            <div class="mb-3">
              <div
                class="d-flex justify-content-between align-items-center mb-2"
              >
                <span>Sunucu Durumu</span>
                <span class="badge bg-success">Çevrimiçi</span>
              </div>
              <div class="progress" style="height: 8px">
                <div class="progress-bar bg-success" style="width: 98%"></div>
              </div>
            </div>

            <div class="mb-3">
              <div
                class="d-flex justify-content-between align-items-center mb-2"
              >
                <span>Veritabanı</span>
                <span class="badge bg-success">Aktif</span>
              </div>
              <div class="progress" style="height: 8px">
                <div class="progress-bar bg-success" style="width: 95%"></div>
              </div>
            </div>

            <div class="mb-3">
              <div
                class="d-flex justify-content-between align-items-center mb-2"
              >
                <span>Disk Kullanımı</span>
                <span class="badge bg-warning">%67</span>
              </div>
              <div class="progress" style="height: 8px">
                <div class="progress-bar bg-warning" style="width: 67%"></div>
              </div>
            </div>
          </div>

          <div class="dashboard-card">
            <h5 class="mb-3">
              <i class="fas fa-bell text-warning me-2"></i>
              Bildirimler
            </h5>
            <div class="alert alert-warning alert-sm">
              <i class="fas fa-exclamation-triangle me-2"></i>
              12 izin talebi onay bekliyor
            </div>
            <div class="alert alert-info alert-sm">
              <i class="fas fa-info-circle me-2"></i>
              Sistem güncellemesi mevcut
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function adjustMainContent() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");

        if (sidebar.classList.contains("collapsed")) {
          mainContent.classList.add("full-width");
        } else {
          mainContent.classList.remove("full-width");
        }
      }

      document.addEventListener("DOMContentLoaded", function () {
        adjustMainContent();
      });
    </script>
  </body>
</html>

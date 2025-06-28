
<?php  
include "../Controllers/tokenYenileme.php";

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personel Takip Sistemi - Ayarlar</title>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    .card {
      margin-bottom: 1.5rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      border-radius: 0.5rem;
    }
    .card-header {
      background-color: rgba(0, 0, 0, 0.03);
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
      padding: 1rem 1.25rem;
    }
    .card-title {
      margin-bottom: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .card-body {
      padding: 1.25rem;
    }
    .badge-container {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 0.5rem;
    }
    .department-badge {
      display: flex;
      align-items: center;
      background-color: #f0f0f0;
      padding: 0.35rem 0.65rem;
      border-radius: 0.25rem;
      font-size: 0.875rem;
    }
    .department-badge .remove-btn {
      margin-left: 0.5rem;
      cursor: pointer;
      color: #dc3545;
      border: none;
      background: none;
      padding: 0;
      font-size: 0.75rem;
    }
    .nested-options {
      margin-left: 1.5rem;
      margin-top: 0.5rem;
    }
    .alert-success {
      background-color: #d1e7dd;
      border-color: #badbcc;
      color: #0f5132;
    }
    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c2c7;
      color: #842029;
    }
    .form-check-input:checked {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .btn-outline-secondary {
      color: #6c757d;
      border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
      color: #fff;
      background-color: #6c757d;
      border-color: #6c757d;
    }
  </style>
</head>
<body>
       
    <?php include 'sidebar.php'; ?>
 <div class="content">
 <div class="container py-4 max-w-4xl mx-auto">
    <div class="row mb-4">
      <div class="col">
        <h1 class="mb-2 d-flex align-items-center">
          <i class="fas fa-cog me-2"></i>
          Personel Takip Sistemi - Ayarlar
        </h1>
        <p class="text-muted">Sistem ayarlarını buradan yönetebilirsiniz</p>
      </div>
    </div>

   
    <div id="alertArea" class="mb-4" style="display: none;"></div>

  
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-building me-2"></i>
          Genel Sistem Bilgileri
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="companyName" class="form-label">Şirket Adı</label>
          <input type="text" class="form-control" id="companyName" value="ABC Şirketi">
        </div>
        <div class="mb-3">
          <label for="systemVersion" class="form-label">Sistem Versiyonu</label>
          <input type="text" class="form-control bg-light" id="systemVersion" value="v2.1.0" readonly>
        </div>
        <div class="mb-3">
          <label for="installationDate" class="form-label">Sistem Kurulum Tarihi</label>
          <input type="text" class="form-control bg-light" id="installationDate" value="2024-01-15" readonly>
        </div>
      </div>
    </div>

  
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-clock me-2"></i>
          Çalışma ve İzin Süreleri
        </h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="dailyWorkHours" class="form-label">Günlük Çalışma Saati</label>
            <input type="number" class="form-control" id="dailyWorkHours" value="8">
          </div>
          <div class="col-md-6 mb-3">
            <label for="annualLeave" class="form-label">Yıllık İzin Günü</label>
            <input type="number" class="form-control" id="annualLeave" value="14">
          </div>
          <div class="col-md-6 mb-3">
            <label for="sickLeave" class="form-label">Hastalık İzni (Gün)</label>
            <input type="number" class="form-control" id="sickLeave" value="15">
          </div>
          <div class="col-md-6 mb-3">
            <label for="maternityLeave" class="form-label">Doğum İzni (Gün)</label>
            <input type="number" class="form-control" id="maternityLeave" value="30">
          </div>
          <div class="col-md-6 mb-3">
            <label for="marriageLeave" class="form-label">Evlilik İzni (Gün)</label>
            <input type="number" class="form-control" id="marriageLeave" value="7">
          </div>
          <div class="col-md-6 mb-3">
            <label for="bereavementLeave" class="form-label">Ölüm İzni (Gün)</label>
            <input type="number" class="form-control" id="bereavementLeave" value="7">
          </div>
          <div class="col-md-6 mb-3">
            <label for="unpaidLeave" class="form-label">Ücretsiz İzin (Gün)</label>
            <input type="number" class="form-control" id="unpaidLeave" value="14">
          </div>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="autoApproveShortLeave" checked>
          <label class="form-check-label" for="autoApproveShortLeave">
            3 Günden Az İzinleri Otomatik Onayla
          </label>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-list me-2"></i>
          Sayfa Görüntüleme Ayarları
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="recordsPerPage" class="form-label">Sayfa Başına Kayıt Sayısı</label>
          <select class="form-select" id="recordsPerPage">
            <option value="10">10</option>
            <option value="25" selected>25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
    </div>

 
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-users me-2"></i>
          Departman Tanımları
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Mevcut Departmanlar</label>
          <div id="departmentBadges" class="badge-container">
           
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="newDepartment" placeholder="Yeni departman adı">
          <button class="btn btn-outline-secondary" type="button" id="addDepartmentBtn">
            <i class="fas fa-plus"></i> Ekle
          </button>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-shield-alt me-2"></i>
          Personel İşlemleri Yetkilendirme
        </h5>
      </div>
      <div class="card-body">
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="canAddEmployee" checked>
          <label class="form-check-label" for="canAddEmployee">
            Yeni Personel Ekleyebilir mi?
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="canUpdateEmployee" checked>
          <label class="form-check-label" for="canUpdateEmployee">
            Personel Bilgisi Güncelleyebilir mi?
          </label>
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="canRemoveEmployee">
          <label class="form-check-label" for="canRemoveEmployee">
            Personel Çıkışı Yapabilir mi?
          </label>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-money-bill-wave me-2"></i>
          Maaş Bilgisi Görüntüleme Yetkisi
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <select class="form-select" id="salaryViewPermission">
            <option value="admin" selected>Yalnızca Yönetici</option>
            <option value="staff-admin">Personel ve Yönetici</option>
            <option value="accounting">Muhasebe Departmanı</option>
          </select>
        </div>
      </div>
    </div>

 
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-bell me-2"></i>
          Bildirim Ayarları
        </h5>
      </div>
      <div class="card-body">
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
          <label class="form-check-label" for="emailNotifications">
            E-posta Bildirimleri Aktif
          </label>
        </div>
        <div id="emailNotificationOptions" class="nested-options">
          <div class="form-check mb-2">
            <input class="form-check-input email-notification-option" type="checkbox" id="newEmployeeNotification" checked>
            <label class="form-check-label" for="newEmployeeNotification">
              Yeni Personel Eklendiğinde
            </label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input email-notification-option" type="checkbox" id="salaryUpdateNotification" checked>
            <label class="form-check-label" for="salaryUpdateNotification">
              Maaş Güncellendiğinde
            </label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input email-notification-option" type="checkbox" id="leaveRequestNotification" checked>
            <label class="form-check-label" for="leaveRequestNotification">
              İzin Talebi Geldiğinde
            </label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input email-notification-option" type="checkbox" id="approvalNotification" checked>
            <label class="form-check-label" for="approvalNotification">
              Onay Gerektiren İşlem Olduğunda
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-calendar-alt me-2"></i>
          Tarih ve Saat Formatı
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="dateFormat" class="form-label">Tarih Formatı</label>
          <select class="form-select" id="dateFormat">
            <option value="DD.MM.YYYY" selected>GG.AA.YYYY</option>
            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="timeFormat" class="form-label">Saat Formatı</label>
          <select class="form-select" id="timeFormat">
            <option value="24h" selected>24 Saat</option>
            <option value="12h">12 Saat</option>
          </select>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-lock me-2"></i>
          Güvenlik Ayarları
        </h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="sessionTimeout" class="form-label">Maksimum Oturum Süresi (dakika)</label>
          <select class="form-select" id="sessionTimeout">
            <option value="15">15 dakika</option>
            <option value="30" selected>30 dakika</option>
            <option value="60">1 saat</option>
            <option value="120">2 saat</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="maxLoginAttempts" class="form-label">Maksimum Hatalı Giriş Denemesi</label>
          <input type="number" class="form-control" id="maxLoginAttempts" min="1" max="10" value="3">
        </div>
      </div>
    </div>

   
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">
          <i class="fas fa-database me-2"></i>
          Log ve Sistem Yedekleme
        </h5>
      </div>
      <div class="card-body">
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="loggingEnabled" checked>
          <label class="form-check-label" for="loggingEnabled">
            Log Kayıtları Aktif
          </label>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="autoBackup">
          <label class="form-check-label" for="autoBackup">
            Otomatik Yedekleme
          </label>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4 mb-5">
      <button type="button" class="btn btn-outline-secondary" id="resetButton">
        Varsayılana Sıfırla
      </button>
      <button type="button" class="btn btn-primary" id="saveButton">
        Ayarları Kaydet
      </button>
    </div>
  </div>
 </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
<script src="../../public/js/ayarlar.js"></script>
</body>
</html>
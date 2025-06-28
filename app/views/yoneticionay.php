"
<?php  
include "../Controllers/tokenYenileme.php";

?>

<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Personel Takip Sistemi - Destek ve İletişim</title>
  
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  <style>
  .tab-pane {
    padding-top: 1rem;
  }
  .tab-pane:not(.active) {
    display: none !important;
  }
</style>

  </head>
  <body>

    <?php include 'sidebar.php'; ?>

    

<div class="content mt-5" >

   <div class="container-fluid">

      <div class="row mb-4">
        <div class="col">
          <h1 class="h2 mb-2">Yönetici Onay Sayfası</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            
              <li class="breadcrumb-item active" aria-current="page">
                Onaylar
              </li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
          <div class="card border-0 bg-primary bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-25 p-3 me-3">
                  <i class="fas fa-calendar-alt text-primary fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">İzin Talepleri</h6>
                  <h3 class="mb-0 fw-bold"id="izinSayiBadge" >0</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
          <div class="card border-0 bg-success bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-25 p-3 me-3">
                  <i class="fas fa-receipt text-success fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1" >ödeme Talepleri</h6>
                  <h3 class="mb-0 fw-bold" deme Talepleri
                 class="badge bg-primary ms-1"  id="odemeSayiBadge">0</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
          <div class="card border-0 bg-warning bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-25 p-3 me-3">
                  <i class="fas fa-clock text-warning fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">personel Talepleri</h6>
                  <h3 class="mb-0 fw-bold" id="personelSayiBadge">3</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 bg-info bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-25 p-3 me-3">
                  <i class="fas fa-file-alt text-info fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Diğer Talepler</h6>
                  <h3 class="mb-0 fw-bold">2</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
      <div class="card-header bg-white">
  <ul class="nav nav-tabs card-header-tabs" id="onayTabs" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" id="izin-tab" data-bs-toggle="tab" data-bs-target="#izin" type="button" role="tab" aria-controls="izin" aria-selected="true">
        <i class="fas fa-calendar-alt me-2"></i>İzin Talepleri
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="harcama-tab" data-bs-toggle="tab" data-bs-target="#harcama" type="button" role="tab" aria-controls="harcama" aria-selected="false">
        <i class="fas fa-receipt me-2"></i>Ödeme Talepleri
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="personel-tab" data-bs-toggle="tab" data-bs-target="#personel" type="button" role="tab" aria-controls="personel" aria-selected="false">
        <i class="fas fa-clock me-2"></i>Personel İşlemleri
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="diger-tab" data-bs-toggle="tab" data-bs-target="#diger" type="button" role="tab" aria-controls="diger" aria-selected="false">
        <i class="fas fa-file-alt me-2"></i>Diğer Talepler
      </button>
    </li>
  </ul>
</div>
        

             <div class="card-body p-0">
          <div class="tab-content" id="onayTabsContent">
          
             <div
              class="tab-pane fade show active"
              id="izin"
              role="tabpanel"
              aria-labelledby="izin-tab"
            >
             <div
                  class="d-flex justify-content-between align-items-center mb-3"
                >
                  <h5 class="mb-0">Bekleyen İzin Talepleri</h5>
                  <div class="btn-group">
                    <button
                      type="button"
                      class="btn btn-sm btn-success"
                      id="topluOnaylaBtn"
                    >
                      <i class="fas fa-check me-1"></i> Seçilenleri Onayla
                    </button>
                    <button
                      type="button"
                      class="btn btn-sm btn-danger"
                      id="topluReddetBtn"
                    >
                      <i class="fas fa-times me-1"></i> Seçilenleri Reddet
                    </button>
                  </div>
                </div>
                <div class="table-responsive">
                   <table class="table table-hover align-middle">
            
                 <tbody id="izinTableBody">
             </tbody>
             </table>
</div>
</div>
</div>

 <div
              class="tab-pane fade"
              id="harcama"
              role="tabpanel"
              aria-labelledby="harcama-tab"
            > 
              <div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">Bekleyen Ödeme Talepleri</h5>
  <div class="btn-group">
    <button type="button" class="btn btn-sm btn-success" id="odemeTopluOnaylaBtn">
      <i class="fas fa-check me-1"></i> Seçilenleri Onayla
    </button>
    <button type="button" class="btn btn-sm btn-danger" id="odemeTopluReddetBtn">
      <i class="fas fa-times me-1"></i> Seçilenleri Reddet
    </button>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th><input type="checkbox" id="tumOdemeleriSec" /></th>
        <th>Personel</th>
        <th>Ödeme Türü</th>
        <th>Tutar</th>
        <th>Tarih</th>
        <th>Talep Tarihi</th>
        <th>Açıklama</th>
        <th class="text-end">İşlemler</th>
      </tr>
    </thead>
    <tbody id="odemeTableBody">

    </tbody>
  </table>
</div>


<div class="modal fade" id="odemeDetayModal" tabindex="-1" aria-labelledby="odemeDetayModalLabel-" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="odemeOnaylaModal" tabindex="-1" aria-labelledby="odemeOnaylaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="odemeOnaylaModalLabel">Ödeme Onayı</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        Seçilen ödeme işlemini <strong>onaylamak</strong> istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-success" id="modalOdemeOnaylaBtn">Onayla</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="odemeReddetModal" tabindex="-1" aria-labelledby="odemeReddetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="odemeReddetModalLabel">Ödeme Reddetme</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        Seçilen ödeme işlemini <strong>reddetmek</strong> istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-danger" id="modalOdemeReddetBtn">Reddet</button>
      </div>
    </div>
  </div>
</div>
</div>
<div
              class="tab-pane fade"
              id="personel"
              role="tabpanel"
              aria-labelledby="personel-tab"
            >
          
            <div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">Bekleyen Personel Talepleri</h5>
  <div class="btn-group">
    <button type="button" class="btn btn-sm btn-success" id="talepTopluOnaylaBtn">
      <i class="fas fa-check me-1"></i> Seçilenleri Onayla
    </button>
    <button type="button" class="btn btn-sm btn-danger" id="talepTopluReddetBtn">
      <i class="fas fa-times me-1"></i> Seçilenleri Reddet
    </button>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th><input type="checkbox" id="tumTalepleriSec" /></th>
        <th>Personel</th>
        <th>Talep Tipi</th>
        <th>Talep Tarihi</th>
        <th>Açıklama</th>
        <th>Oluşturulma</th>
        <th class="text-end">İşlemler</th>
      </tr>
    </thead>
    <tbody id="talepTableBody">
    
    </tbody>
  </table>
</div>

<div class="modal fade" id="talepDetayModal" tabindex="-1" aria-labelledby="talepDetayModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="talepOnaylaModal" tabindex="-1" aria-labelledby="talepOnaylaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="talepOnaylaModalLabel">Talep Onayı</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        Seçilen personel talebini <strong>onaylamak</strong> istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-success" id="modalTalepOnaylaBtn">Onayla</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="talepReddetModal" tabindex="-1" aria-labelledby="talepReddetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="talepReddetModalLabel">Talep Reddetme</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        Seçilen personel talebini <strong>reddetmek</strong> istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-danger" id="modalTalepReddetBtn">Reddet</button>
      </div>
    </div>
  </div>
</div>
          
   
          </div>
     

<div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">Bekleyen Diğer Talepler</h5>
  <div class="btn-group">
    <button type="button" class="btn btn-sm btn-success" id="digerTopluOnaylaBtn">
      <i class="fas fa-check me-1"></i> Seçilenleri Onayla
    </button>
    <button type="button" class="btn btn-sm btn-danger" id="digerTopluReddetBtn">
      <i class="fas fa-times me-1"></i> Seçilenleri Reddet
    </button>
  </div>
</div>
<div
              class="tab-pane fade"
              id="diger"
              role="tabpanel"
              aria-labelledby="diger-tab"
            >  
<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th><input type="checkbox" id="tumDigerTalepleriSec" /></th>
        <th>Personel</th>
        <th>Talep Türü</th>
        <th>Talep Tarihi</th>
        <th>Açıklama</th>
        <th>Belge</th>
        <th class="text-end">İşlemler</th>
      </tr>
    </thead>
    <tbody id="digerTaleplerTableBody">
    </tbody>
  </table>
</div>




</div>

 
        </div>
      </div>

     <div class="card border-0 shadow-sm mb-4">
  <div class="card-header bg-white py-3">
    <h5 class="mb-0">Son Onay İşlemleri</h5>
  </div>
  <div class="card-body p-0">
    <div class="list-group list-group-flush" id="sonOnayListesi">
    </div>
  </div>
  <div class="card-footer bg-white py-3 text-center">
    <a href="#" class="text-decoration-none">
      Tüm İşlemleri Görüntüle <i class="fas fa-arrow-right ms-1"></i>
    </a>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  fetch("../../app/Controllers/getSonOnaylar.php")
    .then((res) => res.json())
    .then((data) => {
      const liste = document.getElementById("sonOnayListesi");
      liste.innerHTML = "";

      data.forEach((item) => {
        const renk = item.durum === "Onaylandı" ? "success" : "danger";
        const ikon = item.durum === "Onaylandı" ? "check" : "times";
        const row = `
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <div
                  class="avatar me-3 bg-${renk} text-white rounded-circle text-center"
                  style="width: 40px; height: 40px; line-height: 40px"
                >
                  <i class="fas fa-${ikon}"></i>
                </div>
                <div>
                  <div class="fw-medium">
                    ${item.ad_soyad}'n ${item.talep_tipi} talebi ${item.durum.toLowerCase()} 
                  </div>
                  <div class="small text-muted">${item.sure}</div>
                </div>
              </div>
              <span class="badge bg-${renk}">${item.durum}</span>
            </div>
          </div>
        `;
        liste.insertAdjacentHTML("beforeend", row);
      });
    });
});
</script>

    </div>

    <div
      class="modal fade"
      id="izinDetayModal"
      tabindex="-1"
      aria-labelledby="izinDetayModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="izinDetayModalLabel">
              İzin Talebi Detayı
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 d-flex align-items-center">
              <div
                class="avatar me-3 bg-primary text-white rounded-circle text-center"
                style="
                  width: 50px;
                  height: 50px;
                  line-height: 50px;
                  font-size: 20px;
                "
              >
                AY
              </div>
              <div>
                <h5 class="mb-0">Ahmet Yılmaz</h5>
                <p class="text-muted mb-0">
                  Yazılım Geliştirici - Bilgi Teknolojileri
                </p>
              </div>
            </div>
            <div class="card bg-light mb-3">
              <div class="card-body">
                <h6 class="card-title">İzin Bilgileri</h6>
                <div class="row mb-2">
                  <div class="col-5 text-muted">İzin Türü:</div>
                  <div class="col-7 fw-medium">
                    <span class="badge bg-success">Yıllık İzin</span>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-5 text-muted">Başlangıç Tarihi:</div>
                  <div class="col-7 fw-medium">15.04.2025</div>
                </div>
                <div class="row mb-2">
                  <div class="col-5 text-muted">Bitiş Tarihi:</div>
                  <div class="col-7 fw-medium">20.04.2025</div>
                </div>
                <div class="row mb-2">
                  <div class="col-5 text-muted">Süre:</div>
                  <div class="col-7 fw-medium">6 gün</div>
                </div>
                <div class="row mb-2">
                  <div class="col-5 text-muted">Talep Tarihi:</div>
                  <div class="col-7 fw-medium">01.04.2025</div>
                </div>
                <div class="row mb-2">
                  <div class="col-5 text-muted">Kalan İzin Hakkı:</div>
                  <div class="col-7 fw-medium">14 gün</div>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <h6>İzin Nedeni</h6>
              <p>Aile tatili için yıllık izin kullanmak istiyorum.</p>
            </div>
            <div class="mb-3">
              <h6>Vekalet Edecek Kişi</h6>
              <p>Mustafa Demir (IT Müdürü)</p>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Kapat
            </button>
           
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="onaylaModal"
      tabindex="-1"
      aria-labelledby="onaylaModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="onaylaModalLabel">Talebi Onayla</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p>
              Ahmet Yılmaz'ın izin talebini onaylamak istediğinize emin misiniz?
            </p>
            <div class="mb-3">
            
              <textarea
                class="form-control"
                id="onayNotu"
                rows="3"
                placeholder="Onay ile ilgili not ekleyebilirsiniz..."
              ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              İptal
            </button>
           <button id="modalOnaylaBtn" type="button" class="btn btn-success">
  <i class="fas fa-check me-1"></i> Onayla
</button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="reddetModal"
      tabindex="-1"
      aria-labelledby="reddetModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reddetModalLabel">Talebi Reddet</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p>
              Ahmet Yılmaz'ın izin talebini reddetmek istediğinize emin misiniz?
            </p>
            <div class="mb-3">
             
              
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              İptal
            </button>
            <button id="modalReddetBtn" type="button" class="btn btn-danger">
  <i class="fas fa-times me-1"></i> Reddet
</button>
          </div>
        </div>
      </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/izinTaleplerionaySayfasi.js"></script>
    <script src="../../public/js/personelTalepSayisi.js"></script>
    <script src="../../public/js/getIzinTalepleri.js"></script>
    <script src="../../public/js/odemeTalepleriniListele.js"></script>
    <script src="../../public/js/personelTalepleriOnay.js"></script>
    <script src="../../public/js/digerTaleplerOnay.js"></script>
    <script src="../../public/js/sonOlaylarListeleme.js"></script>
    
  </body>
</html>
"
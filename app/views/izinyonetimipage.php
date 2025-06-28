
<?php  
include "../Controllers/tokenYenileme.php";

?>


<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>izin yönetim sayfası</title>
    <!-- Bootstrap 5 CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  
  </head>
  <body>

       
    <?php include 'sidebar.php'; ?>

    

<div class="content mt-5" >

  <div class="container-fluid py-4">
      <div class="row mb-4">
        <div class="col">
          <h1 class="fw-bold">İzin Yönetimi Sistemi</h1>
          <p class="text-muted">Tüm izin taleplerini görüntüleyin ve yönetin</p>
        </div>
        <div class="col-auto">
          <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#yeniizinalmaModalı"
          >
            <i class="fas fa-plus me-2"></i> Yeni İzin Talebi
          </button>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card border-0 bg-success bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-success bg-opacity-25 p-3 me-3">
                <i class="fas fa-check-circle text-success fa-2x"></i>
              </div>
              <div>
                <h6 class="text-muted mb-1">Onaylanmış İzinler</h6>
                <h3 class="mb-0 fw-bold" id="onaylandiSayisi">0</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card border-0 bg-danger bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-danger bg-opacity-25 p-3 me-3">
                <i class="fas fa-times-circle text-danger fa-2x"></i>
              </div>
              <div>
                <h6 class="text-muted mb-1">Reddedilmiş İzinler</h6>
                <h3 class="mb-0 fw-bold" id="reddedildiSayisi">0</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 bg-warning bg-opacity-10 h-100">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-warning bg-opacity-25 p-3 me-3">
                <i class="fas fa-clock text-warning fa-2x"></i>
              </div>
              <div>
                <h6 class="text-muted mb-1">Bekleyen İzinler</h6>
                <h3 class="mb-0 fw-bold" id="bekleyenSayisi">0</h3>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-4">
 
</div>


  
      <ul class="nav nav-tabs" id="izinyonetimiTablosu" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="gecis-dugmesi"
             data-bs-toggle="tab"
             data-bs-target="#bekleyenler"
            aria-controls="bekleyenler"
            type="button"
            role="tab"
            aria-controls="gecis"
            aria-selected="true"
          >
            <i class="fas fa-clock me-2 text-warning"></i>Bekleyen İzinler
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="onaylı-sekmesi"
            data-bs-toggle="tab"
            data-bs-target="#onaylanmıs"
            type="button"
            role="tab"
            aria-controls="onaylanan"
            aria-selected="false"
          >
            <i class="fas fa-check-circle me-2 text-success"></i>Onaylanmış
            İzinler
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="reddedilmemis-sekmesi"
            data-bs-toggle="tab"
            data-bs-target="#reddedilmistablo"
            type="button"
            role="tab"
            aria-controls="reddedilen"
            aria-selected="false"
          >
            <i class="fas fa-times-circle me-2 text-danger"></i>Reddedilmiş
            İzinler
          </button>
        </li>
      </ul>

      <div class="tab-content mt-4" id="izinyonetimiTablosuContent">
        <div
          class="tab-pane fade show active"
          id="bekleyenler"
          role="tabpanel"
          aria-labelledby="bekleyenler-sekmesi"
        >
          <div class="card">
            <div
              class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Bekleyen İzin Talepleri</h5>
              <div class="btn-group">
                <button
                  class="btn btn-sm btn-outline-primary"
                  id="secilenonaylıBtn"
                >
                  <i class="fas fa-check me-2"></i>Seçilenleri Onayla
                </button>
                <button
                  class="btn btn-sm btn-outline-danger"
                  id="secilenreddetBtn"
                >
                  <i class="fas fa-times me-2"></i>Seçilenleri Reddet
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                  <thead class="table-light">
                    <tr>
                      <th width="40">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="tümBekleyenleriSec"
                          />
                        </div>
                      </th>
                      <th>Personel</th>
                      <th>İzin Türü</th>
                      <th>Başlangıç</th>
                      <th>Bitiş</th>
                      <th>Süre</th>
                      <th>Talep Tarihi</th>
                      <th>Durum</th>
                      <th class="text-end">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody id="bekleyenTablosuBodyi">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

     
        <div
          class="tab-pane fade"
          id="onaylanmıs"
          role="tabpanel"
          aria-labelledby="onaylanmıs-tab"
        >
          <div class="card">
            <div class="card-header bg-white py-3">
              <h5 class="mb-0">Onaylanmış İzin Talepleri</h5>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Personel</th>
                      <th>İzin Türü</th>
                      <th>Başlangıç</th>
                      <th>Bitiş</th>
                      <th>Süre</th>
                      <th>Talep Tarihi</th>
                      <th>Onay Tarihi</th>
                      <th>Onaylayan</th>
                      <th class="text-end">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody id="onaylanmısTableBody">
                    <!-- Will be populated by JavaScript -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      
        <div
          class="tab-pane fade"
          id="reddedilmistablo""
          role="tabpanel"
          aria-labelledby="rejected-tab"
        >
          <div class="card">
            <div class="card-header bg-white py-3">
              <h5 class="mb-0">Reddedilmiş İzin Talepleri</h5>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Personel</th>
                      <th>İzin Türü</th>
                      <th>Başlangıç</th>
                      <th>Bitiş</th>
                      <th>Süre</th>
                      <th>Talep Tarihi</th>
                      <th>Red Tarihi</th>
                      <th>Reddeden</th>
                      <th>Red Nedeni</th>
                      <th class="text-end">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody id="reddedilmistabloBody">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
  class="modal fade"
  id="yeniizinalmaModalı"
  tabindex="-1"
  aria-labelledby="yeniİzinModalEtiketi"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="yeniİzinModalEtiketi">
          Yeni İzin Talebi
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>

      <div class="modal-body">
        <form id="yeniIzınFormu">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="personelSecimi" class="form-label">Personel</label>
              <select class="form-select" id="personelSecimi" required>
               
              </select>
            </div>
            <div class="col-md-6">
              <label for="izinTuruSecimi" class="form-label">İzin Türü</label>
              <select class="form-select" id="izinTuruSecimi" required>
                <option value="">Seçiniz</option>
                <option value="1">Yıllık İzin</option>
                <option value="2">Hastalık İzni</option>
                <option value="3">Doğum İzni</option>
                <option value="4">Evlilik İzni</option>
                <option value="5">Ölüm İzni</option>
                <option value="6">Ücretsiz İzin</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="baslangıcTarihi" class="form-label">Başlangıç Tarihi</label>
              <input type="date" class="form-control" id="baslangıcTarihi" required />
            </div>
            <div class="col-md-6">
              <label for="sonTarihi" class="form-label">Bitiş Tarihi</label>
              <input type="date" class="form-control" id="sonTarihi" required />
            </div>
          </div>

          <div class="mb-3">
            <label for="izinSebebi" class="form-label">İzin Nedeni</label>
            <textarea
              class="form-control"
              id="izinSebebi"
              rows="3"
              placeholder="İzin talebinizin nedenini açıklayın..."
              required
            ></textarea>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
        >
          İptal
        </button>
        <button type="button" class="btn btn-primary" id="izingondermeBtn">
          Talebi Gönder
        </button>
      </div>
    </div>
  </div>
</div>


   
    <div
      class="modal fade"
      id="izinDetayModalı"
      tabindex="-1"
      aria-labelledby="izinDetayModalıLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="izinDetayModalıLabel">
              İzin Detayları
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body" id="izindetayContent">
           
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Kapat
            </button>
            <div id="izinIslemButonu">
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="reddetmeNedeniModali"
      tabindex="-1"
      aria-labelledby="reddetmeNedeniModaliLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reddetmeNedeniModaliLabel">
              Red Nedeni
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form id="reddetmeNedeniForm">
              <div class="mb-3">
                <label for="reddetmeNedeni" class="form-label"
                  >Red Nedeni</label
                >
                <textarea
                  class="form-control"
                  id="reddetmeNedeni"
                  rows="3"
                  placeholder="İzin talebini reddetme nedeninizi açıklayın..."
                  required
                ></textarea>
              </div>
              <input type="hidden" id="izinreddetmeId" />
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              İptal
            </button>
            <button type="button" class="btn btn-danger" id="onaylareddetBtn">
              Reddet
            </button>
          </div>
        </div>
      </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/izinTalebi.js"></script>
    <script src="../../public/js/izinPersonelListesi.js"></script>
    <script src="../../public/js/izin_sayaci.js"></script>
    <script src="../../public/js/izinleri_gosterme.js"></script>
    
  </body>
</html>

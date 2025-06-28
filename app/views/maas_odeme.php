

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
  
  </head>
  <body>

       
    <?php include 'sidebar.php'; ?>

    

<div class="content mt-5" >

     <div class="container-fluid">
      <div class="row mb-4">
        <div class="col">
          <h1 class="h2 mb-2">Maaş ve Ödeme Kontrol Paneli</h1>
          <nav>
            <ol>
              <li class=" active" aria-current="page">
               Maaş ve Ödemeler
              </li>
            </ol>
          </nav>
        </div>
      
      </div>

      <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card border-0 bg-primary bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-primary bg-opacity-25 p-3 me-3">
                  <i class="fas fa-users text-primary fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1" >Toplam Personel</h6>
                  <h3 class="mb-0 fw-bold" id="toplamPersonelSayi">124</h3>
                </div>
              </div>
              <div class="progress" style="height: 5px">
                <div class="progress-bar bg-primary" style="width: 100%"></div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card border-0 bg-warning bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-warning bg-opacity-25 p-3 me-3">
                  <i class="fas fa-hand-holding-usd text-warning fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Bu Ay Yapılan Ödemeler</h6>
                  <h3 class="mb-0 fw-bold" id="buAyOdenenSayi">₺980,450</h3>
                </div>
              </div>
              <div class="progress" style="height: 5px">
                <div class="progress-bar bg-warning" style="width: 78%"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 bg-danger bg-opacity-10 h-100">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-danger bg-opacity-25 p-3 me-3">
                  <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Bekleyen Ödemeler</h6>
                  <h3 class="mb-0 fw-bold"id="bekleyenOdemeSayi" >₺265,150</h3>
                </div>
              </div>
              <div class="progress" style="height: 5px">
                <div class="progress-bar bg-danger" style="width: 22%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        
        <div class="col-lg-8 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="mb-0">Personel Maaş Listesi</h5>
                </div>
                <div class="col-auto">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Personel Ara..."
                      id="personelArama"
                    />
                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Personel</th>
                      <th>Departman</th>
                      <th>Pozisyon</th>

                      <th>Net Maaş</th>
                      <th>Son Ödeme</th>
                      <th>Durum</th>
                      <th class="text-end">Detay</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div
                            class="avatar me-2 bg-primary text-white rounded-circle text-center"
                            style="width: 40px; height: 40px; line-height: 40px"
                          >
                            AY
                          </div>
                          <div>
                            <div class="fw-medium">Ahmet Yılmaz</div>
                            <div class="small text-muted">ID: 1001</div>
                          </div>
                        </div>
                      </td>
                      <td>Bilgi Teknolojileri</td>
                      <td>Yazılım Geliştirici</td>

                      <td>₺18,750</td>
                      <td>01.03.2025</td>
                      <td><span class="badge bg-success">Ödendi</span></td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button
                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                          >
                            İşlemler
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#personelDetayModal"
                                  data-id="1001"
                                ><i class="fas fa-eye me-2"></i>Detay</a
                              >
                            </li>
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#maasGuncelleModal"
                                ><i class="fas fa-edit me-2"></i>Maaş
                                Güncelle</a
                              >
                            </li>
                           
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#odemeGecmisiModal"
                                ><i class="fas fa-history me-2"></i>Ödeme
                                Geçmişi</a
                              >
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div
                            class="avatar me-2 bg-info text-white rounded-circle text-center"
                            style="width: 40px; height: 40px; line-height: 40px"
                          >
                            AD
                          </div>
                          <div>
                            <div class="fw-medium">Ayşe Demir</div>
                            <div class="small text-muted">ID: 1002</div>
                          </div>
                        </div>
                      </td>
                      <td>İnsan Kaynakları</td>
                      <td>İK Uzmanı</td>

                      <td>₺16,500</td>
                      <td>01.03.2025</td>
                      <td><span class="badge bg-success">Ödendi</span></td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button
                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                          >
                            İşlemler
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-eye me-2"></i>Detay</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-edit me-2"></i>Maaş
                                Güncelle</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-money-bill me-2"></i>Ödeme
                                Yap</a
                              >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-history me-2"></i>Ödeme
                                Geçmişi</a
                              >
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div
                            class="avatar me-2 bg-warning text-white rounded-circle text-center"
                            style="width: 40px; height: 40px; line-height: 40px"
                          >
                            MK
                          </div>
                          <div>
                            <div class="fw-medium">Mehmet Kaya</div>
                            <div class="small text-muted">ID: 1003</div>
                          </div>
                        </div>
                      </td>
                      <td>Finans</td>
                      <td>Muhasebe Müdürü</td>

                      <td>₺22,500</td>
                      <td>-</td>
                      <td><span class="badge bg-danger">Bekliyor</span></td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button
                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                          >
                            İşlemler
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-eye me-2"></i>Detay</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-edit me-2"></i>Maaş
                                Güncelle</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-money-bill me-2"></i>Ödeme
                                Yap</a
                              >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-history me-2"></i>Ödeme
                                Geçmişi</a
                              >
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div
                            class="avatar me-2 bg-success text-white rounded-circle text-center"
                            style="width: 40px; height: 40px; line-height: 40px"
                          >
                            ZC
                          </div>
                          <div>
                            <div class="fw-medium">Zeynep Çelik</div>
                            <div class="small text-muted">ID: 1004</div>
                          </div>
                        </div>
                      </td>
                      <td>Pazarlama</td>
                      <td>Pazarlama Uzmanı</td>

                      <td>₺15,000</td>
                      <td>01.03.2025</td>
                      <td><span class="badge bg-success">Ödendi</span></td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button
                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                          >
                            İşlemler
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-eye me-2"></i>Detay</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-edit me-2"></i>Maaş
                                Güncelle</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-money-bill me-2"></i>Ödeme
                                Yap</a
                              >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-history me-2"></i>Ödeme
                                Geçmişi</a
                              >
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div
                            class="avatar me-2 bg-danger text-white rounded-circle text-center"
                            style="width: 40px; height: 40px; line-height: 40px"
                          >
                            AO
                          </div>
                          <div>
                            <div class="fw-medium">Ali Öztürk</div>
                            <div class="small text-muted">ID: 1005</div>
                          </div>
                        </div>
                      </td>
                      <td>Satış</td>
                      <td>Satış Temsilcisi</td>

                      <td>₺13,500</td>
                      <td>-</td>
                      <td><span class="badge bg-danger">Bekliyor</span></td>
                      <td class="text-end">
                        <div class="dropdown">
                          <button
                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                          >
                            İşlemler
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-eye me-2"></i>Detay</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-edit me-2"></i>Maaş
                                Güncelle</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-money-bill me-2"></i>Ödeme
                                Yap</a
                              >
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="fas fa-history me-2"></i>Ödeme
                                Geçmişi</a
                              >
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer bg-white py-3">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                  <li class="page-item disabled">
                    <a
                      class="page-link"
                      href="#"
                      tabindex="-1"
                      aria-disabled="true"
                      >Önceki</a
                    >
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Sonraki</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>


        <div class="col-lg-4"> 
          <!-- ödeme işlemleri -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
              <h5 class="mb-0">Ödeme İşlemleri</h5>
            </div>
            <div class="card-body">
              <div class="list-group">
                <a
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                >
                  <div>
                    <i class="fas fa-money-bill-wave text-success me-2"></i>
                    Maaş Ödemeleri
                  </div>
                  <span class="badge bg-primary rounded-pill" id="maasSayisi">5</span>
                </a>
                <a
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                >
                  <div>
                    <i class="fas fa-award text-warning me-2"></i>
                    Prim Ödemeleri
                  </div>
                  <span class="badge bg-primary rounded-pill" id="primSayisi">3</span>
                </a>
                <a
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                >
                  <div>
                    <i class="fas fa-plane text-info me-2"></i>
                    Avans Ödemeleri
                  </div>
                  <span class="badge bg-primary rounded-pill"  id="avansSayisi">2</span>
                </a>
                <a
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                >
                  <div>
                    <i class="fas fa-clock text-secondary me-2"></i>
                    Mesai Ödemeleri
                  </div>
                  <span class="badge bg-primary rounded-pill"  id="mesaiSayisi">7</span>
                </a>
                <a
                  href="#"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                >
                  <div>
                    <i class="fas fa-hand-holding-usd text-danger me-2"></i>
                    Tazminat Ödemeleri
                  </div>
                  <span class="badge bg-primary rounded-pill" id="tazminatSayisi">1</span>
                </a>
              </div>
            </div>
          </div>
           
          <div class="card border-0 shadow-sm mb-4">
  <div class="card-header bg-white py-3">
    <h5 class="mb-0">Son Ödeme Hareketleri</h5>
  </div>
  <div class="card-body p-0">
    <div class="list-group list-group-flush" id="sonOdemeListesi">
     
    </div>
  </div>
  <div class="card-footer bg-white py-3 text-center">
    <a href="#" class="text-decoration-none">
      Tüm Hareketleri Görüntüle
      <i class="fas fa-arrow-right ms-1"></i>
    </a>
  </div>
</div>



        </div>
      </div>
    </div>

     <div
      class="modal fade"
      id="personelDetayModal"
      tabindex="-1"
      aria-labelledby="personelDetayModalLabel"
      aria-hidden="true"
    > 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
      </div>
    </div>
    </div>
    </div>     
    </div>
      <div
  
     
</div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/maas_odeme_birimleri.js"></script>
    <script src="../../public/js/odeme_islemleri.js"></script>
    <script src="../../public/js/odeme_hareketleri.js"></script>
    <script src="../../public/js/maas_Listesi.js"></script>
    <script src="../../public/js/odemeDetay.js"></script>
    <script>

</script>

   
  </body>
</html>

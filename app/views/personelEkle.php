
<?php  
include "../Controllers/tokenYenileme.php";
?>
   
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Yönetim Sistemi</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        
        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }
        
        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px dashed #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .file-upload-label:hover {
            border-color: #0d6efd;
        }
        
        .file-upload-icon {
            font-size: 2rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        .file-upload-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }
    </style>
</head>
<body>

     
<?php include 'sidebar.php'; ?>

<div class="content mt-5" >

<div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Personel Listesi</h5>
                    <button type="sumbit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPersonnelModal">
                    Personel Ekle
                   </button>

                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      
                        <tbody>
                        <?php
include '../../config/config.php';

$sql = 'CALL personeliGösterme()';

if ($result = $conn->query($sql)) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-light">';
    echo '<thead class="table-success"> 
            <tr> 
                <th>Fotoğraf</th> 
                <th>Ad Soyad</th> 
                <th>Telefon Numarası</th> 
                <th>Departman</th> 
                <th>Pozisyon</th> 
                <th>Durum</th> 
                <th>İşlemler</th> 
            </tr> 
          </thead>';

    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';

        if (!empty($row['foto'])) {
            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" width="60" height="60" class="rounded-circle"/></td>';
        } else {
            echo '<td>Fotoğraf yok</td>';
        }

        echo '<td>' . htmlspecialchars($row['ad_soyad'] ?? 'Yok') . '</td>';
        echo '<td>' . (!empty($row['telefon_no']) ? htmlspecialchars($row['telefon_no']) : 'Belirtilmemiş') . '</td>';
        echo '<td>' . (!empty($row['departman_Adı']) ? htmlspecialchars($row['departman_Adı']) : 'Departman Yok') . '</td>';
        echo '<td>' . (!empty($row['pozisyon_adı']) ? htmlspecialchars($row['pozisyon_adı']) : 'Pozisyon Yok') . '</td>';

        $durum = ($row['durumu'] == 1) ? 'Aktif' : 'Pasif';
        $badgeClass = ($row['durumu'] == 1) ? 'bg-success' : 'bg-danger';
        echo '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $durum . '</span></td>';

        echo '<td class="text-center">
                <div class="d-flex gap-2 justify-content-center">

                    <a href="#" class="btn btn-sm btn-outline-primary edit-personnel-btn" 
                       data-personel-id="' . $row['personel_id'] . '" 
                       data-bs-toggle="modal" 
                       data-bs-target="#editPersonnelModal">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="button" class="btn btn-outline-danger btn-sm" 
                            data-bs-toggle="modal" 
                            data-personel-id="' . $row['personel_id'] . '"  
                            data-bs-target="#exampleModal">
                        <i class="fas fa-trash-alt"></i>
                    </button>


           <a href="#" 
   data-personel-id="' . $row['personel_id'] . '" 
   class="btn btn-sm btn-outline-info detay-btn" 
   title="Detay" 
   data-bs-toggle="modal" 
   data-bs-target="#exampleModal2">
    <i class="fa-solid fa-circle-info"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Label">Personel Detayları</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <div id="modalBodyContent">
          <!-- AJAX ile buraya detay bilgileri yüklenecek -->
          <p>Yükleniyor...</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>

                  

    </div>
  </div>
</div>

        </div>
              </td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
    $result->free();
} else {
    die('Sorgu başarısız! Hata: ' . $conn->error);
}

echo '
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Personel Silme</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bu personeli silmek istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
        <button type="button" class="btn btn-primary" id="deleteBtn">Evet, Silmek İstiyorum</button>
      </div>
    </div>
  </div>
</div>';
?>


                 </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container">
        <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    İşlem başarıyla tamamlandı.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

<div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="addPersonnelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPersonnelModalLabel">Yeni Personel Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeAddModal"></button>
      </div>
      <div class="modal-body">
        <form id="addPersonnelForm" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Fotoğraf:</label>
            <input type="file" class="form-control" name="fotograf" accept="image" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Ad Soyad:</label>
            <input type="text" class="form-control" name="adsoyad" required>
          </div>

          <div class="mb-3">
            <label class="form-label">E-Posta:</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Doğum Tarihi:</label>
            <input type="date" class="form-control" name="dogum_tarihi" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Cinsiyet:</label>
            <select class="form-select" name="cinsiyet">
              <option value="Erkek">Erkek</option>
              <option value="Kadın">Kadın</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Telefon Türü:</label>
            <select class="form-select" name="telefon_turu">
              <option value="Mobil">Mobil</option>
              <option value="Ev">Ev</option>
              <option value="İş">İş</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Telefon No:</label>
            <input type="tel" class="form-control" name="telefon_no" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Durumu:</label>
            <select class="form-select" id="durumu" name="durumu" required>
                                        <option value="">Seçiniz</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Departman ID:</label>
            <input type="number" class="form-control" name="departman_id">
          </div>

          <div class="mb-3">
            <label class="form-label">Departman Adı:</label>
            <input type="text" class="form-control" name="departman_adi">
          </div>

          <div class="mb-3">
            <label class="form-label">Departman Kodu:</label>
            <input type="text" class="form-control" name="departman_kodu">
          </div>

          <div class="mb-3">
            <label class="form-label">İş Başlama Tarihi:</label>
            <input type="date" class="form-control" name="is_baslama_tarihi">
          </div>

          <div class="mb-3">
            <label class="form-label">İş Durumu:</label>
            <select class="form-select" id="is_durumu" name="is_durumu" required>
                                        <option value="">Seçiniz</option>
                                        <option value="pasif">pasif</option>
                                        <option value="aktif">aktif</option>
                                        
                                    </select>
          </div>

          <div class="mb-3">
            <label class="form-label">İş Tanımı:</label>
            <input type="text" class="form-control" name="is_tanimi">
          </div>

          <div class="mb-3">
            <label class="form-label">Departman Açıklaması:</label>
            <textarea class="form-control" name="departman_aciklama"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Ödeme Tutarı:</label>
            <input type="number" class="form-control" name="odeme_tutari">
          </div>

          <div class="mb-3">
            <label class="form-label">Ödeme Türü ID:</label>
            <input type="number" class="form-control" name="odeme_turu_id">
          </div>

          <div class="mb-3">
            <label class="form-label">Aktif mi?</label>
            <select class="form-select" name="aktif_mi">
              <option value="aktif">aktif</option>
              <option value="pasif">pasif</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Pozisyon Adı:</label>
            <input type="text" class="form-control" name="pozisyon_adi">
          </div>

          <div class="mb-3">
            <label class="form-label">Çalışan Sayısı:</label>
            <input type="number" class="form-control" name="calisan_sayisi">
          </div>

          <div class="mb-3">
            <label class="form-label">Tecrübe Yılı:</label>
            <input type="number" class="form-control" name="tecrube_yili">
          </div>

          <div class="mb-3">
            <label class="form-label">Eğitim Seviyesi:</label>
            <input type="text" class="form-control" name="egitim_seviyesi">
          </div>

          <div class="mb-3">
            <label class="form-label">Pozisyon ID:</label>
            <input type="number" class="form-control" name="pozisyon_id">
          </div>

          <div class="mb-3">
            <label class="form-label">Pozisyon Tipi:</label>
            <input type="text" class="form-control" name="pozisyon_tipi">
          </div>

          <div class="mb-3">
            <label class="form-label">Yetki Durumu:</label>
            <input type="text" class="form-control" name="yetki_durumu">
          </div>

          <div class="mb-3">
            <label class="form-label">Kan Grubu:</label>
            <select class="form-select" id="kan_grubu" name="kan_grubu" required>
                                        <option value="">Seçiniz</option>
                                        <option value="A Rh+">A Rh+</option>
                                        <option value="A Rh-">A Rh-</option>
                                        <option value="B Rh+">B Rh+</option>
                                        <option value="B Rh-">B Rh-</option>
                                        <option value="AB Rh+">AB Rh+</option>
                                        <option value="AB Rh-">AB Rh-</option>
                                        <option value="0 Rh+">0 Rh+</option>
                                        <option value="0 Rh-">0 Rh-</option>
                                    </select>
       
          </div>

          <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editPersonnelModal" tabindex="-1" aria-labelledby="editPersonnelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow-lg rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editPersonnelModalLabel">Personel Bilgilerini Düzenle</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form id="editPersonnelForm" enctype="multipart/form-data">
          <div class="text-center mb-3">
            <img id="modal_foto" src="" alt="Personel Fotoğrafı" class="img-thumbnail rounded" width="150">
          </div>
          <div class="mb-3">
            <label for="modal_foto_input" class="form-label">Fotoğraf Yükle</label>
            <input type="file" class="form-control" id="modal_foto_input" name="fotograf">
          </div>
          <input type="hidden" id="edit_id" name="personel_id">
          <div class="mb-3">
            <label for="edit_ad_soyad" class="form-label">Ad Soyad</label>
            <input type="text" class="form-control" id="edit_ad_soyad" name="ad_soyad">
          </div>
          <div class="mb-3">
            <label for="edit_telefon_no" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="edit_telefon_no" name="telefon_no">
          </div>
          <div class="mb-3">
            <label for="edit_departman" class="form-label">Departman</label>
            <input type="text" class="form-control" id="edit_departman" name="departman_id">
          </div>
          <div class="mb-3">
            <label for="edit_pozisyon" class="form-label">Pozisyon</label>
            <input type="text" class="form-control" id="edit_pozisyon" name="pozisyon_id">
          </div>
          <div class="mb-3">
            <label for="edit_durum" class="form-label">Durum</label>
            <input type="text" class="form-control" id="edit_durum" name="durumu">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-primary" id="saveChangesduzenle">Kaydet</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../public/js/ekleme.js"></script>
    <script src="../../public/js/personelDüzenle.js"></script>
    <script src="../../public/js/modalicidoldurma.js"></script>
    <script src="../../public/js/personelduzenlekadet.js"></script>
    <script src="../../public/js/personelSilme.js"></script>
    <script src="../../public/js/personelDetayGosterme.js"></script>


    <script>
      if (response.status === "success") {
  alert(response.message);
  if (fotograf) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("modal_foto").src = e.target.result;
    };
    reader.readAsDataURL(fotograf);
  }
}
    </script>
   

    </div>
</body>
</html>
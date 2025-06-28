
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


<div class="content" >

<div class="container-fluid mt-5">
   
   <div class="row mb-4">
     <div class="col">
       <h1 class="h2 mb-2">Destek ve İletişim</h1>
       <nav >
         <ol class="breadcrumb">
           <li class="breadcrumb-item active" aria-current="page">
             Destek ve İletişim
           </li>
         </ol>
       </nav>
     </div>
   </div>

   <div class="row">
   
     <div class="col-lg-8 mb-4">
       
       <div class="card border-0 shadow-sm mb-4">
         <div
           class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
         >
           <h5 class="mb-0">
             <i class="fas fa-ticket-alt me-2"></i> Destek Talepleri
           </h5>
           <button
             class="btn btn-primary btn-sm"
             data-bs-toggle="modal"
             data-bs-target="#yeniTalepModal"
           >
             <i class="fas fa-plus me-1"></i> Yeni Talep
           </button>
         </div>
         <div class="card-body p-0">
           <div class="table-responsive">
             <table class="table table-hover align-middle mb-0">
               <thead class="table-light">
                 <tr>
                   <th>Talep No</th>
                   <th>Konu</th>
                   <th>Oluşturan</th>
                   <th>Tarih</th>
                   <th>Durum</th>
                   <th>İşlemler</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>#1025</td>
                   <td>Maaş modülünde hata</td>
                   <td>Ahmet Yılmaz</td>
                   <td>10.04.2025</td>
                   <td><span class="badge bg-warning">Beklemede</span></td>
                   <td>
                     <button
                       class="btn btn-sm btn-outline-primary"
                       data-bs-toggle="modal"
                       data-bs-target="#talepDetayModal"
                     >
                       <i class="fas fa-eye"></i>
                     </button>
                   </td>
                 </tr>
                 <tr>
                   <td>#1024</td>
                   <td>Yeni departman ekleme</td>
                   <td>Mehmet Kaya</td>
                   <td>08.04.2025</td>
                   <td><span class="badge bg-success">Çözüldü</span></td>
                   <td>
                     <button class="btn btn-sm btn-outline-primary">
                       <i class="fas fa-eye"></i>
                     </button>
                   </td>
                 </tr>
                 <tr>
                   <td>#1023</td>
                   <td>İzin onay süreci değişikliği</td>
                   <td>Ayşe Demir</td>
                   <td>05.04.2025</td>
                   <td><span class="badge bg-info">İşlemde</span></td>
                   <td>
                     <button class="btn btn-sm btn-outline-primary">
                       <i class="fas fa-eye"></i>
                     </button>
                   </td>
                 </tr>
                 <tr>
                   <td>#1022</td>
                   <td>Raporlama modülü iyileştirme</td>
                   <td>Zeynep Çelik</td>
                   <td>01.04.2025</td>
                   <td><span class="badge bg-success">Çözüldü</span></td>
                   <td>
                     <button class="btn btn-sm btn-outline-primary">
                       <i class="fas fa-eye"></i>
                     </button>
                   </td>
                 </tr>
                 <tr>
                   <td>#1021</td>
                   <td>Kullanıcı yetkilendirme sorunu</td>
                   <td>Ali Öztürk</td>
                   <td>28.03.2025</td>
                   <td><span class="badge bg-success">Çözüldü</span></td>
                   <td>
                     <button class="btn btn-sm btn-outline-primary">
                       <i class="fas fa-eye"></i>
                     </button>
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

      
       <div class="card border-0 shadow-sm">
         <div class="card-header bg-white py-3">
           <h5 class="mb-0">
             <i class="fas fa-question-circle me-2"></i> Sık Sorulan Sorular
           </h5>
         </div>
         <div class="card-body">
           <div class="accordion" id="faqAccordion">
             <div class="accordion-item">
               <h2 class="accordion-header" id="headingOne">
                 <button
                   class="accordion-button"
                   type="button"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseOne"
                   aria-expanded="true"
                   aria-controls="collapseOne"
                 >
                   Personel izin taleplerini nasıl onaylayabilirim?
                 </button>
               </h2>
               <div
                 id="collapseOne"
                 class="accordion-collapse collapse show"
                 aria-labelledby="headingOne"
                 data-bs-parent="#faqAccordion"
               >
                 <div class="accordion-body">
                   <p>Personel izin taleplerini onaylamak için:</p>
                   <ol>
                     <li>"Onaylar" menüsüne gidin</li>
                     <li>"İzin Talepleri" sekmesini seçin</li>
                     <li>
                       İlgili talebin yanındaki "Onayla" butonuna tıklayın
                       veya toplu onay için talepleri seçip "Seçilenleri
                       Onayla" butonunu kullanın
                     </li>
                   </ol>
                 </div>
               </div>
             </div>
             <div class="accordion-item">
               <h2 class="accordion-header" id="headingTwo">
                 <button
                   class="accordion-button collapsed"
                   type="button"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseTwo"
                   aria-expanded="false"
                   aria-controls="collapseTwo"
                 >
                   Yeni bir departman nasıl ekleyebilirim?
                 </button>
               </h2>
               <div
                 id="collapseTwo"
                 class="accordion-collapse collapse"
                 aria-labelledby="headingTwo"
                 data-bs-parent="#faqAccordion"
               >
                 <div class="accordion-body">
                   <p>Yeni bir departman eklemek için:</p>
                   <ol>
                     <li>"Ayarlar" menüsüne gidin</li>
                     <li>"Organizasyon Yapısı" sekmesini seçin</li>
                     <li>"Yeni Departman" butonuna tıklayın</li>
                     <li>
                       Gerekli bilgileri doldurun ve "Kaydet" butonuna
                       tıklayın
                     </li>
                   </ol>
                 </div>
               </div>
             </div>
             <div class="accordion-item">
               <h2 class="accordion-header" id="headingThree">
                 <button
                   class="accordion-button collapsed"
                   type="button"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseThree"
                   aria-expanded="false"
                   aria-controls="collapseThree"
                 >
                   Maaş bordroları nasıl oluşturulur?
                 </button>
               </h2>
               <div
                 id="collapseThree"
                 class="accordion-collapse collapse"
                 aria-labelledby="headingThree"
                 data-bs-parent="#faqAccordion"
               >
                 <div class="accordion-body">
                   <p>Maaş bordroları oluşturmak için:</p>
                   <ol>
                     <li>"Maaşlar" menüsüne gidin</li>
                     <li>"Bordro Oluştur" butonuna tıklayın</li>
                     <li>İlgili dönemi seçin ve personelleri belirleyin</li>
                     <li>"Bordroları Oluştur" butonuna tıklayın</li>
                     <li>
                       Oluşturulan bordroları kontrol edin ve "Onaya Gönder"
                       butonuna tıklayın
                     </li>
                   </ol>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>


     <div class="col-lg-4">
    
       <div class="card border-0 shadow-sm mb-4 border-danger">
         <div class="card-header bg-danger text-white py-3">
           <h5 class="mb-0">
             <i class="fas fa-exclamation-triangle me-2"></i> Acil Destek
             Hattı
           </h5>
         </div>
         <div class="card-body">
           <p>
             Kritik sistem sorunları için 7/24 ulaşabileceğiniz acil destek
             hattı:
           </p>
           <div class="d-flex align-items-center mb-3">
             <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
               <i class="fas fa-phone-alt text-danger fa-2x"></i>
             </div>
             <div>
               <h5 class="mb-0">+90 (555) 987 6543</h5>
               <p class="text-muted mb-0">7/24 Acil Destek</p>
             </div>
           </div>
           <div class="alert alert-warning mb-0">
             <i class="fas fa-info-circle me-2"></i> Bu hattı yalnızca kritik
             sistem sorunları için kullanınız.
           </div>
         </div>
       </div>

 
     </div>
   </div>
 </div>


 <div
   class="modal fade"
   id="yeniTalepModal"
   tabindex="-1"
   aria-labelledby="yeniTalepModalLabel"
   aria-hidden="true"
 >
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="yeniTalepModalLabel">
        Yeni Destek Talebi Oluştur
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form id="talepForm">
        <!-- Konu -->
        <div class="mb-3">
          <label for="talepKonu" class="form-label">Konu</label>
          <input type="text" class="form-control" id="talepKonu" placeholder="Destek talebinizin konusu" />
        </div>

        <!-- Kategori ve Öncelik -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="talepKategori" class="form-label">Kategori</label>
            <select class="form-select" id="talepKategori">
              <option value="">Kategori Seçin</option>
              <option value="Teknik Sorun">Teknik Sorun</option>
              <option value="Özellik İsteği">Özellik İsteği</option>
              <option value="Veri Düzeltme">Veri Düzeltme</option>
              <option value="Kullanıcı Yönetimi">Kullanıcı Yönetimi</option>
              <option value="Diğer">Diğer</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="talepOncelik" class="form-label">Öncelik</label>
            <select class="form-select" id="talepOncelik">
              <option value="Düşük">Düşük</option>
              <option value="Orta" selected>Orta</option>
              <option value="Yüksek">Yüksek</option>
              <option value="Kritik">Kritik</option>
            </select>
          </div>
        </div>

        <!-- Açıklama -->
        <div class="mb-3">
          <label for="talepAciklama" class="form-label">Açıklama</label>
          <textarea class="form-control" id="talepAciklama" rows="5"
            placeholder="Lütfen sorununuzu veya isteğinizi detaylı olarak açıklayın..."></textarea>
        </div>

        <!-- Ek Dosyalar -->
        <div class="mb-3">
          <label for="talepDosya" class="form-label">Ekler (İsteğe Bağlı)</label>
          <input class="form-control" type="file" id="talepDosya" multiple />
          <div class="form-text">Ekran görüntüleri veya ilgili dosyaları ekleyebilirsiniz (maks. 5 dosya, her biri 5MB'dan küçük).</div>
        </div>

        <!-- Oluşturan Adı -->
        <div class="mb-3">
          <label for="olusturanAdi" class="form-label">Adınız</label>
          <input type="text" class="form-control" id="olusturanAdi" placeholder="Adınızı giriniz" />
        </div>

        <!-- (atanan_adi, durum, olusturma_tarihi, son_guncelleme sistem tarafından eklenecek) -->
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
      <button type="button" class="btn btn-primary" id="izingondermeBtn">Talebi Gönder</button>
    </div>
  </div>
</div>

 </div>

 <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="basariToast" class="toast align-items-center text-white bg-success border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        Talebiniz başarıyla gönderildi.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>


 
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/destekIletisim.js"></script>
    <script src="../../public/js/yeniTalepEkleme.js"></script>
    <script>
      document.getElementById("izingondermeBtn").addEventListener("click", function() {
 

  const toast = new bootstrap.Toast(document.getElementById("basariToast"));
  toast.show();
});

    </script>
  </body>
</html>

<?php
require_once __DIR__ . "/../../config/config.php";

if (isset($_GET['id'])) {
  $personelId = intval($_GET['id']);

  $stmt = $conn->prepare("SELECT * FROM PersonelTable p LEFT JOIN maas_bilgileri m ON p.personel_id = m.personel_id WHERE p.personel_id = ?");
  $stmt->bind_param("i", $personelId);
  $stmt->execute();
  $personel = $stmt->get_result()->fetch_assoc();

  // Departman adı alınıyor
  $stmtDep = $conn->prepare("SELECT departman_adi FROM departmanlar WHERE personel_id = ?");
  $stmtDep->bind_param("i", $personelId);
  $stmtDep->execute();
  $departmanResult = $stmtDep->get_result()->fetch_assoc();
  $departmanAdi = $departmanResult['departman_adi'] ?? 'Bilgi yok';

  // Pozisyon adı alınıyor
  $stmtPoz = $conn->prepare("SELECT pozisyon_adi FROM pozisyonlar WHERE personel_id = ?");
  $stmtPoz->bind_param("i", $personelId);
  $stmtPoz->execute();
  $pozisyonResult = $stmtPoz->get_result()->fetch_assoc();
  $pozisyonAdi = $pozisyonResult['pozisyon_adi'] ?? 'Bilgi yok';

  // Ek ödeme ve kesintiler
  $stmt2 = $conn->prepare("SELECT * FROM ek_odeme_kesinti WHERE personel_id = ?");
  $stmt2->bind_param("i", $personelId);
  $stmt2->execute();
  $ekler = $stmt2->get_result();

  // Maaş geçmişi
  $stmt3 = $conn->prepare("SELECT * FROM maas_gecmisi WHERE personel_id = ?");
  $stmt3->bind_param("i", $personelId);
  $stmt3->execute();
  $gecmis = $stmt3->get_result();
?>

<div class="modal-header">
  <h5 class="modal-title">Personel Maaş Detayları</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="d-flex align-items-center mb-3">
        <div class="avatar me-3 bg-primary text-white rounded-circle text-center" style="width: 60px; height: 60px; line-height: 60px; font-size: 24px;">
          <?= strtoupper(mb_substr($personel['ad_Soyad'], 0, 1)) . strtoupper(mb_substr(explode(' ', $personel['ad_Soyad'])[1] ?? '', 0, 1)); ?>
        </div>
        <div>
          <h5 class="mb-0"><?= htmlspecialchars($personel['ad_Soyad']) ?></h5>
          <p class="text-muted mb-0">ID: <?= $personelId ?></p>
        </div>
      </div>

      <div class="mb-2"><strong>Departman:</strong> <?= htmlspecialchars($departmanAdi) ?></div>
      <div class="mb-2"><strong>Pozisyon:</strong> <?= htmlspecialchars($pozisyonAdi) ?></div>
      <div><strong>Durum:</strong> <span class="badge bg-success">Aktif</span></div>
    </div>

    <div class="col-md-6">
      <div class="card bg-light">
        <div class="card-body">
          <h6 class="card-title">Maaş Bilgileri</h6>
          <div class="mb-2 d-flex justify-content-between">
            <span>Brüt Maaş:</span>
            <strong>₺<?= number_format($personel['brut_maas'], 0, ',', '.') ?></strong>
          </div>
          <div class="mb-2 d-flex justify-content-between">
            <span>SGK Kesintisi:</span>
            <strong>₺<?= number_format($personel['sgk_kesintisi'], 0, ',', '.') ?></strong>
          </div>
          <div class="mb-2 d-flex justify-content-between">
            <span>Gelir Vergisi:</span>
            <strong>₺<?= number_format($personel['gelir_vergisi'], 0, ',', '.') ?></strong>
          </div>
          <div class="mb-2 d-flex justify-content-between">
            <span>Diğer Kesintiler:</span>
            <strong>₺<?= number_format($personel['diger_kesintiler'], 0, ',', '.') ?></strong>
          </div>
          <hr>
          <div class="d-flex justify-content-between">
            <span>Net Maaş:</span>
            <strong class="text-success">₺<?= number_format($personel['net_maas'], 0, ',', '.') ?></strong>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h6 class="mb-3">Ek Ödemeler ve Kesintiler</h6>
  <div class="table-responsive">
    <table class="table table-sm table-bordered">
      <thead class="table-light">
        <tr>
          <th>Tür</th>
          <th>Açıklama</th>
          <th>Tutar</th>
          <th>Tarih</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $ekler->fetch_assoc()): ?>
          <tr>
            <td><span class="badge bg-<?= $row['tur'] == 'Prim' ? 'success' : ($row['tur'] == 'Mesai' ? 'info' : 'warning'); ?>"><?= $row['tur'] ?></span></td>
            <td><?= htmlspecialchars($row['aciklama']) ?></td>
            <td>₺<?= number_format($row['tutar'], 0, ',', '.') ?></td>
            <td><?= date('d.m.Y', strtotime($row['tarih'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <h6 class="mb-3 mt-4">Maaş Geçmişi</h6>
  <div class="table-responsive">
    <table class="table table-sm">
      <thead class="table-light">
        <tr>
          <th>Dönem</th>
          <th>Brüt Maaş</th>
          <th>Net Maaş</th>
          <th>Ödeme Tarihi</th>
          <th>Durum</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $gecmis->fetch_assoc()): ?>
          <tr>
            <td><?= $row['donem'] ?></td>
            <td>₺<?= number_format($row['brut_maas'], 0, ',', '.') ?></td>
            <td>₺<?= number_format($row['net_maas'], 0, ',', '.') ?></td>
            <td><?= date('d.m.Y', strtotime($row['odeme_tarihi'])) ?></td>
            <td><span class="badge bg-<?= $row['odeme_durumu'] === 'Ödendi' ? 'success' : 'danger' ?>"><?= $row['odeme_durumu'] ?></span></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kapat</button>
</div>

<?php 
} else {
  echo "<div class='modal-body text-danger'>ID gönderilmedi!</div>";
} 
?>

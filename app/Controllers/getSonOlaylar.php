<?php
require_once __DIR__ . '/../../config/config.php';
header('Content-Type: application/json');

try {
    $query = "
        (SELECT 
            p.ad_soyad, 
            'izin' AS kategori, 
            i.izin_onay_durumu AS durum,
            i.izinGuncellemeTarihi AS tarih
         FROM izinler i
         LEFT JOIN PersonelTable p ON i.personel_id = p.personel_id
         WHERE i.izin_onay_durumu IN ('Onaylandı', 'Reddedildi')
         ORDER BY i.izinGuncellemeTarihi DESC
         LIMIT 5)

        UNION

        (SELECT 
            p.ad_soyad, 
            'ödeme' AS kategori, 
            m.odeme_durumu AS durum,
            m.odemeGuncellemeTarihi AS tarih
         FROM maas_odeme m
         LEFT JOIN PersonelTable p ON m.personel_id = p.personel_id
         WHERE m.odeme_durumu IN ('Onaylandı', 'Reddedildi')
         ORDER BY m.odemeGuncellemeTarihi DESC
         LIMIT 5)

        UNION

      (
  SELECT 
    p.ad_soyad, 
    'diğer' AS kategori, 
    dt.talep_durumu AS durum,
    dt.personelGuncellemeTarihi AS tarih
  FROM personelTalepleri dt
  LEFT JOIN PersonelTable p ON dt.personel_id = p.personel_id
  WHERE dt.talep_durumu IN ('Onaylandı', 'Reddedildi')
  ORDER BY personelGuncellemeTarihi DESC
  LIMIT 5
)



        UNION

        (SELECT 
            p.ad_soyad, 
            'diğer' AS kategori, 
            dt.talep_durumu AS durum,
            dt.digerTalepGuncellemeTarihi AS tarih
         FROM diger_talepler dt
         LEFT JOIN PersonelTable p ON dt.personel_id = p.personel_id
         WHERE dt.talep_durumu IN ('Onaylandı', 'Reddedildi')
         ORDER BY dt.digerTalepGuncellemeTarihi DESC
         LIMIT 5)

        ORDER BY tarih DESC
        LIMIT 10
    ";

    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Sorgu hatası: " . $conn->error);
    }

    $onaylar = [];

    while ($row = $result->fetch_assoc()) {
        $onaylar[] = $row;
    }

    echo json_encode($onaylar);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "mesaj" => $e->getMessage()]);
}

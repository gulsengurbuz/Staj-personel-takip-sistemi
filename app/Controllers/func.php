<?php 
 function ipAl() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP internet paylaşıcısından gelirse
        $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP proxy üzerinden gelirse
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        // Bazı proxy'ler bu başlığı kullanır
        $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else {
        // IP doğrudan erişimle gelirse
        $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
}

 function hostAl()
{
return $_SERVER['HTTP_HOST'] ;
}

 function osAl() {
return $_SERVER['HTTP_USER_AGENT'];
}
?>
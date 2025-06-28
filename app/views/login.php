<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.cdnfonts.com/css/varela-round-3"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../public/css/style.css"/>
    
    <style>
      :root {
        --primary-gradient: linear-gradient(135deg,rgb(62, 98, 255) 0%,rgb(75, 118, 162) 100%);
        --secondary-gradient: linear-gradient(135deg,rgb(195, 227, 255) 0%,rgba(106, 138, 255, 0.54) 100%);
        --glass-bg: rgba(255, 255, 255, 0.15);
        --glass-border: rgba(255, 255, 255, 0.2);
        --text-primary: #2d3748;
        --text-secondary: #4a5568;
        --text-light: rgba(255, 255, 255, 0.9);
        --shadow-glass: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        --shadow-button: 0 4px 15px 0 rgba(31, 38, 135, 0.2);
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: var(--secondary-gradient);
        min-height: 100vh;
        font-family: 'Varela Round', sans-serif;
        overflow-x: hidden;
      }

      body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
          radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
          radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
          radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
        z-index: -1;
      }

      .mid {
        display: flex;
        align-items: center;
        /*justify-content: center;*/
        min-height: 100vh;
        padding: 2rem 1rem;
      }

      .login-container {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-glass);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 500px;
        position: relative;
      }

      .login-left {
        background: var(--primary-gradient);
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
      }

      .login-left::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
          radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        animation: float 20s ease-in-out infinite;
        opacity: 0.3;
      }

      @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
      }

      .login-left h2 {
        color: var(--text-light);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        letter-spacing: 2px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        z-index: 2;
        position: relative;
      }

      .security-icon {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 2rem 0;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        z-index: 2;
        position: relative;
      }

      .security-icon::before {
        content: '🔒';
        font-size: 3rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
      }

      .login-right {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .login-right h3 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 2rem;
        font-size: 1.5rem;
        text-align: center;
        position: relative;
      }

      .login-right h3::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
      }

      .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .form-control {
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
      }

      .form-control:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
      }

      .form-control::placeholder {
        color: rgba(77, 77, 77, 0.6);
      }

      .btn {
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .bg-new {
        background: var(--primary-gradient) !important;
        color: white !important;
        box-shadow: var(--shadow-button);
      }

      .bg-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(31, 38, 135, 0.4);
      }

      .btn-outline-primary {
        border: 2px solid #667eea;
        color: #667eea;
        background: transparent;
        backdrop-filter: blur(10px);
      }

      .btn-outline-primary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-button);
      }

      .btn-outline-success {
        border: 2px solid #48bb78;
        color: #48bb78;
        background: transparent;
        backdrop-filter: blur(10px);
      }

      .btn-outline-success:hover {
        background: #48bb78;
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-button);
      }

      .btn-outline-danger {
        border: 2px solid #f56565;
        color: #f56565;
        background: transparent;
        backdrop-filter: blur(10px);
      }

      .btn-outline-danger:hover {
        background: #f56565;
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-button);
      }

      .btn-warning {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border: none;
        color: white;
        box-shadow: var(--shadow-button);
      }

      .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(251, 191, 36, 0.4);
      }

      .modal-content {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-glass);
      }

      .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        background: var(--primary-gradient);
        border-radius: 20px 20px 0 0;
      }

      .modal-header h5 {
        color: white !important;
      }

      .modal-body {
        background: rgba(255, 255, 255, 0.95);
      }

      .otp-inputs {
        gap: 0.75rem;
        margin: 1.5rem 0;
      }

      .otp-field {
        width: 50px;
        height: 50px;
        text-align: center;
        border: 2px solid rgba(102, 126, 234, 0.3);
        border-radius: 12px;
        font-size: 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
      }

      .otp-field:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        outline: none;
      }

      .timer {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        display: inline-block;
        font-weight: 600;
        box-shadow: var(--shadow-button);
        backdrop-filter: blur(10px);
      }

      .text-primary {
        color: #667eea !important;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
      }

      .text-primary:hover {
        color: #764ba2 !important;
        text-decoration: underline;
      }

      input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #667eea;
        margin-right: 0.5rem;
      }

      .foot {
        padding: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(248, 250, 252, 0.8);
        border-radius: 0 0 20px 20px;
        backdrop-filter: blur(10px);
      }

      small {
        font-size: 0.85rem;
      }

      .form-text {
        color: var(--text-secondary);
      }

      @media (max-width: 768px) {
        .login-container {
          grid-template-columns: 1fr;
          margin: 1rem;
          max-width: 400px;
        }
        
        .login-left {
          min-height: 200px;
          padding: 2rem 1.5rem;
        }
        
        .login-left h2 {
          font-size: 2rem;
          margin-bottom: 1rem;
        }
        
        .security-icon {
          width: 80px;
          height: 80px;
          margin: 1rem 0;
        }
        
        .security-icon::before {
          font-size: 2rem;
        }
        
        .login-right {
          padding: 2rem 1.5rem;
        }
        
        .mid {
          padding: 1rem;
        }
      }

      
      .form-control, .btn {
        animation: fadeInUp 0.6s ease-out;
      }

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      
      .btn.loading {
        position: relative;
        color: transparent;
      }

      .btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top-color: currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      @media (max-width: 768px) {
  .login-container {
    grid-template-columns: 1fr;
    margin: 1rem auto;
    max-width: 95%;
  }

  .login-left {
    padding: 1.5rem 1rem;
  }

  .login-left h2 {
    font-size: 2rem;
  }

  .security-icon {
    width: 80px;
    height: 80px;
    margin: 1rem 0;
  }

  .security-icon::before {
    font-size: 2rem;
  }

  .login-right {
    padding: 1.5rem 1rem;
  }

  .otp-inputs {
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .otp-field {
    width: 40px;
    height: 40px;
  }
}
@media (max-width: 992px) {
  .login-container {
    grid-template-columns: 1fr;
    max-width: 95%;
    margin: auto;
  }

  .login-left {
    padding: 2rem 1rem;
  }

  .login-left h2 {
    font-size: 1.8rem;
  }

  .security-icon {
    width: 80px;
    height: 80px;
  }

  .security-icon::before {
    font-size: 2rem;
  }

  .login-right {
    padding: 2rem 1rem;
  }

  .otp-field {
    width: 40px;
    height: 40px;
  }

  .otp-inputs {
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .form-control {
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
  }

  .btn {
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
  }

  .modal-dialog {
    margin: 1rem;
  }

  .modal-content {
    padding: 1rem;
  }
}

@media (max-width: 576px) {
  .login-left h2 {
    font-size: 1.5rem;
  }

  .login-right h3 {
    font-size: 1.2rem;
  }

  .otp-field {
    width: 35px;
    height: 35px;
  }

  .timer {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }
}
@media (max-width: 768px) {
  .login-container {
    display: flex;
    flex-direction: column;
    width: 90%;
    margin: 1rem auto;
    height: auto;
  }

  .login-left {
    order: 1;
    width: 100%;
    padding: 2rem 1rem;
  }

  .login-left h2 {
    font-size: 2rem;
  }

  .security-icon {
    width: 80px;
    height: 80px;
    margin: 1rem auto;
  }

  .security-icon::before {
    font-size: 2rem;
  }

  .login-right {
    order: 2;
    width: 100%;
    padding: 2rem 1rem;
  }

  .form-control {
    font-size: 0.95rem;
    padding: 0.5rem 1rem;
  }

  .btn {
    font-size: 0.95rem;
    padding: 0.6rem 1rem;
  }

  .otp-field {
    width: 40px;
    height: 40px;
  }

  .timer {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }

  .mid {
    margin-bottom: 2rem !important;
    padding: 1rem;
  }
}

@media (max-width: 576px) {
  .login-left h2 {
    font-size: 1.6rem;
  }

  .login-right h3 {
    font-size: 1.2rem;
  }

  .otp-field {
    width: 35px;
    height: 35px;
  }

  .btn {
    font-size: 0.85rem;
    padding: 0.5rem 0.8rem;
  }
}
@media (max-width: 420px) {
  .login-container {
    display: flex;
    flex-direction: column;
    width: 95%;
    margin: 1rem auto;
    height: auto;
    border-radius: 15px;
  }

  .login-left {
    order: 1;
    width: 100%;
    padding: 1.5rem 1rem;
  }

  .login-left h2 {
    font-size: 1.8rem;
  }

  .security-icon {
    width: 70px;
    height: 70px;
    margin: 1rem auto;
  }

  .security-icon::before {
    font-size: 1.8rem;
  }

  .login-right {
    order: 2;
    width: 100%;
    padding: 1.5rem 1rem;
  }

  .form-control {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }

  .btn {
    font-size: 0.9rem;
    padding: 0.6rem 1rem;
  }

  .otp-field {
    width: 35px;
    height: 35px;
  }

  .timer {
    font-size: 0.85rem;
    padding: 0.4rem 1rem;
  }

  .modal-dialog {
    margin: 1rem auto;
    max-width: 90%;
  }

  .modal-content {
    padding: 1rem;
  }

  .mid {
    padding: 0.5rem;
    margin-bottom: 2rem !important;
  }
}


    </style>
  </head>
  <body>
    <?php include '../../public/php/navbar.php'; ?>

    <div style="margin-bottom: 10em;" class="mid">
      <div class="login-container">
      
        <div class="login-left">
          <h2>PTS</h2>
          <div class="security-icon"></div>
          <p style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; line-height: 1.6;">
            Güvenli giriş sistemi ile personel bilgilerinizi koruyoruz
          </p>
        </div>

        <div class="login-right">
          <h3 class="text-center mb-4 text-dark fs-4 fw-medium">Personel Takip Sistemi</h3>
          <form id="loginForm" novalidate>
            <div class="mb-3">
              <label for="username" class="form-label">Kullanıcı Adı</label>
              <input type="text" class="form-control" id="username" required maxlength="11" pattern="[0-9]{11}" data-bs-toggle="tooltip" data-bs-placement="right" title="Lütfen yalnızca 11 haneli rakam giriniz." placeholder="TC Kimlik Numarası" />
              <small id="usernameTooltip" style="display:none; color:red; margin-top:3px">❌ Geçersiz TC Kimlik Numarası</small>
            </div>  

            <div class="mb-3">
              <label for="password" class="form-label">Parola</label>
              <input type="password" class="form-control" id="password" required minlength="10" 
                    data-bs-toggle="tooltip" data-bs-placement="right" 
                    title="Parolanız en az 10 karakter olmalı, bir büyük harf, bir küçük harf, bir rakam ve bir özel karakter içermelidir." 
                    placeholder="Parolanızı giriniz" />
                    <small style="margin-top:3px" id="password-strength" class="form-text"></small>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <input type="checkbox" id="remember" />
                <label for="remember" class="fw-lighter">Beni Hatırla</label>
              </div>
             
            </div>

            <div style="width: 25em; margin-left: 35em; margin-top: 2em;" class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-new ">
                    <h5 style="color: aliceblue !important;" class="fs-5 w-100 text-muted" id="forgotPasswordModalLabel">Şifre Değiştirme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                  </div>
                  <div  class="modal-body">
                    <div class="mb-3">
                      <label for="name" class="form-label">Ad Soyad</label>
                      <input type="text" id="name" class="form-control" placeholder="Adınızı ve soyadınızı giriniz" />
                    </div>
                    <div class="mb-3">
                      <label for="tcNo" class="form-label">TC Kimlik Numarası</label>
                      <input type="text" id="tcNo" class="form-control" maxlength="11" pattern="[0-9]{11}" placeholder="11 haneli TC kimlik numarası" />
                      <small id="tcNoTooltip" style="display:none; color:red; margin-top:3px">❌ Geçersiz TC Kimlik Numarası</small>
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">Telefon Numarası</label>
                      <input type="tel" id="phone" class="form-control" placeholder="5xx xxx xxxx" pattern="[0-9]{10}" required />
                      <small id="infoText" class="form-text text-muted" style="display: none;">
                                  Girdiğiniz telefon numarasına SMS olarak şifre yenileme kodu gönderilecektir.
                        </small>

                      <div class="text-end">
                  
                  <button id="koduGönder" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#otpModal" style="display: none; float: right; border-radius:5px; width: 23em; margin-top:1em;">
                      Kodu Gönder
                  </button>
              </div>
                    </div>
                    
                  
                  </div>

       
          
                            <div class="foot mb-2 ">
                              <button style="float: right; margin-right: 1em; width: 10em;" type="button" class="btn btn-outline-success" id="resetPasswordBtn">Şifremi Değiştir</button>
                              <button style="margin-left: 1em; float: left; width: 10em;"  type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Kapat</button>
                            </div>
                          </div>
                        </div>
                      </div>
            
    
      <div style="border-radius: 5em;" class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content p-4">
                      <div class="modal-header">
                          <h5 class="modal-title" id="otpModalLabel">Doğrulama</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                          <p>Personel Takip Sistemi şifre üyelik doğrulama için telefonunuza gelen SMS doğrulama kodunu alana giriniz.</p>
                          
                          
                          <div class="otp-inputs d-flex justify-content-center">
                              <input type="text" maxlength="1" class="otp-field" id="digit1">
                              <input type="text" maxlength="1" class="otp-field" id="digit2">
                              <input type="text" maxlength="1" class="otp-field" id="digit3">
                              <input type="text" maxlength="1" class="otp-field" id="digit4">
                              <input type="text" maxlength="1" class="otp-field" id="digit5">
                              <input type="text" maxlength="1" class="otp-field" id="digit6">
                          </div>

                          
                          <div class="timer mt-4">
                              ⏳ <span style="font-weight: 700; font-size: large;" id="countdown"><strong>0:20</strong></span>
                          </div>

                         
                          <button style="border-radius: 2em;" class="btn btn-warning w-100 mt-4" id="verifyBtn">Doğrula</button>
                          
                      </div>
                  </div>
              </div>
          </div>
           
            <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content text-center">
                  <div class="modal-header bg-new">
                    <h5 class="fs-4 text-center w-100 text-muted" id="verificationModalLabel">Doğrulama Kodu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="verificationCode" class="form-label">Doğrulama Kodu</label>
                      <input type="text" id="verificationCode" class="form-control" maxlength="6" pattern="[0-9]{6}" placeholder="6 haneli doğrulama kodu" />
                      <small class="form-text text-muted">Telefonunuza gönderilen doğrulama kodunu giriniz.</small>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-outline-success" id="verifyCodeBtn">Doğrula</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-3">
              <a href="#" class="btn bg-new text-white text-decoration-none d-grid" id="validateBtn">Giriş Yap</a>
            </div>
          </form>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="../script.js"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="../../public/js/login.js"></script> 

     <script src="../../public/js/kullaniciGirisKontrol.js"></script>

  </body>
</html>
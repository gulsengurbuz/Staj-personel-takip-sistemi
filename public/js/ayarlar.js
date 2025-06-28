const defaultSettings = {
  companyName: "ABC Şirketi",
  systemVersion: "v2.1.0",
  installationDate: "2024-01-15",

  dailyWorkHours: 8,
  annualLeave: 14,
  sickLeave: 15,
  maternityLeave: 30,
  marriageLeave: 7,
  bereavementLeave: 7,
  unpaidLeave: 14,
  autoApproveShortLeave: true,

  recordsPerPage: 25,

  departments: [
    "İnsan Kaynakları",
    "Yazılım Departmanı",
    "Satış ve Pazarlama",
    "Muhasebe",
  ],

  canAddEmployee: true,
  canUpdateEmployee: true,
  canRemoveEmployee: false,

  salaryViewPermission: "admin",

  emailNotifications: true,
  newEmployeeNotification: true,
  salaryUpdateNotification: true,
  leaveRequestNotification: true,
  approvalNotification: true,

  dateFormat: "DD.MM.YYYY",
  timeFormat: "24h",

  sessionTimeout: 30,
  maxLoginAttempts: 3,

  loggingEnabled: true,
  autoBackup: false,
};

let currentSettings = { ...defaultSettings };

document.addEventListener("DOMContentLoaded", function () {
  renderDepartments();

  document
    .getElementById("emailNotifications")
    .addEventListener("change", function () {
      const options = document.getElementById("emailNotificationOptions");
      options.style.display = this.checked ? "block" : "none";

      const checkboxes = document.querySelectorAll(
        ".email-notification-option"
      );
      checkboxes.forEach((checkbox) => {
        checkbox.disabled = !this.checked;
      });
    });

  document
    .getElementById("addDepartmentBtn")
    .addEventListener("click", addDepartment);

  document
    .getElementById("newDepartment")
    .addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        addDepartment();
      }
    });

  document.getElementById("saveButton").addEventListener("click", saveSettings);

  document
    .getElementById("resetButton")
    .addEventListener("click", resetToDefaults);
});

function renderDepartments() {
  const container = document.getElementById("departmentBadges");
  container.innerHTML = "";

  currentSettings.departments.forEach((dept) => {
    const badge = document.createElement("div");
    badge.className = "department-badge";
    badge.innerHTML = `
          ${dept}
          <button class="remove-btn" onclick="removeDepartment('${dept}')">
            <i class="fas fa-times"></i>
          </button>
        `;
    container.appendChild(badge);
  });
}

function addDepartment() {
  const input = document.getElementById("newDepartment");
  const deptName = input.value.trim();

  if (deptName && !currentSettings.departments.includes(deptName)) {
    currentSettings.departments.push(deptName);
    renderDepartments();
    input.value = "";
  }
}

function removeDepartment(dept) {
  currentSettings.departments = currentSettings.departments.filter(
    (d) => d !== dept
  );
  renderDepartments();
}

function saveSettings() {
  currentSettings.companyName = document.getElementById("companyName").value;
  currentSettings.dailyWorkHours = parseInt(
    document.getElementById("dailyWorkHours").value
  );
  currentSettings.annualLeave = parseInt(
    document.getElementById("annualLeave").value
  );
  currentSettings.sickLeave = parseInt(
    document.getElementById("sickLeave").value
  );
  currentSettings.maternityLeave = parseInt(
    document.getElementById("maternityLeave").value
  );
  currentSettings.marriageLeave = parseInt(
    document.getElementById("marriageLeave").value
  );
  currentSettings.bereavementLeave = parseInt(
    document.getElementById("bereavementLeave").value
  );
  currentSettings.unpaidLeave = parseInt(
    document.getElementById("unpaidLeave").value
  );
  currentSettings.autoApproveShortLeave = document.getElementById(
    "autoApproveShortLeave"
  ).checked;
  currentSettings.recordsPerPage = parseInt(
    document.getElementById("recordsPerPage").value
  );
  currentSettings.canAddEmployee =
    document.getElementById("canAddEmployee").checked;
  currentSettings.canUpdateEmployee =
    document.getElementById("canUpdateEmployee").checked;
  currentSettings.canRemoveEmployee =
    document.getElementById("canRemoveEmployee").checked;
  currentSettings.salaryViewPermission = document.getElementById(
    "salaryViewPermission"
  ).value;
  currentSettings.emailNotifications =
    document.getElementById("emailNotifications").checked;
  currentSettings.newEmployeeNotification = document.getElementById(
    "newEmployeeNotification"
  ).checked;
  currentSettings.salaryUpdateNotification = document.getElementById(
    "salaryUpdateNotification"
  ).checked;
  currentSettings.leaveRequestNotification = document.getElementById(
    "leaveRequestNotification"
  ).checked;
  currentSettings.approvalNotification = document.getElementById(
    "approvalNotification"
  ).checked;
  currentSettings.dateFormat = document.getElementById("dateFormat").value;
  currentSettings.timeFormat = document.getElementById("timeFormat").value;
  currentSettings.sessionTimeout = parseInt(
    document.getElementById("sessionTimeout").value
  );
  currentSettings.maxLoginAttempts = parseInt(
    document.getElementById("maxLoginAttempts").value
  );
  currentSettings.loggingEnabled =
    document.getElementById("loggingEnabled").checked;
  currentSettings.autoBackup = document.getElementById("autoBackup").checked;

  const saveButton = document.getElementById("saveButton");
  const originalText = saveButton.innerHTML;
  saveButton.innerHTML =
    '<i class="fas fa-spinner fa-spin"></i> Kaydediliyor...';
  saveButton.disabled = true;

  setTimeout(() => {
    const success = Math.random() > 0.3;

    showAlert(
      success ? "success" : "danger",
      success
        ? "Ayarlar başarıyla kaydedildi!"
        : "Ayarlar kaydedilirken bir hata oluştu. Lütfen tekrar deneyin."
    );

    saveButton.innerHTML = originalText;
    saveButton.disabled = false;

    console.log("Kaydedilen ayarlar:", currentSettings);
  }, 1500);
}

function resetToDefaults() {
  currentSettings = { ...defaultSettings };

  document.getElementById("companyName").value = currentSettings.companyName;
  document.getElementById("dailyWorkHours").value =
    currentSettings.dailyWorkHours;
  document.getElementById("annualLeave").value = currentSettings.annualLeave;
  document.getElementById("sickLeave").value = currentSettings.sickLeave;
  document.getElementById("maternityLeave").value =
    currentSettings.maternityLeave;
  document.getElementById("marriageLeave").value =
    currentSettings.marriageLeave;
  document.getElementById("bereavementLeave").value =
    currentSettings.bereavementLeave;
  document.getElementById("unpaidLeave").value = currentSettings.unpaidLeave;
  document.getElementById("autoApproveShortLeave").checked =
    currentSettings.autoApproveShortLeave;
  document.getElementById("recordsPerPage").value =
    currentSettings.recordsPerPage;
  document.getElementById("canAddEmployee").checked =
    currentSettings.canAddEmployee;
  document.getElementById("canUpdateEmployee").checked =
    currentSettings.canUpdateEmployee;
  document.getElementById("canRemoveEmployee").checked =
    currentSettings.canRemoveEmployee;
  document.getElementById("salaryViewPermission").value =
    currentSettings.salaryViewPermission;
  document.getElementById("emailNotifications").checked =
    currentSettings.emailNotifications;
  document.getElementById("newEmployeeNotification").checked =
    currentSettings.newEmployeeNotification;
  document.getElementById("salaryUpdateNotification").checked =
    currentSettings.salaryUpdateNotification;
  document.getElementById("leaveRequestNotification").checked =
    currentSettings.leaveRequestNotification;
  document.getElementById("approvalNotification").checked =
    currentSettings.approvalNotification;
  document.getElementById("dateFormat").value = currentSettings.dateFormat;
  document.getElementById("timeFormat").value = currentSettings.timeFormat;
  document.getElementById("sessionTimeout").value =
    currentSettings.sessionTimeout;
  document.getElementById("maxLoginAttempts").value =
    currentSettings.maxLoginAttempts;
  document.getElementById("loggingEnabled").checked =
    currentSettings.loggingEnabled;
  document.getElementById("autoBackup").checked = currentSettings.autoBackup;

  const options = document.getElementById("emailNotificationOptions");
  options.style.display = currentSettings.emailNotifications ? "block" : "none";

  renderDepartments();

  showAlert("success", "Ayarlar varsayılan değerlere sıfırlandı.");
}

function showAlert(type, message) {
  const alertArea = document.getElementById("alertArea");
  alertArea.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show d-flex align-items-center" role="alert">
          <i class="fas fa-${
            type === "success" ? "check-circle" : "exclamation-circle"
          } me-2"></i>
          <div>${message}</div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
        </div>
      `;
  alertArea.style.display = "block";

  setTimeout(() => {
    const alert = document.querySelector(".alert");
    if (alert) {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }
  }, 5000);
}

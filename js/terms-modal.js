document.addEventListener("DOMContentLoaded", () => {
  const termsModal = document.getElementById("terms-modal");
  const openTermsBtn = document.getElementById("open-terms-modal");
  const closeTermsBtn = document.getElementById("close-terms-modal");
  const acceptTermsBtn = document.getElementById("accept-terms-btn");
  const termsCheckbox = document.getElementById("terms-checkbox");

  if (!termsModal || !openTermsBtn || !termsCheckbox) return;

  const closeTerms = () => {
    termsModal.classList.remove("active");
    document.body.style.overflow = "";
  };

  openTermsBtn.addEventListener("click", (e) => {
    e.preventDefault();
    termsModal.classList.add("active");
    document.body.style.overflow = "hidden";
  });

  if (closeTermsBtn) {
    closeTermsBtn.addEventListener("click", closeTerms);
  }

  termsModal.addEventListener("click", (e) => {
    if (e.target === termsModal) {
      closeTerms();
    }
  });

  if (acceptTermsBtn) {
    acceptTermsBtn.addEventListener("click", () => {
      termsCheckbox.checked = true;
      closeTerms();
    });
  }

  termsCheckbox.addEventListener("invalid", function () {
    this.setCustomValidity(
      "Please check this box to agree to our Terms and Conditions."
    );
  });

  termsCheckbox.addEventListener("input", function () {
    this.setCustomValidity("");
  });
});

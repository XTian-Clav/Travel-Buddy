document.addEventListener("DOMContentLoaded", () => {
  const toggleButtons = document.querySelectorAll(".password-toggle");

  toggleButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const targetId = btn.getAttribute("data-toggle-for");
      const passwordInput = document.getElementById(targetId);
      const icon = btn.querySelector("i");

      if (!passwordInput || !icon) return;

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.replace("ri-eye-line", "ri-eye-off-line");
      } else {
        passwordInput.type = "password";
        icon.classList.replace("ri-eye-off-line", "ri-eye-line");
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const toasts = document.querySelectorAll(".toast");

  toasts.forEach((toast) => {
    const autoCloseTimer = setTimeout(() => dismissToast(toast), 4000);
    const closeBtn = toast.querySelector(".toast__close-btn");
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        clearTimeout(autoCloseTimer);
        dismissToast(toast);
      });
    }
  });

  function dismissToast(toast) {
    if (!toast) return;

    toast.style.opacity = "0";
    toast.style.transform = "translateY(20px)";

    toast.addEventListener("transitionend", () => toast.remove(), {
      once: true,
    });
  }
});

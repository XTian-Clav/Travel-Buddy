document.addEventListener("DOMContentLoaded", () => {
  const profileModal = document.getElementById("profile-modal");
  const openProfileBtn = document.getElementById("open-profile-modal");
  const closeProfileBtn = document.getElementById("close-profile-modal");

  if (!profileModal || !openProfileBtn) return;

  const closeProfile = () => {
    profileModal.classList.remove("active");
    document.body.style.overflow = "";
  };

  openProfileBtn.addEventListener("click", (e) => {
    e.preventDefault();
    profileModal.classList.add("active");
    document.body.style.overflow = "hidden";
  });

  if (closeProfileBtn) {
    closeProfileBtn.addEventListener("click", closeProfile);
  }

  profileModal.addEventListener("click", (e) => {
    if (e.target === profileModal) {
      closeProfile();
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const inputModal = document.getElementById("input-modal");
  const previewModal = document.getElementById("preview-modal");
  const successModal = document.getElementById("success-modal");
  const confirmForm = document.getElementById("confirm-itinerary-form");

  // Guard Clause: Break early if critical layout structures are missing
  if (!inputModal || !previewModal || !confirmForm) {
    console.error("Missing modal elements");
    return;
  }

  const toPreviewBtn = document.getElementById("to-preview-btn");
  const closeInputModal = document.getElementById("close-input-modal");
  const closePreviewModal = document.getElementById("close-preview-modal");
  const closeSuccessModal = document.getElementById("close-success-modal");

  const startDateInput = document.getElementById("start_date");
  const endDateInput = document.getElementById("end_date");
  const travelersInput = document.getElementById("travelers");

  const modalTravelersPreview = document.getElementById(
    "modal-travelers-preview"
  );
  const modalDatesPreview = document.getElementById("modal-dates-preview");
  const modalTitle = document.getElementById("modal-summary-title");
  const modalPrice = document.getElementById("modal-summary-price");
  const modalDesc = document.getElementById("modal-summary-desc");

  const hiddenInput = document.getElementById("hidden-package-input");
  const hiddenStartDate = document.getElementById("hidden-start-date");
  const hiddenEndDate = document.getElementById("hidden-end-date");
  const hiddenTravelers = document.getElementById("hidden-travelers");

  // Set default dates cleanly
  const formattedToday = new Date().toISOString().split("T")[0];
  startDateInput.value = formattedToday;
  startDateInput.min = formattedToday;
  endDateInput.min = formattedToday;

  // Simple Philippine Date Formatter
  const fmt = (d) =>
    new Date(d + "T00:00:00").toLocaleDateString("en-PH", {
      month: "short",
      day: "numeric",
      year: "numeric",
    });

  // Proceed to Preview Event
  toPreviewBtn?.addEventListener("click", () => {
    // Guard Clauses for field validation
    if (!startDateInput.value || !endDateInput.value) {
      alert("Please complete your travel dates.");
      return;
    }

    if (new Date(startDateInput.value) > new Date(endDateInput.value)) {
      alert("Start date cannot be after the end date.");
      return;
    }

    // Sync values to hidden elements and text previews
    hiddenStartDate.value = startDateInput.value;
    hiddenEndDate.value = endDateInput.value;
    hiddenTravelers.value = travelersInput.value || "1";

    modalTravelersPreview.textContent = travelersInput.value || "1";
    modalDatesPreview.textContent = `${fmt(startDateInput.value)} – ${fmt(
      endDateInput.value
    )}`;

    inputModal.classList.remove("active");
    previewModal.classList.add("active");
  });

  // Unified Modal Closing Listeners
  closeInputModal?.addEventListener("click", () =>
    inputModal.classList.remove("active")
  );
  closePreviewModal?.addEventListener("click", () =>
    previewModal.classList.remove("active")
  );
  closeSuccessModal?.addEventListener("click", () =>
    successModal.classList.remove("active")
  );

  // Select Itinerary Card Event
  document.querySelectorAll(".choose-itinerary-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      hiddenInput.value = btn.dataset.package;
      modalTitle.textContent = btn.dataset.title;
      modalDesc.textContent = btn.dataset.desc;
      modalPrice.textContent = btn.dataset.price;

      // Clean default resets
      startDateInput.value = formattedToday;
      endDateInput.value = "";
      travelersInput.value = "1";

      inputModal.classList.add("active");
    });
  });

  // Async Form Submission handling
  confirmForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const submitBtn = confirmForm.querySelector("button[type='submit']");
    const originalText = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = "Saving...";

    try {
      const response = await fetch(confirmForm.action, {
        method: "POST",
        body: new FormData(confirmForm),
      });

      // Guard Clause: Handle bad HTTP responses gracefully
      if (!response.ok) throw new Error("Server returned an error status");

      previewModal.classList.remove("active");
      successModal.classList.add("active");
    } catch (err) {
      console.error(err);
      alert("Network error or server down. Please try again.");
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
  });
});

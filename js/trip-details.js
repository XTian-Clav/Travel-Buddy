document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("trip-details-modal");
  const closeBtn = document.getElementById("close-trip-modal");

  if (!modal) return;

  const toggleModal = (open = true) => {
    modal.classList.toggle("active", open);
    document.body.style.overflow = open ? "hidden" : "";
  };

  if (closeBtn) {
    closeBtn.addEventListener("click", () => toggleModal(false));
  }

  modal.addEventListener("click", (e) => {
    if (e.target === modal) toggleModal(false);
  });

  document.addEventListener("click", async (e) => {
    const targetButton = e.target.closest(".view-trip-btn");
    if (!targetButton) return;

    const tripId = targetButton.dataset.id;
    if (!tripId) return;

    try {
      const response = await fetch(
        `profile.php?action=get_details&trip_id=${tripId}`
      );
      const data = await response.json();

      if (!data.success) {
        alert(data.message || "Could not retrieve details.");
        return;
      }

      renderTripDetails(data.trip, data.activities);
      toggleModal(true);
    } catch (error) {
      console.error("Error loading trip information:", error);
    }
  });

  function renderTripDetails(trip, activities) {
    const contentArea = document.getElementById("modal-trip-content");

    let activitiesHtml = "";
    if (activities.length === 0) {
      activitiesHtml = `<p class="td-modal__no-activities">No activities scheduled yet for this itinerary.</p>`;
    } else {
      let currentDay = null;
      activities.forEach((act) => {
        if (currentDay !== act.day_number) {
          currentDay = act.day_number;
          activitiesHtml += `<h5 class="td-modal__day-title">Day ${currentDay}</h5>`;
        }
        activitiesHtml += `
          <div class="td-modal__activity-item">
            <span class="td-modal__activity-dot">•</span>
            <span>${act.activity_name}</span>
          </div>
        `;
      });
    }

    // Dynamic background image is the only line left inline, everything else utilizes class selectors
    contentArea.innerHTML = `
      <div class="td-modal__banner" style="background-image: url('${
        trip.image
      }');">
        <div class="td-modal__overlay-shade"></div>
        <div class="td-modal__banner-info">
          <span class="td-modal__badge">${trip.trip_type}</span>
          <h3 class="td-modal__title">${trip.itinerary_name}</h3>
          <p class="td-modal__meta">
            <i class="ri-map-pin-line"></i> ${trip.destination} • ${
      trip.total_days
    } ${Number(trip.total_days) === 1 ? "Day" : "Days"}
          </p>
        </div>
      </div>

      <div class="td-modal__body">
        <div class="td-modal__grid">
          <div>
            <span class="td-modal__label">Schedule Period</span>
            <span class="td-modal__value">${trip.start_date} - ${
      trip.end_date
    }</span>
          </div>
          <div>
            <span class="td-modal__label">Total Travelers</span>
            <span class="td-modal__value">${trip.travelers} Person(s)</span>
          </div>
          <div class="td-modal__budget-row">
            <span class="td-modal__budget-label">Estimated Budget</span>
            <span class="td-modal__budget-price">₱${parseFloat(
              trip.estimated_budget
            ).toLocaleString(undefined, { minimumFractionDigits: 2 })}</span>
          </div>
        </div>

        <h4 class="td-modal__heading">Itinerary Overview</h4>
        <p class="td-modal__subheading">Sequential daily activity tracks saved onto this configuration.</p>
        
        <div class="td-modal__scroll-container">
          ${activitiesHtml}
        </div>
      </div>
    `;
  }
});

let currentStep = 1;
const totalSteps = 3;

document.addEventListener("DOMContentLoaded", () => {
  const startDateInput = document.getElementById("start_date");
  const endDateInput = document.getElementById("end_date"); // <-- Add this
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");
  const formattedToday = `${year}-${month}-${day}`;

  startDateInput.value = formattedToday;
  startDateInput.min = formattedToday;
  endDateInput.min = formattedToday;
});

const activitiesData = [
  {
    id: "kayaking",
    title: "Kayaking",
    desc: "Paddle through calm and scenic coastlines.",
    price: 1500,
    img: "assets/kayaking.webp",
  },
  {
    id: "beach-day",
    title: "Beach Day Out",
    desc: "Relax, swim, and sunbathe on golden sands.",
    price: 2000,
    img: "assets/nacpan.webp",
  },
  {
    id: "snorkeling",
    title: "Private Snorkeling",
    desc: "Explore vibrant marine life with a personal guide.",
    price: 3800,
    img: "assets/snorkeling.webp",
  },
  {
    id: "sunset-dinner",
    title: "Sunset Dinner",
    desc: "Savor a beachfront multi-course meal at sunset.",
    price: 1200,
    img: "assets/sunset-dinner.webp",
  },
  {
    id: "island-hopping",
    title: "Island Hopping Tour",
    desc: "Cruise to hidden beaches and tropical lagoons.",
    price: 2800,
    img: "assets/island-tour.webp",
  },
  {
    id: "spa",
    title: "Spa & Massage",
    desc: "Unwind with a premium relaxation treatment.",
    price: 1500,
    img: "assets/spa.webp",
  },
];

const stepContent = {
  1: {
    title: "Create Your Own Adventure",
    desc: "Choose your destination.",
  },
  2: {
    title: "Add Activities",
    desc: "Select activities to customize your trip.",
  },
  3: {
    title: "Review & Save",
    desc: "Check your itinerary before saving your trip.",
  },
};

function calculateTotalDays() {
  const start = document.getElementById("start_date").value;
  const end = document.getElementById("end_date").value;
  if (!start || !end) return 0;

  const startDate = new Date(start);
  const endDate = new Date(end);
  const diffTime = endDate - startDate;
  if (diffTime < 0) return 0;

  return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
}

function generateDayTabs(totalDays) {
  const navContainer = document.getElementById("day-tabs-nav");
  const wrapper = document.getElementById("day-panes-wrapper");

  navContainer.innerHTML = "";
  wrapper.innerHTML = "";

  if (totalDays <= 0) {
    navContainer.innerHTML =
      '<p class="error-text">Please select valid start and end dates.</p>';
    return;
  }

  for (let d = 1; d <= totalDays; d++) {
    const tabBtn = document.createElement("button");
    tabBtn.type = "button";
    tabBtn.className = `day-tab ${d === 1 ? "active" : ""}`;
    tabBtn.textContent = `Day ${d}`;
    tabBtn.setAttribute("data-day", d);
    tabBtn.addEventListener("click", () => switchDayTab(d));
    navContainer.appendChild(tabBtn);

    const pane = document.createElement("div");
    pane.className = `wizard__activities activities-pool ${
      d === 1 ? "active" : ""
    }`;
    pane.id = `day-pane-${d}`;

    activitiesData.forEach((act) => {
      pane.innerHTML += `
          <div class="wizard__card">
            <img src="${act.img}" alt="${act.title}" />
            <div class="wizard__card__content">
              <h4>${act.title}</h4>
              <p>${act.desc}</p>
              <div class="wizard__card__footer">
                <h5>₱${act.price.toLocaleString()} / person</h5>
                <label class="btn action-btn-label" id="label-${d}-${act.id}">
                  <input type="checkbox" name="activities[day_${d}][]" value="${
        act.id
      }" data-price="${act.price}" data-title="${act.title}" data-img="${
        act.img
      }" class="activity-checkbox" onchange="handleCheckboxState(this, ${d}, '${
        act.id
      }')" />
                  <span><i class="ri-add-line"></i> Add</span>
                </label>
              </div>
            </div>
          </div>
        `;
    });
    wrapper.appendChild(pane);
  }
}

function switchDayTab(dayIndex) {
  document
    .querySelectorAll(".day-tab")
    .forEach((btn) => btn.classList.remove("active"));
  document
    .querySelectorAll(".activities-pool")
    .forEach((pane) => pane.classList.remove("active"));

  document
    .querySelector(`.day-tab[data-day="${dayIndex}"]`)
    .classList.add("active");
  document.getElementById(`day-pane-${dayIndex}`).classList.add("active");
}

function handleCheckboxState(cb, day, id) {
  const label = document.getElementById(`label-${day}-${id}`);
  const textSpan = label.querySelector("span");

  if (cb.checked) {
    label.classList.add("selected");
    textSpan.innerHTML = '<i class="ri-check-line"></i> Added';
  } else {
    label.classList.remove("selected");
    textSpan.innerHTML = '<i class="ri-add-line"></i> Add';
  }
}

function compileReviewData() {
  const totalDays = calculateTotalDays();
  const selectedDest = document.querySelector(".destination-radio:checked");

  document.getElementById("summary-dest-title").textContent = `${
    selectedDest ? selectedDest.value : "Destination"
  }, Palawan`;
  document.getElementById("summary-dest-img").src = selectedDest
    ? selectedDest.getAttribute("data-img")
    : "assets/big-lagoon.webp";

  const rawStart = document.getElementById("start_date").value;
  const rawEnd = document.getElementById("end_date").value;
  let formattedDates = "---";

  if (rawStart && rawEnd) {
    const dateOptions = { month: "long", day: "numeric", year: "numeric" };
    const formatter = new Intl.DateTimeFormat("en-US", dateOptions);
    const startDateObj = new Date(rawStart.replace(/-/g, "/"));
    const endDateObj = new Date(rawEnd.replace(/-/g, "/"));
    formattedDates = `${formatter.format(startDateObj)} to ${formatter.format(
      endDateObj
    )}`;
  }

  document.getElementById("summary-dates").textContent = formattedDates;
  document.getElementById("summary-travelers-count").textContent = `${
    document.getElementById("travelers").value || 1
  } Traveler(s)`;
  document.getElementById("summary-stat-days").textContent = totalDays;

  const scheduleOutput = document.getElementById("review-schedule-output");
  scheduleOutput.innerHTML = "";

  let totalActivitiesCount = 0;
  let runningTotalBudget = 0;
  const totalTravelers =
    parseInt(document.getElementById("travelers").value) || 1;

  for (let d = 1; d <= totalDays; d++) {
    const checkedItems = document.querySelectorAll(
      `#day-pane-${d} input[type="checkbox"]:checked`
    );

    if (checkedItems.length > 0) {
      scheduleOutput.innerHTML += `
          <div class="wizard__day-header day-break">
            <span><i class="ri-calendar-event-line"></i> Day ${d}</span>
          </div>
        `;

      checkedItems.forEach((item) => {
        totalActivitiesCount++;
        const price = parseFloat(item.getAttribute("data-price"));
        runningTotalBudget += price * totalTravelers;

        scheduleOutput.innerHTML += `
            <div class="wizard__card">
              <img src="${item.getAttribute("data-img")}" alt="" />
              <div class="wizard__card__content">
                <h4>${item.getAttribute("data-title")}</h4>
                <p>Price: ₱${price.toLocaleString()} x ${totalTravelers} Traveler(s)</p>
              </div>
            </div>
          `;
      });
    }
  }

  if (totalActivitiesCount === 0) {
    scheduleOutput.innerHTML =
      '<p class="empty-state-text">No added activities yet.</p>';
  }

  document.getElementById("summary-stat-count").textContent =
    totalActivitiesCount;
  document.getElementById(
    "summary-stat-budget"
  ).textContent = `₱${runningTotalBudget.toLocaleString()}`;
  document.getElementById("modal-stat-count").textContent =
    totalActivitiesCount;
  document.getElementById(
    "modal-stat-budget"
  ).textContent = `₱${runningTotalBudget.toLocaleString()}`;
}

function renderStep(step) {
  if (step === 2) {
    generateDayTabs(calculateTotalDays());
  }
  if (step === 3) {
    compileReviewData();
  }

  document
    .querySelectorAll(".wizard-step-panel")
    .forEach((panel) => (panel.style.display = "none"));
  document.getElementById(`step-panel-${step}`).style.display = "block";

  document.getElementById("wizard-hero-title").textContent =
    stepContent[step].title;
  document.getElementById("wizard-hero-desc").textContent =
    stepContent[step].desc;

  for (let i = 1; i <= totalSteps; i++) {
    const indicator = document.getElementById(`step-indicator-${i}`);
    const iconSpan = indicator.querySelector(".step-icon");
    indicator.classList.remove("active", "completed");
    if (i === step) {
      indicator.classList.add("active");
      iconSpan.innerHTML = step;
    } else if (i < step) {
      indicator.classList.add("completed");
      iconSpan.innerHTML = '<i class="ri-check-line"></i>';
    } else {
      iconSpan.innerHTML = i;
    }
  }
  window.scrollTo({ top: 0, behavior: "smooth" });
}

document.getElementById("start_date").addEventListener("change", (e) => {
  document.getElementById("end_date").min = e.target.value;
  if (currentStep === 2) generateDayTabs(calculateTotalDays());
});

document.getElementById("end_date").addEventListener("change", () => {
  if (currentStep === 2) generateDayTabs(calculateTotalDays());
});

document.querySelectorAll(".destination-radio").forEach((radio) => {
  radio.addEventListener("change", () => {
    if (radio.checked) {
      document.getElementById("selected-dest-name").textContent = radio.value;
      document.getElementById("selected-dest-preview").src =
        radio.getAttribute("data-img");
      currentStep = 2;
      renderStep(currentStep);
    }
  });
});

document.querySelectorAll(".next-step-btn").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (currentStep === 1) {
      const selectedDest = document.querySelector(".destination-radio:checked");
      if (!selectedDest) {
        alert("Please select a destination before proceeding.");
        return;
      }
    }

    if (currentStep === 2) {
      const startDate = document.getElementById("start_date").value;
      const endDate = document.getElementById("end_date").value;

      if (!startDate || !endDate) {
        alert("Please select both a start date and an end date.");
        return;
      }

      const start = new Date(startDate);
      const end = new Date(endDate);
      if (end < start) {
        alert("The end date cannot be earlier than your start date.");
        return;
      }

      const checkedActivities = document.querySelectorAll(
        '#day-panes-wrapper input[type="checkbox"]:checked'
      );
      if (checkedActivities.length === 0) {
        alert(
          "Please select at least one activity for your trip before proceeding."
        );
        return;
      }
    }

    if (currentStep < totalSteps) {
      currentStep++;
      renderStep(currentStep);
    }
  });
});

document.querySelectorAll(".prev-step-btn, .change-dest-btn").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (currentStep > 1) {
      currentStep--;
      renderStep(currentStep);
    }
  });
});

const saveModal = document.getElementById("save-modal");
const successModal = document.getElementById("success-modal");
const openSaveBtn = document.getElementById("open-save-modal");
const closeSaveBtn = document.getElementById("close-save-modal");
const closeSuccessBtn = document.getElementById("close-success-modal");
const masterForm = document.getElementById("master-wizard-form");

if (openSaveBtn) {
  openSaveBtn.addEventListener("click", () => {
    saveModal.classList.add("active");
    document.body.style.overflow = "hidden";
  });
}

closeSaveBtn.addEventListener("click", () => {
  saveModal.classList.remove("active");
  document.body.style.overflow = "";
});

closeSuccessBtn.addEventListener("click", () => {
  successModal.classList.remove("active");
  document.body.style.overflow = "";
});

masterForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const submitBtn = masterForm.querySelector(".style-submit-btn");
  const originalBtnText = submitBtn.innerHTML;

  submitBtn.disabled = true;
  submitBtn.innerHTML = 'Saving... <i class="ri-loader-4-line ri-spin"></i>';

  const formData = new FormData(masterForm);

  try {
    const response = await fetch(masterForm.action, {
      method: masterForm.method,
      body: formData,
    });

    if (response.ok) {
      saveModal.classList.remove("active");
      successModal.classList.add("active");
    } else {
      alert("Something went wrong saving your itinerary. Please try again.");
    }
  } catch (error) {
    console.error("Submission error:", error);
    alert("Network error. Could not connect to the server.");
  } finally {
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalBtnText;
  }
});

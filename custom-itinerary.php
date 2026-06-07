<?php
require_once 'includes/config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Travel Buddy | Customized Itinerary</title>
  </head>

  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="home.php">
            <img src="assets/logo.svg" alt="logo" />
          </a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>

      <ul class="nav__links" id="nav-links">
        <div class="nav__buttons">
          <li>
            <a href="home.php">
              <button type="button" class="outlined__btn">
                <i class="ri-arrow-left-line"></i> Back To Home
              </button>
            </a>
          </li>
        </div>
      </ul>
    </nav>

    <header class="custom__hero">
      <div class="custom__overlay">
        <div class="custom__content">
          <h1 id="wizard-hero-title">Create Your Own Adventure</h1>
          <p id="wizard-hero-desc">
            Choose your destination and customize activities based on your
            preferred travel experience.
          </p>
        </div>
      </div>
    </header>

    <section class="wizard">
      <div class="section__container wizard__container">
        <div class="wizard__steps">
          <div class="wizard__step active" id="step-indicator-1">
            <span class="step-icon">1</span>
            <p>Choose Destination</p>
          </div>
          <div class="wizard__line"></div>
          <div class="wizard__step" id="step-indicator-2">
            <span class="step-icon">2</span>
            <p>Add Activities</p>
          </div>
          <div class="wizard__line"></div>
          <div class="wizard__step" id="step-indicator-3">
            <span class="step-icon">3</span>
            <p>Review & Save</p>
          </div>
        </div>

        <form
          id="master-wizard-form"
          method="POST"
          action="process-itinerary.php"
        >
          <div class="wizard-step-panel active" id="step-panel-1">
            <div class="wizard__header">
              <h2>Select Your Destination</h2>
              <p>
                Start by choosing where you want your customized trip to take
                place.
              </p>
            </div>

            <div class="wizard__destination__grid">
              <label class="wizard__destination__card">
                <input
                  type="radio"
                  name="destination"
                  value="El Nido"
                  class="destination-radio"
                  data-img="assets/big-lagoon.jpg"
                />
                <img src="assets/big-lagoon.jpg" alt="El Nido" />
                <div class="wizard__destination__overlay">
                  <div class="wizard__destination__badge">
                    El Nido <i class="ri-arrow-right-line"></i>
                  </div>
                </div>
              </label>

              <label class="wizard__destination__card">
                <input
                  type="radio"
                  name="destination"
                  value="Coron"
                  class="destination-radio"
                  data-img="assets/coron.jpg"
                />
                <img src="assets/coron.jpg" alt="Coron" />
                <div class="wizard__destination__overlay">
                  <div class="wizard__destination__badge">
                    Coron <i class="ri-arrow-right-line"></i>
                  </div>
                </div>
              </label>
            </div>
          </div>

          <div class="wizard-step-panel" id="step-panel-2">
            <div class="wizard__content">
              <div class="wizard__sidebar">
                <div class="wizard__destination">
                  <img
                    src="assets/big-lagoon.jpg"
                    alt="Destination Preview"
                    id="selected-dest-preview"
                  />
                  <div>
                    <h4 id="selected-dest-name">El Nido</h4>
                    <p>Palawan, Philippines</p>
                    <button type="button" class="outlined__btn change-dest-btn">
                      Change Destination
                    </button>
                  </div>
                </div>

                <div class="wizard__trip">
                  <h4 class="wizard__section-title">Trip Details</h4>
                  <div class="input__group">
                    <label for="start_date">Start Date</label>
                    <div class="date__wrapper">
                      <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        required
                      />
                    </div>
                  </div>
                  <div class="input__group">
                    <label for="end_date">End Date</label>
                    <div class="date__wrapper">
                      <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        required
                      />
                    </div>
                  </div>
                  <div class="input__group">
                    <label for="travelers">Travelers</label>
                    <div class="select__wrapper">
                      <select id="travelers" name="travelers" required>
                        <option value="1" selected>1 Traveler</option>
                        <option value="2">2 Travelers</option>
                        <option value="3">3 Travelers</option>
                        <option value="4+">4 Travelers</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="wizard__activities-container">
                <h4 class="wizard__section-title">Select Activities per Day</h4>

                <div class="day-tabs__container" id="day-tabs-nav"></div>

                <div id="day-panes-wrapper"></div>
              </div>
            </div>

            <div class="wizard__actions">
              <button
                type="button"
                class="wizard__btn wizard__btn--back prev-step-btn"
              >
                <i class="ri-arrow-left-line"></i> Back
              </button>
              <button
                type="button"
                class="wizard__btn wizard__btn--proceed next-step-btn"
              >
                Proceed <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>

          <div class="wizard-step-panel" id="step-panel-3">
            <div class="wizard__content dynamic-2-col">
              <div class="wizard__sidebar wizard__sidebar-wide">
                <h3>Activities</h3>
                <div
                  class="wizard__activities"
                  id="review-schedule-output"
                ></div>
              </div>

              <div class="wizard__sidebar">
                <h3>Trip Summary</h3>
                <div class="trip__card stacked-summary-card">
                  <img
                    src="assets/big-lagoon.jpg"
                    alt="Destination Preview"
                    id="summary-dest-img"
                  />
                  <div class="trip__details">
                    <div>
                      <h3 id="summary-dest-title">El Nido, Palawan</h3>
                      <p>
                        <i class="ri-calendar-line"></i>
                        <span id="summary-dates">---</span>
                      </p>
                      <p>
                        <i class="ri-user-line"></i>
                        <span id="summary-travelers-count">---</span>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="summary__stats-box">
                  <div class="summary__stat-item">
                    <span class="stat__label"
                      ><i class="ri-calendar-fill"></i> Total Days</span
                    >
                    <span class="stat__value" id="summary-stat-days">0</span>
                  </div>
                  <div class="summary__stat-item">
                    <span class="stat__label"
                      ><i class="ri-compass-3-fill"></i> Total Activities</span
                    >
                    <span class="stat__value" id="summary-stat-count">0</span>
                  </div>
                  <div class="summary__stat-item">
                    <span class="stat__label"
                      ><i class="ri-wallet-3-fill"></i> Estimated Budget</span
                    >
                    <span
                      class="stat__value text-primary"
                      id="summary-stat-budget"
                      >₱0</span
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="wizard__actions">
              <button
                type="button"
                class="wizard__btn wizard__btn--back prev-step-btn"
              >
                <i class="ri-arrow-left-line"></i> Back
              </button>
              <button
                type="button"
                id="open-save-modal"
                class="wizard__btn wizard__btn--proceed"
              >
                Proceed to Save <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>

          <div class="modal__overlay" id="save-modal">
            <div class="modal__card">
              <button type="button" class="modal__close" id="close-save-modal">
                <i class="ri-close-line"></i>
              </button>
              <h3>Save Your Trip</h3>
              <p class="modal__description">
                Name your itinerary and save it to your dashboard.
              </p>

              <div class="modal__mini-summary">
                <div>
                  <strong>Activities chosen:</strong>
                  <span id="modal-stat-count">0</span>
                </div>
                <div>
                  <strong>Total Budget:</strong>
                  <span id="modal-stat-budget">₱0</span>
                </div>
              </div>

              <div class="wizard__form">
                <div class="input__group">
                  <label for="itinerary_name">Itinerary Name</label>
                  <input
                    type="text"
                    id="itinerary_name"
                    name="itinerary_name"
                    placeholder="Enter itinerary name"
                    required
                  />
                </div>
                <button
                  type="submit"
                  class="wizard__btn wizard__btn--proceed style-submit-btn"
                >
                  Save Itinerary <i class="ri-save-line"></i>
                </button>
              </div>
            </div>
          </div>
        </form>

        <div class="modal__overlay" id="success-modal">
          <div class="modal__card success__card">
            <button
              type="button"
              class="modal__close success-close-btn"
              id="close-success-modal"
            >
              <i class="ri-close-line"></i>
            </button>
            <h2>Itinerary Saved!</h2>
            <p>Your trip has been saved to your profile.</p>
            <div class="success__actions">
              <a href="profile.php" class="success__btn--primary"
                >Go to Profile</a
              >
              <a href="home.php" class="success__btn--secondary"
                >Back to Home</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      let currentStep = 1;
      const totalSteps = 3;

      document.addEventListener("DOMContentLoaded", () => {
        const startDateInput = document.getElementById("start_date");
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        const formattedToday = `${year}-${month}-${day}`;
        startDateInput.value = formattedToday;
        startDateInput.min = formattedToday;
      });

      const activitiesData = [
        {
          id: "kayaking",
          title: "Kayaking",
          desc: "Paddle through calm and scenic coastlines.",
          price: 1500,
          img: "assets/kayaking.jpg",
        },
        {
          id: "beach-day",
          title: "Beach Day Out",
          desc: "Relax, swim, and sunbathe on golden sands.",
          price: 2000,
          img: "assets/nacpan.jpg",
        },
        {
          id: "snorkeling",
          title: "Private Snorkeling",
          desc: "Explore vibrant marine life with a personal guide.",
          price: 3800,
          img: "assets/snorkeling.jpg",
        },
        {
          id: "sunset-dinner",
          title: "Sunset Dinner",
          desc: "Savor a beachfront multi-course meal at sunset.",
          price: 1200,
          img: "assets/sunset-dinner.jpg",
        },
        {
          id: "island-hopping",
          title: "Island Hopping Tour",
          desc: "Cruise to hidden beaches and tropical lagoons.",
          price: 2800,
          img: "assets/island-tour.jpg",
        },
        {
          id: "spa",
          title: "Spa & Massage",
          desc: "Unwind with a premium relaxation treatment.",
          price: 1500,
          img: "assets/spa.jpg",
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
                      <label class="btn action-btn-label" id="label-${d}-${
              act.id
            }">
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
        const selectedDest = document.querySelector(
          ".destination-radio:checked"
        );

        document.getElementById("summary-dest-title").textContent = `${
          selectedDest ? selectedDest.value : "Destination"
        }, Palawan`;
        document.getElementById("summary-dest-img").src = selectedDest
          ? selectedDest.getAttribute("data-img")
          : "assets/big-lagoon.jpg";

        const rawStart = document.getElementById("start_date").value;
        const rawEnd = document.getElementById("end_date").value;
        let formattedDates = "---";

        if (rawStart && rawEnd) {
          const dateOptions = {
            month: "long",
            day: "numeric",
            year: "numeric",
          };
          const formatter = new Intl.DateTimeFormat("en-US", dateOptions);
          const startDateObj = new Date(rawStart.replace(/-/g, "\/"));
          const endDateObj = new Date(rawEnd.replace(/-/g, "\/"));
          formattedDates = `${formatter.format(
            startDateObj
          )} to ${formatter.format(endDateObj)}`;
        }

        document.getElementById("summary-dates").textContent = formattedDates;
        document.getElementById("summary-travelers-count").textContent = `${
          document.getElementById("travelers").value || 1
        } Traveler(s)`;
        document.getElementById("summary-stat-days").textContent = totalDays;

        const scheduleOutput = document.getElementById(
          "review-schedule-output"
        );
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
          const totalDays = calculateTotalDays();
          generateDayTabs(totalDays);
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
            document.getElementById("selected-dest-name").textContent =
              radio.value;
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
            const selectedDest = document.querySelector(
              ".destination-radio:checked"
            );
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

      document
        .querySelectorAll(".prev-step-btn, .change-dest-btn")
        .forEach((btn) => {
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
        submitBtn.innerHTML =
          'Saving... <i class="ri-loader-4-line ri-spin"></i>';

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
            alert(
              "Something went wrong saving your itinerary. Please try again."
            );
          }
        } catch (error) {
          console.error("Submission error:", error);
          alert("Network error. Could not connect to the server.");
        } finally {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnText;
        }
      });
    </script>
  </body>
</html>

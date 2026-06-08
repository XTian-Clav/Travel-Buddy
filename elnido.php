<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
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
    <title>Travel Buddy | El Nido</title>
  </head>
  <body class="bg-home">
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
              <button class="outlined__btn">
                <i class="ri-arrow-left-line"></i> Back To Home
              </button>
            </a>
          </li>
        </div>
      </ul>
    </nav>

    <section class="itinerary">
      <header class="palawan__hero bg-elnido">
        <div class="palawan__overlay">
          <div class="palawan__content">
            <h1>Discover El Nido</h1>
            <p>
              Curated island experiences, relaxing beaches, and unforgettable
              adventures in paradise.
            </p>
          </div>
        </div>
      </header>
      <div class="section__container itinerary__container">
        <h3 class="section__header" style="color: white">
          Suggested Itinerary Options
        </h3>
        <h2
          class="section__description"
          style="color: rgba(255, 255, 255, 0.85)"
        >
          Choose an itinerary that matches your travel style
        </h2>

        <div class="itinerary__grid">
          <div class="itinerary__card">
            <img src="assets/elnido-itinerary-a.jpg" alt="Itinerary A" />
            <div class="itinerary__content">
              <h4>Itinerary A</h4>
              <p class="itinerary__description">Relaxing & Explore</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Breakfast at resort</li>
                  <li>Visit Nacpan Beach</li>
                  <li>Relax / Swimming</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Lunch at beachfront cafe</li>
                  <li>Visit Las Cabanas Beach</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Spa / Massage Session</li>
                  <li>Sunset Dinner</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱1,800 – ₱2,500</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="elnido_package_a"
                  data-title="Itinerary A"
                  data-desc="Relaxing & Explore"
                  data-price="₱1,800 – ₱2,500"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>

          <div class="itinerary__card">
            <img src="assets/elnido-itinerary-b.jpg" alt="Itinerary B" />
            <div class="itinerary__content">
              <h4>Itinerary B</h4>
              <p class="itinerary__description">Island Hopping Adventure</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Breakfast at resort</li>
                  <li>Kayaking at Big Lagoon</li>
                  <li>Snorkeling session</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Seafood lunch</li>
                  <li>Visit Shimizu Island</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Night market visit</li>
                  <li>Beachfront dinner</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱2,100 – ₱2,600</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="elnido_package_b"
                  data-title="Itinerary B"
                  data-desc="Island Hopping Adventure"
                  data-price="₱2,100 – ₱2,600"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>

          <div class="itinerary__card">
            <img src="assets/elnido-itinerary-c.jpg" alt="Itinerary C" />
            <div class="itinerary__content">
              <h4>Itinerary C</h4>
              <p class="itinerary__description">Premium Leisure Experience</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Breakfast at luxury resort</li>
                  <li>Private boat island tour</li>
                  <li>Island photography tour</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Luxury beachfront lunch</li>
                  <li>Snorkeling in exclusive spots</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Couples massage</li>
                  <li>Fine dining sunset dinner</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱7,500 – ₱12,000</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="elnido_package_c"
                  data-title="Itinerary C"
                  data-desc="Premium Leisure Experience"
                  data-price="₱7,500 – ₱12,000"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal__overlay" id="save-modal">
      <form
        id="confirm-itinerary-form"
        action="process-choice.php"
        method="POST"
        class="modal__card"
      >
        <button type="button" class="modal__close" id="close-save-modal">
          <i class="ri-close-line"></i>
        </button>

        <input type="hidden" name="destination" value="El Nido" />
        <input
          type="hidden"
          name="itinerary_choice"
          id="hidden-package-input"
          value=""
        />

        <h3>Confirm Your Selection</h3>
        <p class="modal__description">
          Review your selected itinerary details before saving to your
          dashboard.
        </p>

        <div class="modal__mini-summary">
          <div style="width: 100%; text-align: left">
            <strong>Itinerary Package:</strong>
            <span id="modal-summary-title">Itinerary</span>
          </div>
        </div>

        <div class="modal__mini-summary">
          <div style="width: 100%; text-align: left">
            <strong>Title:</strong>
            <span id="modal-summary-desc"></span>
          </div>
        </div>

        <div class="modal__mini-summary">
          <div style="width: 100%; text-align: left">
            <strong>Destination:</strong>
            <span>El Nido, Palawan</span>
          </div>
        </div>

        <div class="modal__mini-summary">
          <div style="width: 100%; text-align: left">
            <strong>Estimated Cost:</strong>
            <span id="modal-summary-price">₱0</span>
          </div>
        </div>

        <div class="wizard__form">
          <button
            type="submit"
            class="style-submit-btn wizard__btn wizard__btn--proceed"
            id="confirm-submit-btn"
          >
            Save Itinerary <i class="ri-save-line"></i>
          </button>
        </div>
      </form>
    </div>

    <div class="modal__overlay" id="success-modal">
      <div class="modal__card success__card">
        <button
          type="button"
          class="modal__close"
          id="close-success-modal"
          style="color: rgba(255, 255, 255, 0.7)"
        >
          <i class="ri-close-line"></i>
        </button>
        <div class="success__logo-container">
          <img src="assets/modal-logo.svg" alt="Travel Buddy Logo" />
        </div>
        <h2>Itinerary Saved!</h2>
        <p>Your trip has been saved to your profile.</p>
        <div class="success__actions">
          <a href="profile.php" class="success__btn--primary">Go to Profile</a>
          <a href="home.php" class="success__btn--secondary">Back to Home</a>
        </div>
      </div>
    </div>

    <script>
      const saveModal = document.getElementById("save-modal");
      const successModal = document.getElementById("success-modal");
      const closeSaveModal = document.getElementById("close-save-modal");
      const closeSuccessModal = document.getElementById("close-success-modal");
      const confirmForm = document.getElementById("confirm-itinerary-form");
      const hiddenInput = document.getElementById("hidden-package-input");

      const modalTitle = document.getElementById("modal-summary-title");
      const modalDesc = document.getElementById("modal-summary-desc");
      const modalPrice = document.getElementById("modal-summary-price");

      document.querySelectorAll(".choose-itinerary-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
          const packageKey = btn.getAttribute("data-package");
          const title = btn.getAttribute("data-title");
          const desc = btn.getAttribute("data-desc");
          const price = btn.getAttribute("data-price");

          if (hiddenInput) hiddenInput.value = packageKey;
          if (modalTitle) modalTitle.textContent = title;
          if (modalDesc) modalDesc.textContent = desc;
          if (modalPrice) modalPrice.textContent = price;

          if (saveModal) {
            saveModal.classList.add("active");
            document.body.style.overflow = "hidden";
          }
        });
      });

      const hideSaveModal = () => {
        if (saveModal) {
          saveModal.classList.remove("active");
          document.body.style.overflow = "";
        }
      };

      if (closeSaveModal) {
        closeSaveModal.addEventListener("click", hideSaveModal);
      }

      if (closeSuccessModal && successModal) {
        closeSuccessModal.addEventListener("click", () => {
          successModal.classList.remove("active");
          document.body.style.overflow = "";
        });
      }

      if (confirmForm) {
        confirmForm.addEventListener("submit", async (e) => {
          e.preventDefault();

          const submitBtn = document.getElementById("confirm-submit-btn");
          let originalBtnText = "";

          if (submitBtn) {
            originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
              'Saving... <i class="ri-loader-4-line ri-spin"></i>';
          }

          const formData = new FormData(confirmForm);

          try {
            const response = await fetch(confirmForm.action, {
              method: confirmForm.method,
              body: formData,
              headers: {
                "X-Requested-With": "XMLHttpRequest",
              },
            });

            if (response.ok) {
              hideSaveModal();
              if (successModal) {
                successModal.classList.add("active");
                document.body.style.overflow = "hidden";
              }
            } else {
              alert(
                "Something went wrong saving your itinerary. Please try again."
              );
            }
          } catch (error) {
            console.error("Submission error:", error);
            alert("Network error. Could not connect to the server.");
          } finally {
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = originalBtnText;
            }
          }
        });
      }
    </script>
  </body>
</html>

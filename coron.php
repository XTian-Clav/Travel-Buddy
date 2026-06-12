<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/views/predefined_view.php';
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
    <title>Travel Buddy | Coron</title>
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
      <header class="palawan__hero bg-coron">
        <div class="palawan__overlay">
          <div class="palawan__content">
            <h1>Explore Coron</h1>
            <p>
              Dive into crystal-clear lakes, majestic limestone cliffs, and
              world-class shipwreck adventures.
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
          <!-- Itinerary A -->
          <div class="itinerary__card">
            <img src="assets/itinerary-a-coron.webp" alt="Itinerary A" />
            <div class="itinerary__content">
              <h4>Itinerary A</h4>
              <p class="itinerary__description">Town Eco-Tour & Hot Springs</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Souvenir shopping downtown</li>
                  <li>Visit Lualhati Park</li>
                  <li>Cashew nut factory stopover</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Trek up Mt. Tapyas viewdeck</li>
                  <li>Soak in Maquinit Hot Springs</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Local seafood grill dinner</li>
                  <li>Relax at town center café</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱2,500 - ₱4,000</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="coron_package_a"
                  data-title="Itinerary A"
                  data-desc="Town Eco-Tour & Hot Springs"
                  data-price="₱2,500 - ₱4,000"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>

          <!-- Itinerary B -->
          <div class="itinerary__card">
            <img src="assets/itinerary-b-coron.webp" alt="Itinerary B" />
            <div class="itinerary__content">
              <h4>Itinerary B</h4>
              <p class="itinerary__description">Ultimate Island Hopping Tour</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Swim at Kayangan Lake</li>
                  <li>Snorkeling at Twin Peaks Reef</li>
                  <li>Explore Barracuda Lake</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Buffet lunch at Atwayan Beach</li>
                  <li>Relaxing kayak at Twin Lagoons</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Cocktails by the bay</li>
                  <li>Wood-fired pizza dinner</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱5,500 - ₱7,500</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="coron_package_b"
                  data-title="Itinerary B"
                  data-desc="Ultimate Island Hopping Tour"
                  data-price="₱5,500 - ₱7,500"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>

          <!-- Itinerary C -->
          <div class="itinerary__card">
            <img src="assets/itinerary-c-coron.webp" alt="Itinerary C" />
            <div class="itinerary__content">
              <h4>Itinerary C</h4>
              <p class="itinerary__description">Premium Reefs & Shipwrecks</p>
              <div class="itinerary__info">
                <h5><i class="ri-sun-fill"></i> Morning</h5>
                <ul>
                  <li>Snorkel Skeleton Wreck</li>
                  <li>Coral Garden marine exploration</li>
                  <li>Private speedboat navigation</li>
                </ul>
                <h5><i class="ri-sun-foggy-fill"></i> Afternoon</h5>
                <ul>
                  <li>Gourmet lunch at Pass Island</li>
                  <li>Lusong Gunboat dive exploration</li>
                </ul>
                <h5><i class="ri-moon-fill"></i> Evening</h5>
                <ul>
                  <li>Premium resort massage therapy</li>
                  <li>Fine dining hillside dinner</li>
                </ul>
              </div>
              <div class="itinerary__footer">
                <div class="price__tag">
                  <h5 class="price__label">Estimated Cost</h5>
                  <h3>₱10,500 - ₱16,000</h3>
                </div>
                <p class="price__note">
                  <i class="ri-information-line"></i> Prices may change
                  depending on the season and availability.
                </p>
                <button
                  type="button"
                  class="btn choose-itinerary-btn"
                  data-package="coron_package_c"
                  data-title="Itinerary C"
                  data-desc="Premium Reefs & Shipwrecks"
                  data-price="₱10,500 - ₱16,000"
                >
                  Choose Itinerary
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal__overlay" id="input-modal">
      <div class="modal__card">
        <div class="modal__header">
          <h3>Enter Trip Details</h3>
          <button type="button" class="modal__close" id="close-input-modal">
            <i class="ri-close-line"></i>
          </button>
        </div>
        <p class="modal__description">Fill in your travel details to continue.</p>
        <div class="modal__section">
          <div class="input__group">
            <label for="start_date">Start Date</label>
            <div class="date__wrapper">
              <input type="date" id="start_date" name="start_date" required />
            </div>
          </div>
          <div class="input__group">
            <label for="end_date">End Date</label>
            <div class="date__wrapper">
              <input type="date" id="end_date" name="end_date" required />
            </div>
          </div>
          <div class="input__group">
            <label for="travelers">Travelers</label>
            <div class="select__wrapper">
              <select id="travelers" name="travelers" required>
                <option value="1" selected>1 Traveler</option>
                <option value="2">2 Travelers</option>
                <option value="3">3 Travelers</option>
                <option value="4">4 Travelers</option>
              </select>
            </div>
          </div>
        </div>
        <div class="wizard__form">
          <button type="button" class="wizard__btn wizard__btn--proceed" id="to-preview-btn">
            Next <i class="ri-arrow-right-line"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="modal__overlay" id="preview-modal">
      <form
        id="confirm-itinerary-form"
        action="includes/predefined.include.php"
        method="POST"
        class="modal__card"
      >
        <input type="hidden" name="destination" value="Coron" />
        <input type="hidden" name="package_key" id="hidden-package-input" />
        <input type="hidden" name="start_date" id="hidden-start-date" />
        <input type="hidden" name="end_date" id="hidden-end-date" />
        <input type="hidden" name="travelers" id="hidden-travelers" />

        <h3>Trip Details<Summary></Summary></h3>
        <div class="modal__header">
          <button type="button" class="modal__close" id="close-preview-modal" style="margin-left: auto;">
            <i class="ri-close-line"></i>
          </button>
        </div>
        <p class="modal__description">
          Review itinerary details before saving to your Profile.
        </p>
        
        <div class="modal__section">
          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
              <strong>Destination:</strong> <span>Coron, Palawan</span>
            </div>
          </div>

          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
              <strong>Package:</strong> <span id="modal-summary-title">—</span>
            </div>
          </div>

          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
              <strong>Description:</strong> <span id="modal-summary-desc">—</span>
            </div>
          </div>
          
          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
              <strong>Estimated Cost:</strong> <span id="modal-summary-price">—</span>
            </div>
          </div>

          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
              <strong>Travelers:</strong> <span id="modal-travelers-preview">1</span>
            </div>
          </div>

          <div class="modal__mini-summary">
            <div style="width: 100%; text-align: left">
            <strong>Travel Dates:</strong> <span id="modal-dates-preview">—</span>
            </div>
          </div>
        </div>

        <div class="wizard__form">
          <button type="submit" class="wizard__btn wizard__btn--proceed style-submit-btn">
            Save Itinerary <i class="ri-save-line"></i>
          </button>
        </div>
      </form>
    </div>

    <div class="modal__overlay" id="success-modal">
      <div class="modal__card success__card">
        <button type="button" class="modal__close" id="close-success-modal">
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

    <script src="js/predefined.js" defer></script>
  </body>
</html>
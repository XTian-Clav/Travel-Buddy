<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/views/custom_view.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet" />
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
      <?php check_custom_errors(); ?>
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

        <form id="master-wizard-form" method="POST" action="includes/custom.include.php">
          <div class="wizard-step-panel active" id="step-panel-1">
            <div class="wizard__header">
              <h2>Select Your Destination</h2>
              <p>Start by choosing where you want your customized trip to take place.</p>
            </div>

            <div class="wizard__destination__grid">
              <label class="wizard__destination__card">
                <input type="radio" name="destination" value="El Nido" class="destination-radio" data-img="assets/big-lagoon.webp" />
                <img src="assets/big-lagoon.webp" alt="El Nido" />
                <div class="wizard__destination__overlay">
                  <div class="wizard__destination__badge">
                    El Nido <i class="ri-arrow-right-line"></i>
                  </div>
                </div>
              </label>

              <label class="wizard__destination__card">
                <input type="radio" name="destination" value="Coron" class="destination-radio" data-img="assets/coron.webp" />
                <img src="assets/coron.webp" alt="Coron" />
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
                  <img src="assets/big-lagoon.webp" alt="Destination Preview" id="selected-dest-preview" />
                  <div>
                    <h4 id="selected-dest-name">El Nido</h4>
                    <p>Palawan, Philippines</p>
                    <button type="button" class="outlined__btn change-dest-btn">Change Destination</button>
                  </div>
                </div>

                <div class="wizard__trip">
                  <h4 class="wizard__section-title">Trip Details</h4>
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
              <button type="button" class="wizard__btn wizard__btn--back prev-step-btn">
                <i class="ri-arrow-left-line"></i> Back
              </button>
              <button type="button" class="wizard__btn wizard__btn--proceed next-step-btn">
                Proceed <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>

          <div class="wizard-step-panel" id="step-panel-3">
            <div class="wizard__content dynamic-2-col">
              <div class="wizard__sidebar wizard__sidebar-wide">
                <h3>Activities</h3>
                <div class="wizard__activities" id="review-schedule-output"></div>
              </div>

              <div class="wizard__sidebar">
                <h3>Trip Summary</h3>
                <div class="trip__card stacked-summary-card">
                  <img src="assets/big-lagoon.webp" alt="Destination Preview" id="summary-dest-img" />
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
                    <span class="stat__label"><i class="ri-calendar-fill"></i> Total Days</span>
                    <span class="stat__value" id="summary-stat-days">0</span>
                  </div>
                  <div class="summary__stat-item">
                    <span class="stat__label"><i class="ri-compass-3-fill"></i> Total Activities</span>
                    <span class="stat__value" id="summary-stat-count">0</span>
                  </div>
                  <div class="summary__stat-item">
                    <span class="stat__label"><i class="ri-wallet-3-fill"></i> Estimated Budget</span>
                    <span class="stat__value text-primary" id="summary-stat-budget">₱0</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="wizard__actions">
              <button type="button" class="wizard__btn wizard__btn--back prev-step-btn">
                <i class="ri-arrow-left-line"></i> Back
              </button>
              <button type="button" id="open-save-modal" class="wizard__btn wizard__btn--proceed">
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
              <p class="modal__description">Name your itinerary and save it to your dashboard.</p>

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
                  <input type="text" id="itinerary_name" name="itinerary_name" placeholder="Enter itinerary name" required />
                </div>
                <button type="submit" class="wizard__btn wizard__btn--proceed style-submit-btn">
                  Save Itinerary <i class="ri-save-line"></i>
                </button>
              </div>
            </div>
          </div>
        </form>

        <div class="modal__overlay" id="success-modal">
          <div class="modal__card success__card">
            <button type="button" class="modal__close success-close-btn" id="close-success-modal">
              <i class="ri-close-line"></i>
            </button>
            <h2>Itinerary Saved!</h2>
            <p>Your trip has been saved to your profile.</p>
            <div class="success__actions">
              <a href="profile.php" class="success__btn--primary">Go to Profile</a>
              <a href="home.php" class="success__btn--secondary">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="js/custom-itinerary.js" defer></script>
  </body>
</html>
<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/profile.include.php';
require_once 'includes/views/login_view.php';
require_once 'includes/views/profile_view.php';
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
    <title>Travel Buddy | Profile</title>
  </head>

  <body>
    <?php check_profile_errors(); ?>

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
        <li><a href="home.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="profile.php" class="active">Profile</a></li>
        <div class="nav__buttons">
          <li>
            <a href="includes/logout.php"
              ><button class="outlined__btn">
                <i class="ri-logout-box-r-line"></i>Logout
              </button></a
            >
          </li>
        </div>
      </ul>
    </nav>

    <section class="profile__hero">
      <div class="profile__overlay">
        <div class="profile__hero__content">
          <h1>User Profile & Saved Trips</h1>
          <p>Manage your account and explore your saved itineraries.</p>
        </div>
      </div>
    </section>

    <section class="profile">
      <div class="section__container profile__container">
        <div class="profile__sidebar">
          <div class="profile__card">
            <div class="profile__image">
              <img src="assets/profile.png" alt="profile" />
            </div>
            <h3><?php output_username(); ?></h3>
            <p>Travel Explorer</p>
            <div class="profile__info">
              <div class="info__item">
                <span><i class="ri-mail-line"></i></span>
                <p><?php output_email(); ?></p>
              </div>
              <div class="info__item">
                <span><i class="ri-phone-line"></i></span>
                <p><?php output_contact(); ?></p>
              </div>
              <div class="info__item">
                <span><i class="ri-map-pin-line"></i></span>
                <p><?php output_address(); ?></p>
              </div>
            </div>
            <button class="btn profile__btn" id="open-profile-modal">
              <i class="ri-edit-line"></i>
              Edit Profile
            </button>
          </div>
        </div>
        <div class="profile__content">
          <div class="profile__title">
            <h2>Saved Trips</h2>
            <div class="dropdown">
              <button class="outlined__btn">
                <i class="ri-add-line"></i>
                New Trip
              </button>
              <div class="dropdown-content">
                <div class="dropdown-menu">
                  <a href="coron.php">Coron</a>
                  <a href="elnido.php">El Nido</a>
                  <a href="custom-itinerary.php">Custom</a>
                </div>
              </div>
            </div>
          </div>
          <div class="trip__grid">
            <?php if (has_no_trips($trips)): ?>
              <p>No saved trips yet.</p>
            <?php else: ?>
              <?php foreach ($trips as $trip): ?>
                <div class="trip__card">
                  <img src="<?php echo output_trip_image($trip['destination']); ?>" alt="trip" />
                  <div class="trip__details">
                    <div>
                      <h3><?php echo htmlspecialchars($trip['itinerary_name']); ?></h3>
                      <p>
                        <?php echo $trip['total_days']; ?> Day/s •
                        <?php echo $trip['total_activities']; ?> Activities
                      </p>
                    </div>
                    <div class="trip__actions">
                      <button class="btn">View Details</button>
                      <a href="profile.php?action=delete&trip_id=<?php echo $trip['id']; ?>"
                        onclick="return confirm('Are you sure you want to delete this trip?')">
                        <button class="outlined__btn">Delete</button>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <div class="modal__overlay" id="profile-modal">
      <div class="login__container" style="padding: 0; max-width: 500px; width: 100%;">
        <div class="login__card" style="position: relative; width: 100%;">
          
          <button type="button" class="modal__close" id="close-profile-modal" style="position: absolute; top: 20px; right: 20px; background: transparent; border: none; font-size: 1.5rem; cursor: pointer; color: inherit;">
            <i class="ri-close-line"></i>
          </button>

          <h2>Edit Profile</h2>
          <p class="login__description">
            Update your account information details below.
          </p>

          <form action="profile.php" method="POST">
            <div class="input__group" style="margin-bottom: 15px; text-align: left;">
              <label for="username" style="display: block; margin-bottom: 5px; font-weight: 600;">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                value="<?php echo htmlspecialchars($_SESSION["user_username"] ?? ''); ?>"
                required
              />
            </div>
            
            <div class="input__group" style="margin-bottom: 15px; text-align: left;">
              <label for="email" style="display: block; margin-bottom: 5px; font-weight: 600;">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($_SESSION["user_email"] ?? ''); ?>"
                required
              />
            </div>

            <div class="input__group" style="margin-bottom: 15px; text-align: left;">
              <label for="contact" style="display: block; margin-bottom: 5px; font-weight: 600;">Contact Number</label>
              <input
                type="text"
                id="contact"
                name="contact"
                value="<?php echo htmlspecialchars($_SESSION["user_contact"] ?? ''); ?>"
                required
              />
            </div>

            <div class="input__group" style="margin-bottom: 20px; text-align: left;">
              <label for="address" style="display: block; margin-bottom: 5px; font-weight: 600;">Address</label>
              <input
                type="text"
                id="address"
                name="address"
                value="<?php echo htmlspecialchars($_SESSION["user_address"] ?? ''); ?>"
                required
              />
            </div>

            <button type="submit" class="btn login__btn" style="width: 100%;">Save Changes</button>
          </form>
        </div>
      </div>
    </div>

    <script src="js/profile.js" defer></script>
    <script src="js/toast.js" defer></script>
  </body>
</html>
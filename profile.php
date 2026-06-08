<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/profile.include.php';
require_once 'includes/views/login_view.php';
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
            <button class="btn profile__btn">
              <i class="ri-edit-line"></i>
              Edit Profile
            </button>
          </div>
        </div>
        <div class="profile__content">
          <div class="profile__title">
            <h2>Saved Trips</h2>
            <button class="outlined__btn">
              <i class="ri-add-line"></i>
              New Trip
            </button>
          </div>
          <div class="trip__grid">
            <?php check_profile_errors(); ?>
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
                        <?php echo $trip['total_days']; ?> Days •
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
  </body>
</html>

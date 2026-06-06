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
            <a href="landing.php"
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
            <h3>Username</h3>
            <p>Travel Explorer</p>
            <div class="profile__info">
              <div class="info__item">
                <span><i class="ri-mail-line"></i></span>
                <p>username@email.com</p>
              </div>
              <div class="info__item">
                <span><i class="ri-phone-line"></i></span>
                <p>0912 345 6789</p>
              </div>
              <div class="info__item">
                <span><i class="ri-map-pin-line"></i></span>
                <p>Palawan, Philippines</p>
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
            <div class="trip__card">
              <img src="assets/big-lagoon.jpg" alt="trip" />
              <div class="trip__details">
                <div>
                  <h3>El Nido Getaway 2026</h3>
                  <p>3 Days • Relax & Explore</p>
                </div>
                <div class="trip__actions">
                  <button class="btn">View Details</button>
                  <button class="outlined__btn">Delete</button>
                </div>
              </div>
            </div>
            <div class="trip__card">
              <img src="assets/coron.jpg" alt="trip" />
              <div class="trip__details">
                <div>
                  <h3>Coron Island Adventure</h3>
                  <p>5 Days • Island Hopping</p>
                </div>
                <div class="trip__actions">
                  <button class="btn">View Details</button>
                  <button class="outlined__btn">Delete</button>
                </div>
              </div>
            </div>
            <div class="trip__card">
              <img src="assets/bacuit-bay.jpg" alt="trip" />
              <div class="trip__details">
                <div>
                  <h3>Bacuit Bay Experience</h3>
                  <p>3 Days • Beach Escape</p>
                </div>
                <div class="trip__actions">
                  <button class="btn">View Details</button>
                  <button class="outlined__btn">Delete</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

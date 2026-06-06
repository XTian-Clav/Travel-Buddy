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
    <title>Travel Buddy | Home Page</title>
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
        <li><a href="home.php" class="active">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="profile.php">Profile</a></li>
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

    <header class="home-hero">
      <div class="home-hero__content">
        <h1 class="home-hero__title">Plan Your Perfect Palawan Getaway</h1>
        <h2 class="home-hero__subtitle">
          Select the best destination to start planning your trip.
        </h2>
        <div class="home-hero__actions">
          <button class="hero__btn">Plan your Trip</button>
          <a href="custom-itinerary.php">
            <button class="hero__btn">Customized Itinerary</button>
          </a>
        </div>
        <div class="home-hero__divider">
          <span>Choose your Destination</span>
        </div>
        <div class="home-hero__grid">
          <a href="elnido.php" class="destination-link">
            <div class="destination-preview">
              <img src="assets/big-lagoon.jpg" alt="El Nido" />
              <div class="destination-preview__overlay">
                <div class="destination-preview__badge">
                  El Nido <i class="ri-arrow-right-line"></i>
                </div>
              </div>
            </div>
          </a>
          <a href="coron.php" class="destination-link">
            <div class="destination-preview">
              <img src="assets/coron.jpg" alt="Coron" />
              <div class="destination-preview__overlay">
                <div class="destination-preview__badge">
                  Coron <i class="ri-arrow-right-line"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </header>
  </body>
</html>

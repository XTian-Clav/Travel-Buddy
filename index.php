<?php
require_once 'includes/config.php';
require_once 'includes/guest.php';
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
    <title>Travel Buddy | Landing Page</title>
  </head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="index.php"><img src="assets/logo.svg" alt="logo" /></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-line"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <div class="nav__buttons">
          <li>
            <a href="register.php"><button class="outlined__btn">Register</button></a>
          </li>
          <li>
            <a href="login.php"><button class="btn">Login</button></a>
          </li>
        </div>
      </ul>
    </nav>

    <header class="header__container" id="home">
      <div class="header__overlay">
        <div class="header__content">
          <h1>
            Plan your Perfect Trip<br />
            on a Budget!
          </h1>
          <button class="hero__btn">Plan your Trip</button>
        </div>
      </div>
    </header>

    <section class="tour">
      <div class="tour__container">
        <div class="tour__header">
          <h3 class="tour__subtitle">You might like these</h3>
          <h2 class="tour__title">More Things To Do In Palawan</h2>
          <p class="tour__description">
            Explore more unforgettable destinations and island adventures across
            Palawan with premium tours and curated experiences.
          </p>
        </div>
        <div class="tour__grid">
          <div class="tour__card">
            <img src="assets/big-lagoon.webp" alt="El Nido Tour" />
            <div class="tour__overlay">
              <div class="tour__badge">
                <span>El Nido Tour</span>
                <i class="ri-arrow-right-line"></i>
              </div>
            </div>
          </div>
          <div class="tour__card">
            <img src="assets/coron.webp" alt="Coron Tour" />
            <div class="tour__overlay">
              <div class="tour__badge">
                <span>Coron Island Tour</span>
                <i class="ri-arrow-right-line"></i>
              </div>
            </div>
          </div>
          <div class="tour__card">
            <img src="assets/baywalk.webp" alt="Puerto Princesa Tour" />
            <div class="tour__overlay">
              <div class="tour__badge">
                <span>Puerto Princesa City Tour</span>
                <i class="ri-arrow-right-line"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

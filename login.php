<?php
require_once 'includes/config.php';
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
    <title>Travel Buddy | Login</title>
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
            <a href="register.php"
              ><button class="outlined__btn">Register</button></a
            >
          </li>
          <li>
            <a href="login.php"><button class="btn">Login</button></a>
          </li>
        </div>
      </ul>
    </nav>

    <section class="login">
      <div class="login__container">
        <div class="login__card">
          <h2>Login</h2>
          <p class="login__description">
            Login to continue accessing your account.
          </p>

          <div id="register-error-msg" class="form-error" style="none;"></div>
          <?php check_login_errors(); ?>

          <form action="includes/login.include.php" method="POST">
            <div class="input__group">
              <label for="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter your username"
                autocomplete="username"
                required
              />
            </div>
            <div class="input__group">
              <label for="password">Password</label>
              <div class="password__wrapper">
                <input
                  type="password"
                  id="password"
                  name="pwd"
                  placeholder="Enter your password"
                  required
                />
                <button
                  type="button"
                  class="password-toggle-btn"
                  id="toggle-password"
                >
                  <i class="ri-eye-line"></i>
                </button>
              </div>
            </div>
            <div class="login__options">
              <label class="remember">
                <input type="checkbox" name="remember" id="remember" />Remember
                me</label
              >
              <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn login__btn">Login</button>
          </form>
          <div class="login__divider"><span>OR</span></div>
          <div class="social__buttons">
            <a href="#" class="social__btn">
              <img src="assets/google.png" alt="Google" />Continue with Google
            </a>
            <a href="#" class="social__btn">
              <img src="assets/facebook.png" alt="Facebook" />Continue with
              Facebook
            </a>
          </div>
          <p class="signup__text">
            Don't have an account? <a href="register.php">Register</a>
          </p>
        </div>
      </div>
    </section>
    <script>
      const setupPasswordToggle = (toggleBtnId, passwordInputId) => {
        const toggleBtn = document.getElementById(toggleBtnId);
        const passwordInput = document.getElementById(passwordInputId);

        toggleBtn.addEventListener("click", () => {
          const icon = toggleBtn.querySelector("i");
          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("ri-eye-line");
            icon.classList.add("ri-eye-off-line");
          } else {
            passwordInput.type = "password";
            icon.classList.remove("ri-eye-off-line");
            icon.classList.add("ri-eye-line");
          }
        });
      };

      setupPasswordToggle("toggle-password", "password");

      const loginForm = document.querySelector("form");
      const errorContainer = document.getElementById("login-error-msg");

      loginForm.addEventListener("submit", (e) => {
        const username = document.getElementById("username").value.trim();
        errorContainer.style.display = "none";

        if (username.length < 3) {
          e.preventDefault();
          errorContainer.textContent =
            "Username must be at least 3 characters long.";
          errorContainer.style.display = "block";
        }
      });
    </script>
  </body>
</html>

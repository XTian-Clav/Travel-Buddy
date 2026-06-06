<?php
require_once 'includes/config.php';
require_once 'includes/views/register_view.php';
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
    <title>Travel Buddy | Register</title>
  </head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="landing.php"><img src="assets/logo.svg" alt="logo" /></a>
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
          <h2>Register</h2>
          <p class="login__description">
            Fill-up the details to create a new account.
          </p>

          <div id="register-error-msg" class="form-error" style="none;"></div>

          <?php check_register_errors(); ?>

          <form action="includes/register.include.php" method="POST" id="registration-form">
            <div class="input__group">
              <?php register_inputs('username'); ?>
            </div>
            <div class="input__group">
              <?php register_inputs('email'); ?>
            </div>
            <div class="input__group">
              <label for="password">Password</label>
              <div class="password__wrapper">
                <input
                  type="password"
                  id="password"
                  name="pwd"
                  placeholder="Enter your password"
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

            <div class="input__group">
              <label for="confirm-pwd">Confirm Password</label>
              <div class="password__wrapper">
                <input
                  type="password"
                  id="confirm-pwd"
                  name="confirm_pwd"
                  placeholder="Confirm your password"
                />
                <button
                  type="button"
                  class="password-toggle-btn"
                  id="toggle-confirm-pwd"
                >
                  <i class="ri-eye-line"></i>
                </button>
              </div>
            </div>
            <div class="login__options">
              <label class="remember">
                <input
                  type="checkbox"
                  name="terms"
                  id="terms-checkbox"
                  required
                />
                I agree to the
                <a href="#" id="open-terms-modal">Terms and Conditions</a>
              </label>
            </div>
            <button type="submit" class="btn login__btn">Register</button>
          </form>
          <div class="login__divider"><span>OR</span></div>
          <div class="social__buttons">
            <a href="#" class="social__btn">
              <img src="assets/google.png" alt="Google" />Register with Google
            </a>
            <a href="#" class="social__btn">
              <img src="assets/facebook.png" alt="Facebook" />Register with
              Facebook
            </a>
          </div>
          <p class="signup__text">
            Already have an account? <a href="login.php">Login</a>
          </p>
        </div>
      </div>
    </section>

    <div class="modal__overlay" id="terms-modal">
      <div class="modal__card" style="max-width: 600px; overflow-y: auto">
        <button type="button" class="modal__close" id="close-terms-modal">
          <i class="ri-close-line"></i>
        </button>

        <h3>Terms and Conditions</h3>
        <p class="modal__description">
          Please review our community guidelines and rules before joining Travel Buddy.
        </p>

        <div
          style="
            max-height: 250px;
            overflow-y: auto;
            margin-bottom: 1.5rem;
            padding-right: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.5;
            color: #555;
            text-align: justify;
            word-break: break-word;
          "
        >
          <p style="margin-bottom: 0.75rem">
            <strong>1. Authenticity and Identity</strong><br />To foster a safe environment, you must use the name you use in everyday life and provide accurate information about yourself. Creating fake accounts or misrepresenting your identity is strictly prohibited.
          </p>
          <p style="margin-bottom: 0.75rem">
            <strong>2. Permissions You Give Us</strong><br />You own the content (like trip photos, reviews, and itineraries) that you create and share on Travel Buddy. However, to provide our service, you grant us a non-exclusive, royalty-free, transferable license to host, use, and display your content.
          </p>
          <p style="margin-bottom: 0.75rem">
            <strong>3. Community Safety & Prohibited Conduct</strong><br />You may not use our platform to share content that violates our standards—including hate speech, harassment, fraudulent travel postings, or illegal behavior. We reserve the right to remove non-compliant content and suspend accounts.
          </p>
          <p style="margin-bottom: 0.75rem">
            <strong>4. Data Use and Privacy</strong><br />We collect and use your personal data, including location information and travel preferences, to connect you with relevant travel partners. By agreeing to these terms, you acknowledge our data policies.
          </p>
          <p style="margin-bottom: 0.75rem">
            <strong>5. Limitations of Liability</strong><br />We work constantly to provide a secure network, but we provide our platform "as is." We cannot guarantee that Travel Buddy will always be safe, secure, or function without errors, and we are not liable for user actions or off-platform interactions.
          </p>
        </div>

        <button
          type="button"
          id="accept-terms-btn"
          class="wizard__btn wizard__btn--proceed style-submit-btn"
          style="width: 100%; text-align: center; justify-content: center"
        >
          Accept Terms
        </button>
      </div>
    </div>

    <script>
      const termsModal = document.getElementById("terms-modal");
      const openTermsBtn = document.getElementById("open-terms-modal");
      const closeTermsBtn = document.getElementById("close-terms-modal");
      const acceptTermsBtn = document.getElementById("accept-terms-btn");
      const termsCheckbox = document.getElementById("terms-checkbox");
      const registerForm = document.getElementById("registration-form");

      openTermsBtn.addEventListener("click", (e) => {
        e.preventDefault();
        termsModal.classList.add("active");
        document.body.style.overflow = "hidden";
      });

      const closeTerms = () => {
        termsModal.classList.remove("active");
        document.body.style.overflow = "";
      };

      closeTermsBtn.addEventListener("click", closeTerms);

      termsModal.addEventListener("click", (e) => {
        if (e.target === termsModal) {
          closeTerms();
        }
      });

      acceptTermsBtn.addEventListener("click", () => {
        termsCheckbox.checked = true;
        closeTerms();
      });

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
      setupPasswordToggle("toggle-confirm-pwd", "confirm-pwd");

      termsCheckbox.addEventListener("invalid", function () {
        this.setCustomValidity("Please check this box to agree to our Terms and Conditions.");
      });

      termsCheckbox.addEventListener("input", function () {
        this.setCustomValidity("");
      });
    </script>
  </body>
</html>
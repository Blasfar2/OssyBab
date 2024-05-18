document.addEventListener("DOMContentLoaded", function () {

    // switch between Login and Register

  const signinBtn = document.querySelector(".signinBtn");
  const signupBtn = document.querySelector(".signupBtn");
  const formBx = document.querySelector(".formBx");
  const body = document.querySelector("body");

  signupBtn.onclick = function () {
    formBx.classList.add("active");
    body.classList.add("active");
  };

  signinBtn.onclick = function () {
    formBx.classList.remove("active");
    body.classList.remove("active");
  };


  // form validation of the usernam, email, password
  const form = document.querySelector(".signupForm form");
  if (form) {
    const usernameField = form.querySelector(".username-field");
    const usernameInput = usernameField.querySelector(".username");
    const emailField = form.querySelector(".email-field");
    const emailInput = emailField.querySelector(".email");
    const passField = form.querySelector(".create-password");
    const passInput = passField.querySelector(".password");
    const cPassField = form.querySelector(".confirm-password");
    const cPassInput = cPassField.querySelector(".cPassword");

    // Username Validation
    function checkUsername() {
      const usernamePattern = /^[a-zA-Z0-9_]{3,16}$/;
      if (!usernameInput.value.match(usernamePattern)) {
        return usernameField.classList.add("invalid");
      }
      usernameField.classList.remove("invalid");
    }

    // Email Validation
    function checkEmail() {
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (!emailInput.value.match(emailPattern)) {
        return emailField.classList.add("invalid");
      }
      emailField.classList.remove("invalid");
    }

    // Hide and show password
    const eyeIcons = document.querySelectorAll(".show-hide");

    eyeIcons.forEach((eyeIcon) => {
      eyeIcon.addEventListener("click", () => {
        const pInput = eyeIcon.parentElement.querySelector("input");
        if (pInput.type === "password") {
          eyeIcon.classList.replace("bx-hide", "bx-show");
          return (pInput.type = "text");
        }
        eyeIcon.classList.replace("bx-show", "bx-hide");
        pInput.type = "password";
      });
    });

    // Password Validation
    function createPass() {
      const passPattern =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      if (!passInput.value.match(passPattern)) {
        return passField.classList.add("invalid"); // adding invalid class if password input value do not match with passPattern
      }
      passField.classList.remove("invalid"); // removing invalid class if password input value matched with passPattern
    }

    // Confirm Password Validation
    function confirmPass() {
      if (passInput.value !== cPassInput.value || cPassInput.value === "") {
        return cPassField.classList.add("invalid");
      }
      cPassField.classList.remove("invalid");
    }

    // Calling Functions on Form Submit
    form.addEventListener("submit", function (e) {
      checkUsername();
      checkEmail();
      createPass();
      confirmPass();

      if (
        !usernameField.classList.contains("invalid") &&
        !emailField.classList.contains("invalid") &&
        !passField.classList.contains("invalid") &&
        !cPassField.classList.contains("invalid")
      ) {
        return true; // Allow form submission if all validations pass
      } else {
        e.preventDefault(); // Prevent form submission if any validation fails
      }
    });
  }
});

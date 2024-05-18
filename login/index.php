<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form</title>
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="blueBg">
      <div class="box signin">
        <h2>Already Have an Account</h2>
        <button class="signinBtn">Sign in</button>
      </div>

      <div class="box signup">
        <h2>Don't Have an Account ?</h2>
        <button class="signupBtn">Sign up</button>
      </div>
    </div>
    <div class="formBx">
      <div class="form signinForm">
        <form action="process.php" method="post">
          <h3>Sign In</h3>
          <div class="field email-field">
            <div class="input-field">
              <input type="email" placeholder="Enter your email" name="email" class="email" />
            </div>
            <span class="error email-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Please enter a valid email</p>
            </span>
          </div>
          <div class="field password-field">
            <div class="input-field">
              <input type="password" placeholder="Enter your password" name="password" class="password" />
              <i class="bx bx-hide show-hide"></i>
            </div>
            <span class="error password-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Please enter your password</p>
            </span>
          </div>
          <div class="input-field button">
            <input type="submit" name="login" value="Login" />
          </div>
          <!-- <a href="#" class="forgot">Forgot Password</a> -->
        </form>
      </div>

      <div class="form signupForm">
        <form action="process.php" method="post">
          <h3>Sign Up</h3>
          <div class="field username-field">
            <div class="input-field">
              <input type="text" placeholder="Enter your username" name="username" class="username" />
            </div>
            <span class="error username-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Please enter a valid username</p>
            </span>
          </div>
          <div class="field email-field">
            <div class="input-field">
              <input type="email" placeholder="Enter your email" name="email" class="email" />
            </div>
            <span class="error email-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Please enter a valid email</p>
            </span>
          </div>
          <div class="field create-password">
            <div class="input-field">
              <input type="password" placeholder="Create password" name="password" class="password" />
              <i class="bx bx-hide show-hide"></i>
            </div>
            <span class="error password-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Please enter at least 8 characters with number, symbol, small, and capital letter.</p>
            </span>
          </div>
          <div class="field confirm-password">
            <div class="input-field">
              <input type="password" placeholder="Confirm password" name="cPassword" class="cPassword" />
              <i class="bx bx-hide show-hide"></i>
            </div>
            <span class="error cPassword-error">
              <i class="bx bx-error-circle error-icon"></i>
              <p class="error-text">Password doesn't match</p>
            </span>
          </div>
          <div class="input-field button">
            <input type="submit" name="register" value="Register" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>

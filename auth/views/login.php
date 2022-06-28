<?php
include("../controllers/login.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="/ITECA3-Project/include/globalStyles.css" rel="stylesheet" />
  <script defer src="../controllers/loginScript.js"></script>

  <title>Login</title>
</head>

<body class="backColor">
  <div class="container py-5 h-100">
    <form method="post" action="login.php" name="form">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark bg-gradient text-white" style="border-radius: 3rem;">
            <div class="card-body p-5 text-center">

              <div class="-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-4">Login</h2>

                <div class="mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" name="email" class="form-control form-control-lg" />
                  <span class="error-message" name="email-error"></span>
                </div>

                <div class="mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" name="password" class="form-control form-control-lg" />
                  <span class="error-message" name="password-error"></span>
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Login</button>

              </div>

              <div>
                <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
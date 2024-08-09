<?php
session_start();

if (isset($_SESSION['name'])) {
  header('Location: ./home.php');
  exit;
}

$loginFailed = isset($_SESSION['login_failed']);
if ($loginFailed) {
  unset($_SESSION['login_failed']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login to PDF converter</title>
  <link rel="stylesheet" href="./style.css" />
  <style>

    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
    }
    .container {
        flex: 1;
    }
    footer {
        background-color: #f1f1f1;
        text-align: center;
        padding: 10px;
    }

  </style>
</head>

<body>
  <div class="container">
    <div class="box">
      <img src="./images/logo.png" alt="Logo">
      <h1 class="box__title"><br>Price Proposal<br>Login</h1>
      <p class="box__subtitle">Please log in to continue</p>
      <?php if ($loginFailed) : ?>
        <div class="alert">
          Incorrect username or password!
        </div>
      <?php endif; ?>
      <form action="./auth.php" method="post" class="form">
        <input type="text" class="form__input" placeholder="Username" name="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>" />
        <input type="password" class="form__input" placeholder="Password" name="password" required />
        <button class="form__button" type="submit" name="submit">LOGIN</button>
      </form>
    </div>
  </div>
  <footer>
    <div id="version">
      <p>v.1.3</p>
    </div>    
  </footer>
</body>
</html>

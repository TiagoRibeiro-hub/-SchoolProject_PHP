<?php
include_once 'header.php';
?>
<!---------------Register----------------------------------------------->
<?php
if (isset($_GET['reg'])) {
?>
  <section>
    <div class="container register">
      <div class="container register-container">
        <h3 class="login-title">Register</h3>
        <form action="database/reg_log_chg.php" method="post">
          <div class="row">
            <div class="col input-group">
              <label>First Name</label>
              <input type="text" name="firstname">
            </div>
            <div class="col input-group">
              <label>Second name</label>
              <input type="text" name="secondname">
            </div>
            <div class="col input-group">
              <label>User Name</label>
              <input type="text" name="username">
            </div>
          </div>
          <div class="row">
            <div class="col input-group">
              <label>E-mail</label>
              <input type="email" name="email">
            </div>
            <div class="col input-group">
              <label>Password</label>
              <input type="password" name="password">
            </div>
            <div class="col input-group">
              <label>Repeat Password</label>
              <input type="password" name="repeatpassword">
            </div>
          </div>
          <div class="row">
            <div class="col input-group">
              <label>Address</label>
              <input type="text" name="adress">
            </div>
          </div>
          <div class="row">
            <div class="col input-group">
              <label>Post-Code</label>
              <input type="text" name="postcode">
            </div>
            <div class="col input-group">
              <label>Localidade</label>
              <input type="text" name="localidade">
            </div>
          </div>
          <button type="submit" class="register-button" name="submit">Register</button>
          <div class="error">
            <!------------------------------>
            <!-- mensagens de erro registo-->
            <!------------------------------>
            <?php
            if (isset($_GET["error"])) {   // confirmar se existe o get error
              if ($_GET["error"] == "emptyInput") {
            ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">Fill All Fields!!</p>
              <?php
              } else if ($_GET["error"] == "invalidUsername") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">Invalid Username!!</p>
              <?php
              } else if ($_GET["error"] == "invalidEmail") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">Invalid e-mail!!</p>
              <?php
              } else if ($_GET["error"] == "wrongPass") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">Password Don´t Match!!</p>
              <?php
              } else if ($_GET["error"] == "useridExist") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">User already exist!!</p>
              <?php
              } else if ($_GET["error"] == "emailExist") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">E-mail already exist!!</p>
              <?php
              } else if ($_GET["error"] == "stmtfailed") {
              ?>
                <p style="color:red; font-size: 3rem; font-weight: bold; text-align: center">Something wrong, try again!!</p>
            <?php
              }
            }
            ?>
            <!--------------------------->
            <!-- FIM mensagens de erro -->
            <!--------------------------->
          </div>
        </form>
      </div>
    </div>
  </section>
  <!------------------------------------CHANGE INFO----------------------------------------------->
<?php
} else if (isset($_GET['chg'])) {
?>
  <section>
    <div class="container register">
      <div class="container register-container">
        <h3 class="login-title">Your Info</h3>
        <form action="database/reg_log_chg.php" method="post">
          <div class="row">
            <div class="col input-group">
              <label>User Name</label>
              <input type="text" name="user" value="<?php echo $_SESSION['user']['user']; ?>">
            </div>
          </div>
          <div class="row">
            <div class="col input-group">
              <label>Address</label>
              <input type="text" name="adress" value="<?php echo $_SESSION['user']['morada']; ?>">
            </div>
          </div>
          <div class="row">
            <div class="col input-group">
              <label>Post-Code</label>
              <input type="text" name="postcode" value="<?php echo $_SESSION['user']['codigo_postal']; ?>">
            </div>
            <div class="col input-group">
              <label>Localidade</label>
              <input type="text" name="localidade" value="<?php echo $_SESSION['user']['localidade']; ?>">
            </div>
            <button type="submit" class="register-button" name="change">Change</button>
            <button type="submit" class="register-button" name="delete">Delete Account</button>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php } ?>
<?php
include_once 'footer.php';
?>
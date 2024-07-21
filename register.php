<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Form</title>
    <link rel="stylesheet" href="Css/reg.css" />
  </head>
  <body>
    <div class="form-container">
      <form action="#">
        <header>
          <nav class="nav container">
            <h2 class="nav_logo"><a href="#">Faculty Evaluation System</a></h2>

            <ul class="menu_items">
              <img src="images/times.svg" alt="timesicon" id="menu_toggle" />
              <li><a href="index.html" class="nav_link">Home</a></li>
              <li><a href="#" class="nav_link">About</a></li>
              <li><a href="#" class="nav_link">Service</a></li>
              <li><a href="index.php" class="nav_link">Login</a></li>
              <li><a href="register.php" class="nav_link">Register</a></li>
            </ul>
            <img src="images/bars.svg" alt="timesicon" id="menu_toggle" />
          </nav>
        </header>
        <div class="form">
          <div class="details personal">
            <span class="title">Personal Details</span>
            <div class="fields">
              <div class="input-field">
                <label>Full Name</label>
                <input type="text" placeholder="Enter your name" required />
              </div>
              <div class="input-field">
                <label>Date of Birth</label>
                <input type="date" placeholder="Enter birth date" required />
              </div>
              <div class="input-field">
                <label>Email</label>
                <input type="text" placeholder="Enter your email" required />
              </div>
              <div class="input-field">
                <label>Mobile Number</label>
                <input
                  type="number"
                  placeholder="Enter mobile number"
                  required
                />
              </div>
              <div class="input-field">
                <label>Gender</label>
                <select required>
                  <option disabled selected>Select gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
              <div class="input-field">
                <label>Occupation</label>
                <input
                  type="text"
                  placeholder="Enter your occupation"
                  required
                />
              </div>
            </div>
          </div>
          <button class="submit">
            <span class="btnText">Submit</span>
            <i class="uil uil-navigator"></i>
          </button>
        </div>
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>

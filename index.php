<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Restaurant</title>

    <link rel="stylesheet" href="assets/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body>
    <!-- Navbar -->
    <div class="navbar">
      <div class="logo">Restaurant</div>
      <div class="nav-items">
        <a href="#"><i class="fa fa-bell"></i></a>
        <a href="#"><i class="fa fa-envelope"></i></a>
        <div class="profile">
          <img src="https://via.placeholder.com/40" alt="Profile Picture" />
          <span>Jenny Wilson</span>
        </div>
        <a href="forms/signup.php">Sign Up</a>
        <a href="forms/login.php">Log in</a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <a href="index.html" class="active"
        ><i class="icon fa fa-home"></i> <span>Floor</span></a
      >
      <a href="#"><i class="icon fa fa-th"></i> <span>Grid View</span></a>
      <a href="#"><i class="icon fa fa-clock"></i> <span>Timeline</span></a>
      <a href="#"><i class="icon fa fa-user-plus"></i><span>Guest</span></a>
      <a href="#"><i class="icon fa fa-comments"></i> <span>Chat</span></a>
      <a href="#"><i class="icon fa fa-chart-bar"></i> <span>Report</span></a>
      <a href="support.php"
        ><i class="icon fa fa-life-ring"></i> <span>Support</span></a
      >
      <a href="#"><i class="icon fa fa-gear"></i> <span>Settings</span></a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <section class="tables-content">
        <div class="reservations mr-4">
          <div class="reservations-head">
            <ul>
              <li class="tab active" data-tab="reservations">
                Reservations <span class="count">4</span>
              </li>
              <li class="tab" data-tab="waitlist">Waitlist</li>
              <li class="tab" data-tab="servers">Servers</li>
            </ul>
            <div class="search-filter m-2">
              <input type="text" placeholder="Search here" />
              <button class="filter-btn">
                <i class="fa fa-magnifying-glass"></i>
              </button>
            </div>
          </div>
          <div class="reservations-body tab-content" id="reservations">
            <h3>Lunch</h3>
            <div class="reservation-item">
              <div class="info">
                <p class="name">Filan Fisteku</p>
                <p style="font-size: 0.8rem">
                  <i class="fa fa-user"></i> 4 Person ·
                  <i class="fa fa-table"></i> Tables: 05, 06, 07
                </p>
              </div>
              <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
              <div class="info">
                <p class="name">Filan Fisteku</p>
                <p style="font-size: 0.8rem">
                  <i class="fa fa-user"></i> 4 Person ·
                  <i class="fa fa-table"></i> Tables: 05, 06, 07
                </p>
              </div>
              <div class="time">10:00 PM</div>
            </div>

            <h3>Dinner</h3>
            <div class="reservation-item">
              <div class="info">
                <p class="name">Filan Fisteku</p>
                <p style="font-size: 0.8rem">
                  <i class="fa fa-user"></i> 4 Person ·
                  <i class="fa fa-table"></i> Tables: 05, 06, 07
                </p>
              </div>
              <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
              <div class="info">
                <p class="name">Filan Fisteku</p>
                <p style="font-size: 0.8rem">
                  <i class="fa fa-user"></i> 4 Person ·
                  <i class="fa fa-table"></i> Tables: 05, 06, 07
                </p>
              </div>
              <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
              <div class="info">
                <p class="name">Filan Fisteku</p>
                <p style="font-size: 0.8rem">
                  <i class="fa fa-user"></i> 4 Person ·
                  <i class="fa fa-table"></i> Tables: 05, 06, 07
                </p>
              </div>
              <div class="time">10:00 PM</div>
            </div>
          </div>
        </div>
        <div class="tables">
          <div class="tables-head">
            <ul>
              <li class="tab" data-tab="dining-room">Main Dining Room</li>
              <li class="tab active" data-tab="outdoor">Outdoor</li>
              <li class="tab" data-tab="terrace">Terrace</li>
            </ul>
          </div>
          <div class="tables-body">
            <div class="tab-content" id="dining-room" style="display: none">
              <p>Content for Main Dining Room</p>
            </div>
            <div class="tab-content" id="outdoor">
              <div class="row">
                <div class="table">05</div>
                <div class="table">06</div>
                <div class="table">07</div>
                <div class="table">08</div>
                <div class="table">09</div>
              </div>

              <div class="row">
                <div class="table">05</div>
                <div class="table">05</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">05</div>
              </div>

              <div class="row">
                <div class="table">05</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">05</div>
              </div>

              <div class="row">
                <div class="table">05</div>
                <div class="table">05</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">05</div>
              </div>

              <div class="row">
                <div class="table">05</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">VIP</div>
                <div class="table">05</div>
              </div>
            </div>
            <div class="tab-content" id="terrace" style="display: none">
              <p>Content for Terrace</p>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      document.querySelectorAll(".reservations-head .tab").forEach((tab) => {
        tab.addEventListener("click", function () {
          const parent = this.closest(".reservations");

          parent
            .querySelectorAll(".tab")
            .forEach((item) => item.classList.remove("active"));

          this.classList.add("active");

          parent
            .querySelectorAll(".tab-content")
            .forEach((content) => (content.style.display = "none"));

          const targetContent = parent.querySelector(
            `#${this.getAttribute("data-tab")}`
          );
          if (targetContent) {
            targetContent.style.display = "block";
          }
        });
      });

      document.querySelectorAll(".tables-head .tab").forEach((tab) => {
        tab.addEventListener("click", function () {
          const parent = this.closest(".tables");

          parent
            .querySelectorAll(".tab")
            .forEach((item) => item.classList.remove("active"));

          this.classList.add("active");

          parent
            .querySelectorAll(".tab-content")
            .forEach((content) => (content.style.display = "none"));

          const targetContent = parent.querySelector(
            `#${this.getAttribute("data-tab")}`
          );
          if (targetContent) {
            targetContent.style.display = "block";
          }
        });
      });
    </script>
  </body>
</html>

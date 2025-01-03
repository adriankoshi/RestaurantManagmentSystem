<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | Restaurant</title>

  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="navbar">
    <div class="logo">Restaurant</div>
    <div class="nav-items">
      <a href="#"><i class="fa fa-bell"></i></a>
      <a href="#"><i class="fa fa-envelope"></i></a>
      <div class="profile">
        <img src="https://via.placeholder.com/40" alt="Profile Picture" />
        <span>Jenny Wilson</span>
      </div>
    </div>
  </div>


  <div class="sidebar">
    <a href="index.html" class="active"><i class="icon fa fa-home"></i> <span>Floor</span></a>
    <a href="#"><i class="icon fa fa-th"></i> <span>Grid View</span></a>
    <a href="#"><i class="icon fa fa-clock"></i> <span>Timeline</span></a>
    <a href="#"><i class="icon fa fa-user-plus"></i><span>Guest</span></a>
    <a href="#"><i class="icon fa fa-comments"></i> <span>Chat</span></a>
    <a href="#"><i class="icon fa fa-chart-bar"></i> <span>Report</span></a>
    <a href="support.php"><i class="icon fa fa-life-ring"></i> <span>Support</span></a>
    <a href="#"><i class="icon fa fa-gear"></i> <span>Settings</span></a>
  </div>

  <div class="main-content">
    <div class="support-contetn">
      <div class="banner">
        <div class="banner-contetn">
          <h1>Your favorite place to be!</h1>

        </div>
      </div>
    </div>

    <section class="faq-section">
      <h1>Frequently Asked Questions</h1>
      <p>Lorem ipsum dolor sit amet, consectetur.</p>

      <div class="faq-item">
        <div class="faq-question">
          <h3>What methods of payments are supported?</h3>
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>
            Cras vitae ac nunc orci. Purus amet tortor non at phasellus ultrices hendrerit.
            Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit vel donec.
          </p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <h3>Can I cancel at any time?</h3>
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Yes, you can cancel your subscription at any time.</p>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <h3>How do I get a receipt for my purchase?</h3>
          <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
          <p>Receipts are automatically emailed to you after your purchase.</p>
        </div>
      </div>
    </section>

    <section class="contact-form">
      <h1>Get In Touch</h1>
      <form action="#" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" class="input-name" name="name" placeholder="Your Name" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" class="input-email" name="email" placeholder="Your Email Address" required>
        </div>

        <div class="form-group">
          <label for="subject">Subject (Optional)</label>
          <input type="text" id="subject" class="input-subject" name="subject" placeholder="Title of email">
        </div>

        <div class="form-group full-width">
          <label for="message">Message</label>
          <textarea id="message" class="input-message" name="message" rows="6" placeholder="Write your message here"
            required></textarea>
        </div>

        <div class="form-group full-width">
          <button type="submit" class="btn-submit">Send Message</button>
        </div>
      </form>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle('open');
      });
    });

  </script>
</body>

</html>
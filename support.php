<?php
require_once 'includes/header.php';
?>
<!-- Banner Slider -->
<div class="banner-slider">
  <div class="banner-slide active" style="background-image: url('assets/images/banner/cta-about-banner.jpg');">
    <div class="banner-content">Your favorite place to be!</div>
  </div>
  <div class="banner-slide" style="background-image: url('assets/images/banner/f4b11bdd-cd6d-4309-b9be-303647bc4d2a.webp');">
    <div class="banner-content">Delicious Food Awaits You!</div>
  </div>
  <div class="banner-slide" style="background-image: url('assets/images/banner/f4b11bdd-cd6d-4309-b9be-303647bc4d2a.webp');">
    <div class="banner-content">Enjoy a Cozy Atmosphere!</div>
  </div>

  <!-- Navigation Dots -->
  <div class="banner-dots">
    <span class="dot active" onclick="changeSlide(0)"></span>
    <span class="dot" onclick="changeSlide(1)"></span>
    <span class="dot" onclick="changeSlide(2)"></span>
  </div>
</div>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll(".banner-slide");
  const dots = document.querySelectorAll(".dot");

  function changeSlide(index) {
    slides[currentSlide].classList.remove("active");
    dots[currentSlide].classList.remove("active");

    currentSlide = index;

    slides[currentSlide].classList.add("active");
    dots[currentSlide].classList.add("active");
  }

  function nextSlide() {
    let newIndex = (currentSlide + 1) % slides.length;
    changeSlide(newIndex);
  }

  setInterval(nextSlide, 5000); // Change every 5 seconds
</script>

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

<?php
// Ensure no output before this point
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $subject = htmlspecialchars($_POST["subject"]);
  $message = htmlspecialchars($_POST["message"]);

  $mail = new PHPMailer(true);

  try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sarikomutang@gmail.com';
    $mail->Password   = 'tubxewncunbmcqmf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('adriankoshi@temenx.com', 'PROJEKTI UBT');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = !empty($subject) ? $subject : 'No Subject';
    $mail->Body = "<h3>Message from: $name ($email)</h3><p>$message</p>";

    $mail->send();
    echo "<script>window.location.reload()</script>";
    exit();
  } catch (Exception $e) {
    exit();
  }
}
?>

<section class="contact-form">
  <h1>Get In Touch</h1>

  <form action="" method="POST">
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
      <textarea id="message" class="input-message" name="message" rows="6" placeholder="Write your message here" required></textarea>
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


<?php
require_once 'includes/footer.php';
?>
<?php
require_once 'includes/header.php';
?>
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


<?php
require_once 'includes/footer.php';
?>
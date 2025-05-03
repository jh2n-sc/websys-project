<!-- CONTACT SECTION FOR SELL PAGE -->
<section class="contact-section">
    <div class="contact-info">
        <h2>Still haven't found what you're looking for?</h2>
        <p>Let us know your preferences, and we'll help you find the perfect home.</p>
    </div>

    <form class="contact-form" id="sell-property-form">
        <!-- Corner L designs -->
        <div class="corner-design top-right"></div>
        <div class="corner-design top-left"></div>
        <div class="corner-design bottom-right"></div>
        <div class="corner-design bottom-left"></div>

        <h2>Tell us what you're looking for</h2>
        <div class="form-row">
            <input type="text" placeholder="First Name" required />
            <input type="text" placeholder="Last Name" required />
        </div>
        <div class="form-row">
            <textarea placeholder="Additional details about your wanted property (sq ft, bedrooms, features, etc.)"></textarea>
        </div>
        <button type="submit">Get Property Recommendation</button>
    </form>

    <!-- Message Sent Popover -->
    <div id="messageSentPopover" class="message-sent-popover">
        <div class="popover-content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h3>Thank You!</h3>
            <p>We've received your preferences. Our team will reach out with options that match what you're looking for!</p>
        </div>
    </div>
</section>

<style>
/* Contact Section */
.contact-section {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: stretch;
    max-width: 1200px;
    width: 90%;
    margin: 80px auto;
    background-color: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    flex-wrap: wrap;
    z-index: 5;
    padding: 0;
    border: 1px solid #eee;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.contact-section::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: radial-gradient(circle at 10% 20%, rgba(0, 0, 0, 0.03) 0%, transparent 20%),
                      radial-gradient(circle at 70% 65%, rgba(0, 0, 0, 0.02) 0%, transparent 30%),
                      radial-gradient(circle at 40% 85%, rgba(0, 0, 0, 0.01) 0%, transparent 40%);
    z-index: -1;
}

.contact-info {
    flex: 1;
    min-width: 300px;
    padding: 60px 40px;
    color: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #fff;
    position: relative;
    transition: all 0.3s ease;
}

.contact-info::before {
    position: absolute;
    height: 3px;
    width: 40px;
    background-color: #FFD700;
    top: 40px;
    left: 40px;
}

.contact-info h2 {
    font-size: 32px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 25px;
    background: linear-gradient(to right, #333, #666);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: translateY(0);
    transition: transform 0.5s ease;
}

.contact-info p {
    font-size: 18px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 15px;
    transform: translateY(0);
    transition: transform 0.5s ease;
    transition-delay: 0.1s;
}

.contact-form {
    flex: 1;
    min-width: 300px;
    position: relative;
    padding: 60px 40px;
    color: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #fff;
    transform: translateY(0);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: -5px 0 15px rgba(0, 0, 0, 0.03);
}

.contact-form h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #222;
    position: relative;
}

.contact-form h2::after {
    position: absolute;
    height: 2px;
    width: 40px;
    background-color: #FFD700;
    bottom: -10px;
    left: 0;
}

/* Corner L designs - styled like testimonial elements */
.corner-design {
    position: absolute;
    width: 30px;
    height: 30px;
    z-index: 1;
    transition: all 0.3s ease;
}

.top-right {
    top: 20px;
    right: 20px;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
    border-right: 2px solid rgba(0, 0, 0, 0.1);
}

.top-left {
    top: 20px;
    left: 20px;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
    border-left: 2px solid rgba(0, 0, 0, 0.1);
}

.bottom-right {
    bottom: 20px;
    right: 20px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    border-right: 2px solid rgba(0, 0, 0, 0.1);
}

.bottom-left {
    bottom: 20px;
    left: 20px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    border-left: 2px solid rgba(0, 0, 0, 0.1);
}

/* Form hover effects */
.contact-form:hover .corner-design {
    border-color: rgba(0, 0, 0, 0.2);
}

.form-row {
    display: flex;
    gap: 20px;
    width: 100%;
    margin-bottom: 25px;
    transform: translateY(0);
    transition: all 0.3s ease;
}

/* Create a staggered animation effect for form rows */
.form-row:nth-child(1) {
    transition-delay: 0.1s;
}

.form-row:nth-child(2) {
    transition-delay: 0.2s;
}

.form-row:nth-child(3) {
    transition-delay: 0.3s;
}

.contact-form input,
.contact-form textarea,
.contact-form select {
    width: 100%;
    padding: 12px 0;
    border: none;
    border-bottom: 1px solid #ddd;
    background-color: transparent;
    color: #333;
    font-size: 16px;
    transition: all 0.3s ease;
}

.contact-form select {
    appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
    background-repeat: no-repeat;
    background-position: right 0 center;
    cursor: pointer;
}

.contact-form input::placeholder,
.contact-form textarea::placeholder,
.contact-form select::placeholder {
    color: #999;
    transition: opacity 0.3s ease;
}

.contact-form input:focus::placeholder,
.contact-form textarea:focus::placeholder,
.contact-form select:focus::placeholder {
    opacity: 0.7;
}

.contact-form input:focus,
.contact-form textarea:focus,
.contact-form select:focus {
    outline: none;
    border-bottom-color: #FFD700;
}

.contact-form textarea {
    min-height: 100px;
    resize: vertical;
}

.contact-form button {
    padding: 14px 30px;
    margin-top: 20px;
    background-color: #333;
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    align-self: flex-start;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.contact-form button:hover {
    background-color: #222;
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.contact-form button:active {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

/* Message Sent Popover */
.message-sent-popover {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 0;
    display: none;
    max-width: 400px;
    width: 90%;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.popover-content {
    padding: 25px;
    text-align: center;
}

.success-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
}

.success-icon svg {
    color: #4CAF50;
    stroke-width: 2.5;
    height: 48px;
    width: 48px;
}

.message-sent-popover h3 {
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 10px;
    color: #333;
}

.message-sent-popover p {
    font-size: 16px;
    line-height: 1.6;
    margin: 0;
    color: #666;
}

/* Animations */
@keyframes fadeScale {
    0% { opacity: 0; transform: scale(0.98); }
    100% { opacity: 1; transform: scale(1); }
}

@keyframes slideInDown {
    0% { transform: translateY(-50px) translateX(-50%); opacity: 0; }
    100% { transform: translateY(0) translateX(-50%); opacity: 1; }
}

@keyframes slideOutUp {
    0% { transform: translateY(0) translateX(-50%); opacity: 1; }
    100% { transform: translateY(-50px) translateX(-50%); opacity: 0; }
}

.contact-section {
    animation: fadeScale 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Hover effects */
.contact-section:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Responsive Media Queries */
@media screen and (max-width: 1200px) {
    .contact-section {
        width: 95%;
    }
}

@media screen and (max-width: 992px) {
    .contact-section {
        padding: 0;
        margin: 60px auto;
    }

    .contact-info,
    .contact-form {
        padding: 50px 40px;
    }

    .contact-info h2 {
        font-size: 28px;
    }
}

@media screen and (max-width: 768px) {
    .contact-section {
        flex-direction: column;
        margin: 40px auto;
    }

    .contact-info,
    .contact-form {
        width: 100%;
        padding: 40px 30px;
    }

    .form-row {
        flex-direction: column;
        gap: 25px;
        margin-bottom: 0;
    }

    .contact-form input,
    .contact-form textarea,
    .contact-form select {
        margin-bottom: 15px;
    }

    .contact-form button {
        align-self: stretch;
    }
}

@media screen and (max-width: 576px) {
    .contact-section {
        width: 100%;
        border-radius: 0;
        margin: 30px 0;
    }

    .contact-info,
    .contact-form {
        padding: 40px 20px;
    }

    .contact-info h2 {
        font-size: 24px;
    }

    .contact-info p {
        font-size: 16px;
    }

    .corner-design {
        width: 20px;
        height: 20px;
    }
    
    .message-sent-popover {
        width: 95%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize popover as hidden
    const messageSentPopover = document.getElementById('messageSentPopover');
    if (messageSentPopover) {
        messageSentPopover.style.display = 'none';
    }
    
    // Add form submission handler
    const sellPropertyForm = document.getElementById('sell-property-form');
    if (sellPropertyForm) {
        sellPropertyForm.addEventListener('submit', handleMessageSent);
    }
});

function handleMessageSent(event) {
    event.preventDefault(); // Prevent actual form submission
    
    const messageSentPopover = document.getElementById('messageSentPopover');
    
    if (messageSentPopover) {
        // Show the popover with flex display and centered items
        messageSentPopover.style.display = 'flex';
        messageSentPopover.style.alignItems = 'center';
        messageSentPopover.style.animation = 'slideInDown 0.3s ease-out';
        
        // Hide after 3 seconds with slide-out animation
        setTimeout(() => {
            messageSentPopover.style.animation = 'slideOutUp 0.3s ease-out';
            
            // Wait for animation to complete before hiding
            setTimeout(() => {
                messageSentPopover.style.display = 'none';
                
                // Reset the form
                event.target.reset();
            }, 300);
        }, 3000);
    }
}
</script>
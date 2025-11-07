<!-- CONTACT SECTION FOR SELL PAGE -->
<section class="contact-section">
    <div class="contact-info">
        <h2>Still haven't found what you're looking for?</h2>
    </div>

    <form class="contact-form" id="sell-property-form">

        <h2>Tell us what you're looking for</h2>
        <div class="form-row">
            <input type="text" placeholder="First Name" required />
            <input type="text" placeholder="Last Name" required />
        </div>
        <div class="form-row">
            <textarea placeholder="Additional details about your wanted property (sq ft, bedrooms, features, etc.)"></textarea>
        </div>
        <div class="button-container">
            <button type="submit" class="btn btn-outline">Get Property Recommendation</button>
        </div>
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
    background-color: var(--surface-color);
    border-radius: 9999px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(var(--shadow-color), 0.12);
    flex-wrap: wrap;
    z-index: 5;
    padding: 0;
    border: 1px solid var(--border-color);
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
    color: var(--text-color);
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: transparent;
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
    color: var(--text-color);
    transform: translateY(0);
    transition: transform 0.5s ease;
}

.contact-info p {
    font-size: 18px;
    line-height: 1.8;
    color: var(--muted-text-color);
    margin-bottom: 15px;
    transform: translateY(0);
    transition: transform 0.5s ease;
    transition-delay: 0.1s;
}

.contact-form {
    flex: 1;
    min-width: 300px;
    padding: 60px 40px;
    background-color: var(--surface-color);
    position: relative;
    z-index: 1;
}

.contact-form h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 30px;
    color: var(--text-color);
    position: relative;
    padding-bottom: 15px;
}

.contact-form h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--accent-color);
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row input,
.form-row textarea {
    flex: 1;
    padding: 12px 20px;
    border: 1px solid var(--border-color);
    border-radius: 50px;
    font-size: 16px;
    color: var(--text-color);
    background-color: var(--input-bg);
    transition: all 0.3s ease;
    outline: none;
}

.form-row textarea {
    border-radius: 25px;
    min-height: 120px;
    resize: vertical;
}

.form-row input:focus,
.form-row textarea:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 2px rgba(var(--accent-rgb), 0.2);
}

.contact-form button,
.button-container .btn-outline {
    padding: 12px 26px;
    margin-top: 20px;
    background-color: transparent;
    color: var(--text-color);
    font-weight: 600;
    border: 2px solid #000000;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

[data-theme="dark"] .contact-form button,
[data-theme="dark"] .button-container .btn-outline {
    border-color: #ffffff;
    color: #ffffff;
}

.contact-form button:hover,
.button-container .btn-outline:hover {
    background-color: #000000;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

[data-theme="dark"] .contact-form button:hover,
[data-theme="dark"] .button-container .btn-outline:hover {
    background-color: #ffffff;
    color: #000000;
}

.contact-form button:active,
.button-container .btn-outline:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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

/* Removed corner design hover effects */

.form-row, .button-container {
    display: flex;
    gap: 20px;
    width: 100%;
    margin-bottom: 25px;
    transform: translateY(0);
    transition: all 0.3s ease;
}

.button-container {
    margin-top: 10px;
    margin-bottom: 0;
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
    border-bottom: 1px solid var(--border-color);
    background-color: transparent;
    color: var(--text-color);
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
    color: var(--muted-text-color);
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
    padding: 12px 26px;
    margin-top: 20px;
    background-color: var(--button-bg);
    color: var(--button-text);
    font-weight: 600;
    
    border-radius: 9999px;
    cursor: pointer;
    align-self: flex-start;
    transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease, transform 0.15s ease;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(var(--shadow-color), 0.1);
}

.contact-form button:hover {
    background-color: var(--button-text);
    color: var(--button-bg);
    border-color: var(--button-bg);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(var(--shadow-color), 0.15);
}

.contact-form button:active {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(var(--shadow-color), 0.1);
}

/* Button container for proper spacing */
.button-container {
    margin-top: 16px;
}

/* Message Sent Popover */
.message-sent-popover {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    background-color: var(--surface-color);
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(var(--shadow-color), 0.15);
    padding: 0;
    display: none;
    max-width: 400px;
    width: 90%;
    overflow: hidden;
    border: 1px solid var(--border-color);
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
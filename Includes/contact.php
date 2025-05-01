<!-- CONTACT SECTION -->
<section class="contact-section">
    <div class="contact-info">
        <h2>Still haven't found what you're looking for?</h2>
        <p>Let us know your preferences, and we'll help you find the perfect home.</p>
    </div>

    <form class="contact-form">
                <!-- Corner L designs -->
            <div class="corner-design top-right"></div>
            <div class="corner-design top-left"></div>
            <div class="corner-design bottom-right"></div>
            <div class="corner-design bottom-left"></div>

            <h2>Tell us what you need.</h2>
            <div class="form-row">
            <input type="text" placeholder="First Name" required />
            <input type="text" placeholder="Last Name" required />
        </div>
        <div class="form-row">
            <input type="text" placeholder="What are you looking for?" required />
        </div>
        <div class="form-row">
            <textarea placeholder="Notes"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
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
width: 40px;
background-color: #333;
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
width: 40px;
background-color: #333;
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
.contact-form textarea {
width: 100%;
padding: 12px 0;
border: none;
border-bottom: 1px solid #ddd;
background-color: transparent;
color: #333;
font-size: 16px;
transition: all 0.3s ease;
}

.contact-form input::placeholder,
.contact-form textarea::placeholder {
color: #999;
transition: opacity 0.3s ease;
}

.contact-form input:focus::placeholder,
.contact-form textarea:focus::placeholder {
opacity: 0.7;
}

.contact-form input:focus,
.contact-form textarea:focus {
outline: none;
border-bottom-color: #333;
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

/* Animations */
@keyframes fadeScale {
0% { opacity: 0; transform: scale(0.98); }
100% { opacity: 1; transform: scale(1); }
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
.contact-form textarea {
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
}
</style>
// -------------------- Popover --------------------
// Show property details in popover
function showPropertyDetails(id, name, price, beds, baths, size, location, date, type, propertyType, imageUrl) {
    
    // Update popover content
    document.getElementById('property-ID').value = id;
    document.getElementById('popover-property-type').textContent = type;
    document.getElementById('popover-property-price').textContent = '₱' + parseFloat(price).toLocaleString();
    document.getElementById('popover-property-beds').textContent = beds + ' bed';
    document.getElementById('popover-property-baths').textContent = baths + ' bath';
    document.getElementById('popover-property-size').textContent = size + ' m²';
    document.getElementById('popover-property-address').textContent = name;
    document.getElementById('popover-property-location').textContent = location;
    document.getElementById('popover-listing-date').textContent = date;
    document.getElementById('popover-property-image').src = imageUrl;
    
    // Add the property type description
    if (propertyType && propertyType !== 'NULL') {
        document.getElementById('popover-property-details-description').textContent = propertyType;
        document.getElementById('popover-property-details-description').style.display = 'block';
    } else {
        document.getElementById('popover-property-details-description').style.display = 'none';
    }
    
    // Show the popover
    document.getElementById('property-popover').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Hide property details popover
function hidePropertyDetails() {
    document.getElementById('property-popover').style.display = 'none';
    document.body.style.overflow = 'auto'; 
}

// For handling fake actions (wishlist, buy, message)
function handleFakeAction(action, button) {    
    if (action === 'wishlist') {
        button.classList.toggle('active');
        document.getElementById('wishlist-confirmation').style.display = 'block';
        setTimeout(() => {
            document.getElementById('wishlist-confirmation').style.display = 'none';
        }, 2000);
    } else if (action === 'message') {
        document.getElementById('messageSentPopover').style.display = 'block';
        setTimeout(() => {
            document.getElementById('messageSentPopover').style.display = 'none';
        }, 2000);
    }
}

// Handle buy action
function handleBuyAction(button) {
    // confirm
    document.getElementById('buy-confirmation').style.display = 'block';
    
    // Store in sessionStorage 
    sessionStorage.setItem('justPurchased', 'true');
    
    const form = button.closest('form');
    
    setTimeout(() => {
        form.submit();
    }, 2000);
}

// events set when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Checkpurchase
    if (sessionStorage.getItem('justPurchased') === 'true') {
        // notif
        const notification = document.createElement('div');
        notification.innerHTML = `
            <div style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #4CAF50; color: white; padding: 15px; 
            border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); z-index: 9999; display: flex; align-items: center;">
            <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i>
            <p style="margin: 0;">Thank you! We'll contact you shortly to proceed with your purchase.</p>
            </div>

        `;
        document.body.appendChild(notification);
        
        // Clear flag 
        sessionStorage.removeItem('justPurchased');
        
    
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }
    
    // Fix for close button
    const closeButton = document.querySelector('.close-popover');
    if (closeButton) {
        closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            hidePropertyDetails();
        });
    }
    
    // Close on clicking overlay
    const popoverOverlay = document.getElementById('property-popover');
    if (popoverOverlay) {
        popoverOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                hidePropertyDetails();
            }
        });
    }
    
    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hidePropertyDetails();
        }
    });
    
    // Stop property card click events from propagating to parent elements
    const propertyCards = document.querySelectorAll('.property-card');
    propertyCards.forEach(card => {
        // Prevent favorite button clicks from triggering the card's onclick
        const favoriteBtn = card.querySelector('.favorite-btn');
        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
});
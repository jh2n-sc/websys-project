// -------------------- Popover --------------------
// Show property details in popover
function showPropertyDetails(id, name, price, beds, baths, size, location, date, type, imageUrl) {
    
    // Update popover content
    document.getElementById('property-ID').value = id;
    document.getElementById('popover-property-type').textContent = type;
    document.getElementById('popover-property-price').textContent = '₱' + parseFloat(price).toLocaleString();
    document.getElementById('popover-property-beds').textContent = beds + ' bed';
    document.getElementById('popover-property-baths').textContent = baths + ' bath';
    document.getElementById('popover-property-size').textContent = size;
    document.getElementById('popover-property-address').textContent = name;
    document.getElementById('popover-property-location').textContent = location;
    document.getElementById('popover-listing-date').textContent = date;
    document.getElementById('popover-property-image').src = imageUrl;
    
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
    event.preventDefault(); // Prevent form submission
    
    if (action === 'wishlist') {
        button.classList.toggle('active');
        document.getElementById('wishlist-confirmation').style.display = 'block';
        setTimeout(() => {
            document.getElementById('wishlist-confirmation').style.display = 'none';
        }, 2000);
    } else if (action === 'buy') {
        document.getElementById('buy-confirmation').style.display = 'block';
        setTimeout(() => {
            document.getElementById('buy-confirmation').style.display = 'none';
        }, 2000);
    } else if (action === 'message') {
        document.getElementById('messageSentPopover').style.display = 'block';
        setTimeout(() => {
            document.getElementById('messageSentPopover').style.display = 'none';
        }, 2000);
    }
}

// Add this code to ensure events are properly set up when the page loads
document.addEventListener('DOMContentLoaded', function() {
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
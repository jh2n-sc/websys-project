  // -------------------- Popover --------------------

// Show property details in popover
function showPropertyDetails(name, price, beds, baths, size, location, date, type, imageUrl) {
    // Update popover content
    document.getElementById('popover-property-type').textContent = type;
    document.getElementById('popover-property-price').textContent = '₱' + parseFloat(price).toLocaleString();
    document.getElementById('popover-property-beds').textContent = beds + ' bed';
    document.getElementById('popover-property-baths').textContent = baths + ' bath';
    document.getElementById('popover-property-size').textContent = size;
    document.getElementById('popover-property-address').textContent = name;
    document.getElementById('popover-property-location').textContent = location;
    document.getElementById('popover-listing-date').textContent = date;
    document.getElementById('popover-property-image').src = imageUrl;
    
    // Show popover
    document.getElementById('property-popover').style.display = 'flex';
    document.body.style.overflow = 'hidden'; 

// Hide property details popover
function hidePropertyDetails() {
    document.getElementById('property-popover').style.display = 'none';
    document.body.style.overflow = 'auto'; 
}

document.getElementById('property-popover').addEventListener('click', function(e) {
    if (e.target === this) {
        hidePropertyDetails();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hidePropertyDetails();
    }
});

  // -------------------- Fake notif --------------------

function handleFakeAction(type, button = null) {
    let popoverId = "";
    
    if (type === "wishlist") {
        button.classList.add("active");
        const icon = button.querySelector(".heart-icon");
        icon.classList.remove("fa-regular");
        icon.classList.add("fa-solid");
        popoverId = "wishlist-confirmation";
    } else if (type === "buy") {
        popoverId = "buy-confirmation";
    } else if (type === "message") {
        popoverId = "messageSentPopover";
    }

    const el = document.getElementById(popoverId);
    if (el) {
        el.style.display = "block";
        setTimeout(() => {
            el.style.display = "none";
        }, 2000);
    }
}}

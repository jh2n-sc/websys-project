// Function to handle filter button toggling
function setupFilterButtons() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // If it's in a button group, deactivate siblings
            const parent = this.parentElement;
            if (parent.classList.contains('button-group')) {
                parent.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
            }
            
            // Toggle the active class
            this.classList.toggle('active');
        });
    });
}

// Handle clear filters button
function setupClearFilters() {
    const clearButton = document.getElementById('clear-filters');
    if (!clearButton) return;
    
    clearButton.addEventListener('click', function() {
        // Reset checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Reset buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Reset price inputs
        document.getElementById('min-price').value = '';
        document.getElementById('max-price').value = '';
        document.getElementById('price-range').value = 500000;
        
        // Reset search
        document.getElementById('property-search').value = '';
    });
}

// Price range slider functionality
function setupPriceRange() {
    const priceRange = document.getElementById('price-range');
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    
    if (!priceRange || !minPrice || !maxPrice) return;
    
    priceRange.addEventListener('input', function() {
        const value = parseInt(this.value);
        minPrice.value = '₱' + Math.floor(value * 0.5).toLocaleString();
        maxPrice.value = '₱' + value.toLocaleString();
    });
    
    // Initialize with default values
    const defaultValue = parseInt(priceRange.value);
    minPrice.placeholder = '₱0';
    maxPrice.placeholder = '₱' + defaultValue.toLocaleString();
}

// Demo filter application (in real app would connect to your PHP backend)
function setupApplyFilters() {
    const applyButton = document.querySelector('.apply-filters-btn');
    if (!applyButton) return;
    
    applyButton.addEventListener('click', function() {
        alert('Try Lang hirap js to php haha');
        
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupFilterButtons();
    setupClearFilters();
    setupPriceRange();
    setupApplyFilters();
});
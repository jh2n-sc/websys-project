  // -------------------- Filter  --------------------

// toggling


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

function getBedroomValue() {
    const buttonGroup = document.querySelector('.filter-section .button-group');
    const buttons = buttonGroup.querySelectorAll('.filter-btn');
    let selectedValue = null;
  
    buttons.forEach(button => {
      if (button.classList.contains('active')) {
        selectedValue = button.textContent;
      }
    });
  
    if (selectedValue === "Any") {
      return 0;
    } else if (selectedValue) {
      return parseInt(selectedValue.replace("+", ""), 10);
    }
    return null; 
}

function buildQueryParams() {
    let queryParams = [];
    const search = document.getElementById('property-search').value;
    if(search) {
        queryParams.push('search=' + encodeURIComponent(search));
    }


    const bedroom = getFilterValue('Bedrooms');
    if (bedroom) {
        queryParams.push('bedroom=' + encodeURIComponent(search));
    }
    const bathroom = getFilterValue('Bathrooms'); 
    if (bathroom) {
        queryParams.push('bathroom=' + encodeURIComponent(search));
    }
    const features = getCheckedFeatures();
    if (features.length > 0) {
        queryParams.push('features[]=' + features.map(feature => encodeURIComponent(feature)).join('&features[]='));
    }

    const propertyTypes = getCheckedTypes();
    if (propertyTypes.length > 0) {
        queryParams.push('property_type[]=' + propertyTypes.map(type => encodeURIComponent(type)).join('&property_type[]='));
    }

    const price = getPrice();
    if (price.min != null && price.max != null) {
        queryParams.push('price_min=' + encodeURIComponent(price.min));
        queryParams.push('price_max=' + encodeURIComponent(price.max));
    }
    return '?' + queryParams.join('&');
}

function applyFilters() {
    const queryString = buildQueryParams();
    window.location.href = window.location.pathname + queryString;
}


function getFilterValue(filterTitle) {
    const filterSections = document.querySelectorAll('.filter-section');
    let filterSection = null;
  
    for (const section of filterSections) {
      const h4 = section.querySelector('h4');
      if (h4 && h4.textContent.trim() === filterTitle) {
        filterSection = section;
        break;
      }
    }
  
    if (!filterSection) {
      console.error(`Filter section with title "${filterTitle}" not found.`);
      return null;
    }
  
    const buttonGroup = filterSection.querySelector('.button-group');
    const buttons = buttonGroup.querySelectorAll('.filter-btn');
    let selectedValue = null;
  
    buttons.forEach(button => {
      if (button.classList.contains('active')) {
        selectedValue = button.textContent;
      }
    });
  
    if (selectedValue === "Any") {
      return null;
    } else if (selectedValue) {
      return selectedValue;
    }
    return null;
}
  
  
function getCheckedFeatures() {
    const featureCheckboxes = document.querySelectorAll('.filter-section .checkbox-group input[name="features"]');
    const checkedFeatures = Array.from(featureCheckboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.value);
    return checkedFeatures;
}
function getCheckedTypes() {
    const typeCheckboxes = document.querySelectorAll('.filter-section .checkbox-group input[name="property-type"]');
    const checkedTypes = Array.from(typeCheckboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.value);
    return checkedTypes;
}

function getPrice() {
    const getMinPrice = document.getElementById("min-price").value;
    const getMaxPrice = document.getElementById("max-price").value;

    const price = {
        min: convertToFloat(getMinPrice),
        max: convertToFloat(getMaxPrice)
    }
    return price;
}
function convertToFloat(value) {
    const cleanedValue = value.replace(/[₱,]/g, '');
    const floatValue = parseFloat(cleanedValue);
    if (isNaN(floatValue)) {
        return null; 
    }
    return floatValue;
}

  
  // Example of how to use the function:
   // This will log an array of the values of the checked checkboxes
// clear filters 
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
        window.location.href = window.location.pathname;
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
        const queryString = buildQueryParams();
        window.location.href = window.location.pathname + queryString;
    });
}




document.addEventListener('DOMContentLoaded', function() {
    setupFilterButtons();
    setupClearFilters();
    setupPriceRange();
    setupApplyFilters();
});

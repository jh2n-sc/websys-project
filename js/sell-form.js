  // -------------------- Sell Form --------------------
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('propertyForm');

  const fields = {
    fullName: {
      input: document.getElementById('fullName'),
      error: document.getElementById('fullNameError'),
      validate: (val) => val.length >= 3,
      message: 'Name must be at least 3 characters'
    },
    contactNumber: {
      input: document.getElementById('contactNumber'),
      error: document.getElementById('contactNumberError'),
      validate: (val) => /^[\d\s\+\-\(\)]{7,20}$/.test(val),
      message: 'Please enter a valid phone number'
    },
    email: {
      input: document.getElementById('email'),
      error: document.getElementById('emailError'),
      validate: (val) => val === '' || /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(val),
      message: 'Please enter a valid email address'
    },
    propertyLocation: {
      input: document.getElementById('propertyLocation'),
      error: document.getElementById('locationError'),
      validate: (val) => val.length >= 5,
      message: 'Please enter a complete address'
    },
    bedrooms: {
      input: document.getElementById('bedrooms'),
      error: document.getElementById('bedroomsError'),
      validate: (val) => val !== '',
      message: 'Please select the number of bedrooms'
    },
    rooms: {
      input: document.getElementById('rooms'),
      error: document.getElementById('roomsError'),
      validate: (val) => val !== '',
      message: 'Please select the total number of rooms'
    },
    bathrooms: {
      input: document.getElementById('bathrooms'),
      error: document.getElementById('bathroomsError'),
      validate: (val) => val !== '',
      message: 'Please select the number of bathrooms'
    },
    squareFeet: {
      input: document.getElementById('squareFeet'),
      error: document.getElementById('dimensionsError'),
      validate: (val) => !isNaN(val) && val >= 100,
      message: 'Please enter a valid square footage'
    }
  };

  // Property Type Selector Logic
  const propertyTypeOptions = document.querySelectorAll('.property-type-option');
  const propertyTypeInput = document.getElementById('propertyType');
  propertyTypeOptions.forEach(option => {
    option.addEventListener('click', () => {
      propertyTypeOptions.forEach(opt => opt.classList.remove('selected'));
      option.classList.add('selected');
      propertyTypeInput.value = option.getAttribute('data-type');
    });
  });

  // File Drag-and-Drop and preview
  const uploadArea = document.getElementById('uploadArea');
  const fileInput = document.getElementById('propertyPhotos');
  const thumbnailsContainer = document.getElementById('thumbnailsContainer');

  uploadArea.addEventListener('click', () => fileInput.click());

  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      displayThumbnails(fileInput.files);
    }
  });

  fileInput.addEventListener('change', () => {
    if (fileInput.files.length) {
      displayThumbnails(fileInput.files);
    }
  });

  // thumbnail display
  function displayThumbnails(files) {
    thumbnailsContainer.innerHTML = '';
    const maxFiles = 10;
    const filesToDisplay = Math.min(files.length, maxFiles);

    for (let i = 0; i < filesToDisplay; i++) {
      const file = files[i];
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const thumbnail = document.createElement('img');
          thumbnail.classList.add('thumbnail');
          thumbnail.src = e.target.result;
          thumbnailsContainer.appendChild(thumbnail);
        };
        reader.readAsDataURL(file);
      }
    }

    // Show badge for extra files
    if (files.length > maxFiles) {
      const moreBadge = document.createElement('div');
      moreBadge.classList.add('thumbnail');
      moreBadge.textContent = `+${files.length - maxFiles}`;
      Object.assign(moreBadge.style, {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        background: '#f0f0f0',
        color: '#666',
        fontWeight: 'bold'
      });
      thumbnailsContainer.appendChild(moreBadge);
    }
  }

  // Error helpers
  function showError(field, message) {
    field.input.classList.add('error');
    field.error.textContent = message;
  }

  function clearError(field) {
    field.input.classList.remove('error');
    field.error.textContent = '';
  }

  // Real-time validation
  Object.values(fields).forEach(field => {
    field.input.addEventListener('input', () => {
      if (!field.validate(field.input.value)) {
        showError(field, field.message);
      } else {
        clearError(field);
      }
    });
  });

  // success popup
  function showNotification() {
    const popover = document.getElementById("messageSentPopover");
    popover.classList.add("show");
    
    setTimeout(() => {
      popover.classList.remove("show");
    }, 2000);
  }

  // Submit button handler
  const submitButton = document.getElementById('submitButton');
  submitButton.addEventListener('click', function(e) {
    e.preventDefault();
    
    let valid = true;
    
    // Validate all fields
    Object.values(fields).forEach(field => {
      if (!field.validate(field.input.value)) {
        showError(field, field.message);
        valid = false;
      } else {
        clearError(field);
      }
    });

    if (valid) {
      showNotification();
      
      form.reset();
      document.getElementById('thumbnailsContainer').innerHTML = '';
      document.querySelectorAll('.selected').forEach(el => el.classList.remove('selected'));
      document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
      document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    } else {
      // Scroll to first error
      const firstError = document.querySelector('.error');
      if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstError.focus();
      }
    }
  });
});
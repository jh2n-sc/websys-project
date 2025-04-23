      document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();

        const successMessage = document.createElement("p");
        successMessage.textContent = "Your inquiry has been submitted successfully!";
        successMessage.className = "success-message";

        const existingMessage = document.querySelector(".success-message");
        if (existingMessage) existingMessage.remove();

        const formContainer = document.querySelector(".inquiry-form-container");
        formContainer.appendChild(successMessage);

        this.reset();

        setTimeout(() => successMessage.remove(), 5000);
      });
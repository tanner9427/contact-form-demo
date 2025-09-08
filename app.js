// char count
const message = document.getElementById("message");
const charCount = document.getElementById("char-count");

// listen for typing
message.addEventListener("input", () => {
    const length = message.value.length;
    charCount.textContent = length;
});

const form = document.getElementById("contact-form");
const statusEl = document.getElementById("form-status");
const submitBtn = document.getElementById("submit");

// listen for submission
form.addEventListener("submit", (event) => {
    event.preventDefault(); // stops reload
    submitBtn.disabled = true; // lock button
    statusEl.textContent = "Submitting...";

    // simulate work
    setTimeout(() => {
        statusEl.textContent = "Done!";
        submitBtn.disabled = false; // unlock 
    }, 2000);
});


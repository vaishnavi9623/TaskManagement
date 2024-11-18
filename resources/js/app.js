import './bootstrap';
import 'bootstrap';
document.addEventListener("DOMContentLoaded", function () {
    // Function to hide validation error messages after 5 seconds
    setTimeout(function () {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function (alert) {
            alert.style.display = 'none';
        });

        let errorMessages = document.querySelectorAll('.text-danger');
        errorMessages.forEach(function (errorMessage) {
            errorMessage.style.display = 'none';
        });
    }, 3000); // Hides after 5 seconds (5000 ms)

    // Captcha refresh logic

   // Function to generate random numbers and update the captcha
    function generateRandomCaptcha() {
        let num1 = Math.floor(Math.random() * 10); // Random number between 0-9
        let num2 = Math.floor(Math.random() * 10); // Random number between 0-9
        document.querySelector('#captcha-equation').innerText = `${num1} + ${num2}`; // Display numbers
        document.querySelector('#captcha-answer').value = num1 + num2; // Store the correct sum in a hidden input
    }

    // Initial captcha generation
    generateRandomCaptcha();

    // Add event listener for the refresh button
    document.querySelector('.captcha-refresh').addEventListener('click', function (e) {
        e.preventDefault();
        generateRandomCaptcha(); // Refresh captcha on click
    });
});

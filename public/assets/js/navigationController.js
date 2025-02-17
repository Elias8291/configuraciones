// navigationController.js
document.addEventListener("DOMContentLoaded", function() {
    // "Next" button - Shows the second section
    let nextButton = document.getElementById('next-button');
    if (nextButton) {
        nextButton.addEventListener('click', function() {
            document.getElementById('section-1').style.display = 'none';
            document.getElementById('section-2').style.display = 'block';
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        });
    }

    // "Previous" button - Returns to the first section
    let prevButton = document.getElementById('prev-button');
    if (prevButton) {
        prevButton.addEventListener('click', function() {
            document.getElementById('section-2').style.display = 'none';
            document.getElementById('section-1').style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
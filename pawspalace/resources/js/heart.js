document.addEventListener('DOMContentLoaded', function() {
    const heartBtn = document.querySelector('.heart-btn');
    heartBtn.addEventListener('click', function() {
        heartBtn.classList.toggle('clicked');
    });
});

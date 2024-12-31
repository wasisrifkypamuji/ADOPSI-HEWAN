// JavaScript untuk mengatur sidebar
const profileIcon = document.getElementById('profileIcon');
const profileSidebar = document.getElementById('profileSidebar');
const overlay = document.getElementById('overlay');

// Menampilkan sidebar ketika logo profil ditekan
profileIcon.addEventListener('click', () => {
    profileSidebar.classList.add('active');
    overlay.classList.add('active');
});

// Menyembunyikan sidebar ketika overlay ditekan
overlay.addEventListener('click', () => {
    profileSidebar.classList.remove('active');
    overlay.classList.remove('active');
});
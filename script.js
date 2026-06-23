// Navbar Scroll Effect
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Reveal Animations on Scroll
const revealElements = document.querySelectorAll('.reveal');

const revealOnScroll = () => {
    const triggerBottom = window.innerHeight * 0.85;
    
    revealElements.forEach(el => {
        const elTop = el.getBoundingClientRect().top;
        
        if (elTop < triggerBottom) {
            el.classList.add('active');
        }
    });
};

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('load', revealOnScroll);

// Smooth Scrolling for Nav Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});

// Mobile Menu Toggle
const menuToggle = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        menuToggle.querySelector('i').classList.toggle('fa-bars');
        menuToggle.querySelector('i').classList.toggle('fa-times');
    });
}

// Mobile Dropdown Toggle
const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    const toggle = dropdown.querySelector('.dropdown-toggle');
    toggle.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            dropdown.classList.toggle('active');
        }
    });
});

// Close mobile menu on link click
document.querySelectorAll('.nav-links a:not(.dropdown-toggle)').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        if (menuToggle) {
            menuToggle.querySelector('i').classList.add('fa-bars');
            menuToggle.querySelector('i').classList.remove('fa-times');
        }
    });
});

// Maxximo Gallery Switcher
function changeMaximoImage(thumbnail) {
    const mainImg = document.getElementById('main-maxximo');
    const thumbnails = document.querySelectorAll('.thumbnails img');
    
    // Update main image
    mainImg.style.opacity = '0';
    setTimeout(() => {
        mainImg.src = thumbnail.src;
        mainImg.style.opacity = '1';
    }, 200);
    
    // Update active thumbnail
    thumbnails.forEach(img => img.classList.remove('active'));
    thumbnail.classList.add('active');
}

// Carrier Gallery Switcher
function changeCarrierImage(thumbnail) {
    const mainImg = document.getElementById('main-carrier');
    const thumbnails = thumbnail.parentElement.querySelectorAll('img');
    
    mainImg.style.opacity = '0';
    setTimeout(() => {
        mainImg.src = thumbnail.src;
        mainImg.style.opacity = '1';
    }, 200);
    
    thumbnails.forEach(img => img.classList.remove('active'));
    thumbnail.classList.add('active');
}

// Yodha Gallery Switcher
function changeYodhaImage(thumbnail) {
    const mainImg = document.getElementById('main-yodha');
    const thumbnails = thumbnail.parentElement.querySelectorAll('img');
    
    mainImg.style.opacity = '0';
    setTimeout(() => {
        mainImg.src = thumbnail.src;
        mainImg.style.opacity = '1';
    }, 200);
    
    thumbnails.forEach(img => img.classList.remove('active'));
    thumbnail.classList.add('active');
}

// Parallax effect for Hero
window.addEventListener('scroll', () => {
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        let scrollValue = window.scrollY;
        heroBg.style.transform = `scale(${1.1 + scrollValue * 0.0001}) translateY(${scrollValue * 0.1}px)`;
    }
});

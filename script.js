let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');
let videoBtns = document.querySelectorAll('.vid-btn');

menu.addEventListener('click', () => {
	menu.classList.toggle('fa-times');
	navbar.classList.toggle('active');
});

document.querySelector('#search-btn').onclick = () => {
	document.querySelector('.search-bar-container').classList.toggle('active');
};

document.querySelector('#close-search').onclick = () => {
	document.querySelector('.search-bar-container').classList.remove('active');
};

document.querySelector('#login-btn').onclick = () => {
	document.querySelector('.login-form-container').classList.add('active');
};

document.querySelector('#form-close').onclick = () => {
	document.querySelector('.login-form-container').classList.remove('active');
};

videoBtns.forEach(btn => {
	btn.addEventListener('click', () => {
		document.querySelector('.controls .active').classList.remove('active');
		btn.classList.add('active');
		let src = btn.getAttribute('data-src');
		document.querySelector('#video-slider').src = src;
	});
});
var swiper = new Swiper(".review-slider", {
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

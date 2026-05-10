/* Nook Furniture Theme – main.js */

document.addEventListener('DOMContentLoaded', function () {

  // ─────────────────────────────────────────
  // Swiper – horizontal product scroll
  // ─────────────────────────────────────────
  if (typeof Swiper !== 'undefined' && document.querySelector('.horizontal-scroll')) {
    new Swiper('.horizontal-scroll', {
      slidesPerView: 4,
      spaceBetween: 10,
      loop: true,
      speed: 600,
      freeMode: true,
      mousewheel: {
        forceToAxis: false,
        sensitivity: 1,
        releaseOnEdges: false,
      },
      navigation: {
        nextEl: '.rightClick',
        prevEl: '.leftClick',
      },
      breakpoints: {
        200:  { slidesPerView: 1, spaceBetween: 1 },
        480:  { slidesPerView: 2, spaceBetween: 10 },
        640:  { slidesPerView: 3, spaceBetween: 10 },
        1024: { slidesPerView: 4, spaceBetween: 10 },
      },
    });
  }

  // ─────────────────────────────────────────
  // Side menu toggle
  // ─────────────────────────────────────────
  const toggler = document.querySelector('.nav-toggler');
  const sideMenu = document.querySelector('.side-menu');
  const closeBtn = document.querySelector('.close-btn');
  const overlay  = document.querySelector('.menu-overlay');

  function toggleMenu() {
    if (sideMenu)  sideMenu.classList.toggle('active');
    if (overlay)   overlay.classList.toggle('active');
    document.body.style.overflow = sideMenu && sideMenu.classList.contains('active') ? 'hidden' : '';
  }

  if (toggler)  toggler.addEventListener('click', toggleMenu);
  if (closeBtn) closeBtn.addEventListener('click', toggleMenu);
  if (overlay)  overlay.addEventListener('click', toggleMenu);

  // ─────────────────────────────────────────
  // Collection filter tabs
  // ─────────────────────────────────────────
  const tags     = document.querySelectorAll('.collection-tag p');
  const products = document.querySelectorAll('.product-card');
  const seeAllBtn = document.getElementById('see-all-btn');

  if (seeAllBtn) {
    seeAllBtn.addEventListener('click', function (e) {
      e.preventDefault();
      products.forEach(function (p) { p.style.display = 'block'; });
      tags.forEach(function (t) { t.classList.remove('active'); });
    });
  }

  tags.forEach(function (tag) {
    tag.addEventListener('click', function () {
      tags.forEach(function (t) { t.classList.remove('active'); });
      tag.classList.add('active');

      var category = tag.textContent.toLowerCase().trim();

      products.forEach(function (product) {
        var imgSrc = product.querySelector('img') ? product.querySelector('img').src.toLowerCase() : '';
        if (imgSrc.includes(category) || category === 'all') {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    });
  });

  // ─────────────────────────────────────────
  // Animated counter for stats
  // ─────────────────────────────────────────
  var stats = document.querySelectorAll('.stat h3');

  function animateCount(stat) {
    var raw = stat.innerText;
    var target = parseInt(raw);
    if (isNaN(target)) return;

    var suffix   = raw.replace(/[0-9]/g, '');
    var duration = 2000;
    var frameRate = 1000 / 60;
    var totalFrames = Math.round(duration / frameRate);
    var currentFrame = 0;

    function animate() {
      currentFrame++;
      var progress = currentFrame / totalFrames;
      var currentValue = Math.round(target * progress);
      stat.innerText = currentValue + suffix;
      if (currentFrame < totalFrames) {
        requestAnimationFrame(animate);
      } else {
        stat.innerText = target + suffix;
      }
    }
    animate();
  }

  if ('IntersectionObserver' in window && stats.length) {
    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCount(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    stats.forEach(function (stat) { observer.observe(stat); });
  }

});

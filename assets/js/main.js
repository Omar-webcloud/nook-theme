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

  // ─────────────────────────────────────────
  // Cart Sidebar Logic
  // ─────────────────────────────────────────
  const cartSidebar = document.querySelector('.cart-sidebar');
  const cartTrigger = document.querySelector('.cart-trigger');
  const cartClose   = document.querySelector('.cart-close');
  const addToCartBtn = document.querySelector('.add-to-cart');
  const cartContent = document.querySelector('.cart-items');
  const cartTotalAmount = document.querySelector('.total-amount');

  function toggleCart() {
    if (cartSidebar) cartSidebar.classList.toggle('active');
    if (overlay) cartSidebar && cartSidebar.classList.contains('active') ? overlay.classList.add('active') : overlay.classList.remove('active');
    document.body.style.overflow = cartSidebar && cartSidebar.classList.contains('active') ? 'hidden' : '';
  }

  if (cartTrigger) cartTrigger.addEventListener('click', toggleCart);
  if (cartClose) cartClose.addEventListener('click', toggleCart);
  if (overlay) overlay.addEventListener('click', function() {
    if (cartSidebar && cartSidebar.classList.contains('active')) toggleCart();
  });

  // AJAX Add to Cart
  if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const productId = this.getAttribute('data-product-id');
      
      const formData = new FormData();
      formData.append('action', 'nook_add_to_cart');
      formData.append('product_id', productId);

      this.innerText = 'Adding...';
      this.style.pointerEvents = 'none';

      fetch(nook_params.ajax_url, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          updateCartUI(data.data);
          if (!cartSidebar.classList.contains('active')) toggleCart();
        }
        this.innerText = 'Add to Cart';
        this.style.pointerEvents = 'auto';
      })
      .catch(error => {
        console.error('Error:', error);
        this.innerText = 'Add to Cart';
        this.style.pointerEvents = 'auto';
      });
    });
  }

  // AJAX Remove from Cart (Event Delegation)
  if (cartContent) {
    cartContent.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-item')) {
        const productId = e.target.getAttribute('data-id');
        
        const formData = new FormData();
        formData.append('action', 'nook_remove_from_cart');
        formData.append('product_id', productId);

        fetch(nook_params.ajax_url, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            updateCartUI(data.data);
          }
        });
      }
    });
  }

  function updateCartUI(data) {
    if (cartContent) cartContent.innerHTML = data.cart_html;
    if (cartTotalAmount) cartTotalAmount.innerText = data.cart_total;
    // Optional: Update a cart counter badge if you have one
    const cartBadge = document.querySelector('.cart-count');
    if (cartBadge) {
        cartBadge.innerText = data.cart_count;
        cartBadge.style.display = data.cart_count > 0 ? 'flex' : 'none';
    }
  }

  // Initial Cart Load
  fetch(nook_params.ajax_url + '?action=nook_get_cart')
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        updateCartUI(data.data);
      }
    });

});

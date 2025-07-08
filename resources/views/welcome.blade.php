<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Teh Tangsel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    .hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -2;
      opacity: 0.8;
      animation: parallaxBg 20s ease-in-out infinite;
    }

    @keyframes parallaxBg {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .particle {
      position: absolute;
      background-color: rgba(255,255,255,0.7);
      border-radius: 50%;
      animation: float linear infinite;
    }

    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
      }
      100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
      }
    }

    /* Animasi fade in untuk container utama */
    .main-container {
      animation: fadeInUp 1.5s ease-out;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Animasi untuk welcome text */
    .welcome-text {
      animation: slideInLeft 1s ease-out 0.3s both;
    }

    @keyframes slideInLeft {
      0% {
        opacity: 0;
        transform: translateX(-50px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Animasi untuk logo */
    .logo {
      animation: bounceIn 1.2s ease-out 0.6s both;
    }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0.3);
      }
      50% {
        opacity: 1;
        transform: scale(1.05);
      }
      70% {
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* Animasi untuk setiap huruf Teh Tangsel */
    .letter {
      display: inline-block;
      animation: letterPop 0.6s ease-out both;
    }

    .letter:nth-child(1) { animation-delay: 0.9s; }
    .letter:nth-child(2) { animation-delay: 1.0s; }
    .letter:nth-child(3) { animation-delay: 1.1s; }
    .letter:nth-child(4) { animation-delay: 1.2s; }
    .letter:nth-child(5) { animation-delay: 1.3s; }
    .letter:nth-child(6) { animation-delay: 1.4s; }
    .letter:nth-child(7) { animation-delay: 1.5s; }
    .letter:nth-child(8) { animation-delay: 1.6s; }
    .letter:nth-child(9) { animation-delay: 1.7s; }
    .letter:nth-child(10) { animation-delay: 1.8s; }

    @keyframes letterPop {
      0% {
        opacity: 0;
        transform: translateY(20px) scale(0.8);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Hover effect untuk huruf */
    .letter:hover {
      animation: letterBounce 0.6s ease-in-out;
      cursor: pointer;
    }

    @keyframes letterBounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* Animasi untuk buttons */
    .button-container {
      animation: slideInUp 1s ease-out 2s both;
    }

    @keyframes slideInUp {
      0% {
        opacity: 0;
        transform: translateY(50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn-primary {
      position: relative;
      overflow: hidden;
      transition: all 0.3s;
      transform: translateY(0);
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.1);
      transition: all 0.5s;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .btn-primary:active {
      transform: translateY(-1px);
    }

    /* Animasi untuk tagline */
    .tagline {
      animation: fadeIn 1s ease-out 2.5s both;
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    /* Animasi floating untuk mobile */
    @media (max-width: 768px) {
      .mobile-float {
        animation: mobileFloat 3s ease-in-out infinite;
      }

      @keyframes mobileFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
      }

      /* Animasi gradient bergerak untuk mobile background */
      .mobile-gradient {
        background: linear-gradient(45deg, #fb923c, #f59e0b, #fb923c, #f59e0b);
        background-size: 400% 400%;
        animation: gradientMove 8s ease infinite;
      }

      @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }

      /* Pulse effect untuk mobile buttons */
      .mobile-pulse {
        animation: mobilePulse 2s ease-in-out infinite;
      }

      @keyframes mobilePulse {
        0% { box-shadow: 0 0 0 0 rgba(251, 146, 60, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(251, 146, 60, 0); }
        100% { box-shadow: 0 0 0 0 rgba(251, 146, 60, 0); }
      }
    }

    /* Animasi khusus desktop */
    @media (min-width: 769px) {
      .desktop-glow {
        animation: desktopGlow 4s ease-in-out infinite alternate;
      }

      @keyframes desktopGlow {
        0% { 
          text-shadow: 0 0 20px rgba(251, 146, 60, 0.5);
        }
        100% { 
          text-shadow: 0 0 30px rgba(251, 146, 60, 0.8), 0 0 40px rgba(245, 158, 11, 0.6);
        }
      }
    }

    /* Animasi loading untuk keseluruhan halaman */
    .page-loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, #fb923c, #f59e0b);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pageLoad 2s ease-in-out forwards;
    }

    @keyframes pageLoad {
      0% { opacity: 1; }
      90% { opacity: 1; }
      100% { 
        opacity: 0;
        visibility: hidden;
      }
    }

    .loader-text {
      color: white;
      font-size: 2rem;
      font-weight: bold;
      animation: loaderPulse 1s ease-in-out infinite;
    }

    @keyframes loaderPulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.1); }
    }
  </style>
</head>
<body class="bg-orange-400 md:bg-gradient-to-r md:from-orange-400 md:to-amber-500 mobile-gradient min-h-screen flex items-center justify-center flex-col relative overflow-hidden text-center p-4 text-white">

  <!-- Page Loader -->
  <div class="page-loader">
    <div class="loader-text">TEH TANGSEL</div>
  </div>

  <!-- Background -->
  <div class="particles" id="particles"></div>
  <img src="https://images.unsplash.com/photo-1519638399535-1b036603ac77?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="hidden md:block hero-bg">

  <!-- Content -->
  <div class="z-10 main-container">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4 welcome-text desktop-glow">
      <span class="text-orange-600">WELCOME</span> <br>
      <span class="text-orange-300">TO</span>
    </h1>

    <img src="{{ asset('images/logo.png') }}" alt="Teh Tangsel" class="mx-auto h-28 md:h-40 mb-6 logo mobile-float">

    <div class="text-2xl md:text-4xl font-bold tracking-widest mb-8">
      <span class="letter text-orange-600">T</span>
      <span class="letter text-orange-300">E</span>
      <span class="letter text-orange-600">H</span>
      <span class="letter ml-2 text-orange-300">T</span>
      <span class="letter text-orange-600">A</span>
      <span class="letter text-orange-300">N</span>
      <span class="letter text-orange-600">G</span>
      <span class="letter text-orange-300">S</span>
      <span class="letter text-orange-600">E</span>
      <span class="letter text-orange-300">L</span>
    </div>

    <div class="space-y-4 w-full max-w-sm mx-auto button-container">
      <a href="{{ route('login') }}" class="btn-primary mobile-pulse block w-full bg-gradient-to-r from-orange-500 to-amber-500 text-white py-3 rounded-lg hover:from-orange-600 hover:to-amber-600 transition-all duration-500 ease-in-out transform hover:scale-105 shadow-lg flex items-center justify-center">
        <i class="fas fa-user-circle mr-2"></i>
        <span class="text-lg font-semibold">Sudah Punya Akun? <span class="font-bold">LOGIN</span></span>
      </a>
      <a href="{{ route('register') }}" class="btn-primary block w-full bg-gradient-to-r from-gray-100 to-gray-200 text-orange-700 py-3 rounded-lg hover:from-gray-200 hover:to-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105 shadow-md flex items-center justify-center">
        <i class="fas fa-user-plus mr-2"></i>
        <span class="text-lg font-semibold">Belum Punya Akun? <span class="font-bold">REGISTER</span></span>
      </a>
    </div>

    <p class="mt-6 text-sm hidden md:block tagline">Freshly brewed tea with authentic Tangsel flavor</p>
  </div>

  <script>
    // Particle animation (enhanced)
    if (window.innerWidth > 768) {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 50; // Increased particle count
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        const size = Math.random() * 15 + 5;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        const duration = Math.random() * 15 + 10; // Faster particles
        const delay = Math.random() * 5;
        particle.style.animation = `float ${duration}s linear infinite ${delay}s`;
        particlesContainer.appendChild(particle);
      }
    } else {
      // Mobile particles (lighter)
      const particlesContainer = document.getElementById('particles');
      const particleCount = 15;
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        const size = Math.random() * 8 + 3;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        const duration = Math.random() * 20 + 15;
        const delay = Math.random() * 3;
        particle.style.animation = `float ${duration}s linear infinite ${delay}s`;
        particlesContainer.appendChild(particle);
      }
    }

    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
      // Add click animation to buttons
      const buttons = document.querySelectorAll('.btn-primary');
      buttons.forEach(button => {
        button.addEventListener('click', function(e) {
          // Create ripple effect
          const ripple = document.createElement('span');
          const rect = this.getBoundingClientRect();
          const size = Math.max(rect.width, rect.height);
          const x = e.clientX - rect.left - size / 2;
          const y = e.clientY - rect.top - size / 2;
          
          ripple.style.width = ripple.style.height = size + 'px';
          ripple.style.left = x + 'px';
          ripple.style.top = y + 'px';
          ripple.style.position = 'absolute';
          ripple.style.background = 'rgba(255,255,255,0.3)';
          ripple.style.borderRadius = '50%';
          ripple.style.pointerEvents = 'none';
          ripple.style.animation = 'ripple 0.6s ease-out';
          
          this.appendChild(ripple);
          setTimeout(() => ripple.remove(), 600);
        });
      });

      // Add scroll reveal effect for mobile
      if (window.innerWidth <= 768) {
        let ticking = false;
        
        function updateParticles() {
          const scrolled = window.pageYOffset;
          const rate = scrolled * -0.5;
          
          document.querySelectorAll('.particle').forEach(particle => {
            particle.style.transform = `translateY(${rate}px)`;
          });
          
          ticking = false;
        }
        
        window.addEventListener('scroll', function() {
          if (!ticking) {
            requestAnimationFrame(updateParticles);
            ticking = true;
          }
        });
      }
    });

    // Add ripple animation CSS
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        0% {
          transform: scale(0);
          opacity: 0.6;
        }
        100% {
          transform: scale(2);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>
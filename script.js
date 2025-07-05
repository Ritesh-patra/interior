// Mobile menu toggle
const mobileMenuButton = document.getElementById("mobile-menu-button")
const mobileMenu = document.getElementById("mobile-menu")

if (mobileMenuButton && mobileMenu) {
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden")
  })
}

// Hero slider functionality
let currentSlide = 0
const slides = document.querySelectorAll(".hero-slide")
const indicators = document.querySelectorAll(".slide-indicator")
const totalSlides = slides.length

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle("active", i === index)
  })

  indicators.forEach((indicator, i) => {
    indicator.classList.toggle("active", i === index)
  })
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % totalSlides
  showSlide(currentSlide)
}

// Auto-advance slides every 5 seconds
if (slides.length > 0) {
  setInterval(nextSlide, 5000)

  // Manual slide control
  indicators.forEach((indicator, index) => {
    indicator.addEventListener("click", () => {
      currentSlide = index
      showSlide(currentSlide)
    })
  })

  // Initialize first slide
  showSlide(0)
}

// Smooth scrolling for navigation links
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()

      const target = document.querySelector(this.getAttribute("href"))

      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }

      // Close mobile menu if open
      if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
        mobileMenu.classList.add("hidden")
      }
    })
  })
})

// Navigation scroll effect
window.addEventListener("scroll", () => {
  const nav = document.getElementById("navbar")
  if (nav) {
    if (window.scrollY > 100) {
      nav.classList.add("scrolled")
    } else {
      nav.classList.remove("scrolled")
    }
  }
})

// Scroll animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("animated")
    }
  })
}, observerOptions)

// Observe all elements with animate-on-scroll class
document.querySelectorAll(".animate-on-scroll").forEach((el) => {
  observer.observe(el)
})

// Form submission handler
function handleFormSubmit(event) {
  event.preventDefault()

  // Get form data
  const formData = new FormData(event.target)
  const data = Object.fromEntries(formData)

  // Show success message (you can replace this with actual form submission logic)
  alert("Thank you for your message! We will get back to you soon.")

  // Reset form
  event.target.reset()

  return false
}

// Add loading animation
window.addEventListener("load", () => {
  document.body.classList.add("loaded")
})

// Parallax effect for hero section
window.addEventListener("scroll", () => {
  const scrolled = window.pageYOffset
  const hero = document.querySelector("#home")

  if (hero) {
    const speed = scrolled * 0.5
    hero.style.transform = `translateY(${speed}px)`
  }
})

// Add mouse move effect to floating elements
document.addEventListener("mousemove", (e) => {
  const floatingElements = document.querySelectorAll(".floating-circle, .floating-square")
  const x = e.clientX / window.innerWidth
  const y = e.clientY / window.innerHeight

  floatingElements.forEach((element, index) => {
    const speed = (index + 1) * 0.5
    element.style.transform += ` translate(${x * speed}px, ${y * speed}px)`
  })
})

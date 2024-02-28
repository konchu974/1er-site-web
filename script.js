var currentSlide = 0;
var slides = document.querySelectorAll(".profile-slide");

slides.forEach((e) => {
  e.style.display = "none";
});

function showSlide(n) {
  slides[currentSlide].style.display = "none";
  currentSlide = (n + slides.length) % slides.length;
  slides[currentSlide].style.display = "block";
}

function nextSlide() {
  showSlide(currentSlide + 1);
}
setInterval(nextSlide, 3000);

function Validation() {
  var pseudo = document.getElementById("pseudo").value;
  var password = document.getElementById("password").value;
  // Exemple de validation (vous devrez remplacer cela par une validation appropriée)
  if (pseudo === "omar" && password === "2003f") {
    window.location.href = " page3.html";
  } else {
    alert("Pseudo ou mot de passe incorrect!ressaye");
  }
}

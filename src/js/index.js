let getTombol = document.getElementById("tombol");

window.addEventListener("scroll", function () {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    getTombol.style.display = "block";
  } else {
    getTombol.style.display = "none";
  }
});

getTombol.addEventListener("click", function () {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
});

/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
// import "./styles.css";
// navbar
//classList - gets all classes
//contains - checks classList for specific class
// add, remove, toggle class.
var navToggle = document.querySelector(".nav-toggle");
var links = document.querySelectorAll(".links");
var dropdownContent = document.querySelector(".nav-dropdown-content");
var dropdownOpen = document.querySelector(".dropdown-open");
navToggle.addEventListener("click", function () {
  links.forEach(function (link) {
    link.classList.toggle("show-links");
  });
}); // show-dropdown bei click: nur beim kleineren Bildschirm
//sollte screensize/ resize erkennen, auch wenn site nicht neu geladen? via EventListener?
//window.addEventListener("resize", displayNavDropdown()); //ev. einfacher in css via mediaquery.

dropdownOpen.addEventListener("click", displayNavDropdown);

function displayNavDropdown(e) {
  e.preventDefault();
  var width = document.documentElement.clientWidth; //console.log(width);

  if (width < 1225) {
    dropdownContent.classList.toggle("show-dropdown");
  } else {
    dropdownContent.classList.remove("dropdown-content");
  }
}
/******/ })()
;
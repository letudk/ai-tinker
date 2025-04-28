// youtube list
function qs(elem) {
  return document.querySelector(elem);
}
function qsa(elem) {
  return document.querySelectorAll(elem);
}
var activeCon = 0,
  totalCons = 0;
const v_cons = qsa(".video-con"),
  a_cons = qsa(".active-con"),
  v_count = qs("#video-count"),
  drop_icon = qs("#drop-icon"),
  video_list = qs("#v-list"),
  display = qs("#display-frame");

var youlit = document.getElementById("youtu-playlist");
if(youlit != null){

function activate(con) {
  deactivateAll();
  indexAll();
  countVideos(con.querySelector(".youtu-index").innerHTML);
  con.classList.add("active-con");
  con.querySelector(".youtu-index").innerHTML = "<i class='fa-regular fa-play'></i>";
}
function deactivateAll() {
  v_cons.forEach((container) => {
    container.classList.remove("active-con");
  });
}
function indexAll() {
  var i = 1;
  v_cons.forEach((container) => {
    container.querySelector(".youtu-index").innerHTML = i;
    i++;
  });
}
function countVideos(active) {
  v_count.innerHTML = active + " / " + v_cons.length;
}
function toggle_list() {
  if (video_list.classList.contains("li-collapsed")) {
    drop_icon.style.transform = "rotate(0deg)";
    video_list.classList.remove("li-collapsed");
  } else {
    drop_icon.style.transform = "rotate(180deg)";
    video_list.classList.add("li-collapsed");
  }
}
function loadVideo(url) {
  display.setAttribute("src", url);
}
window.addEventListener("load", function () {
  indexAll(); 
  countVideos(1);
  activate(v_cons[0]);
  loadVideo(v_cons[0].getAttribute("video"));
  v_cons.forEach((container) => {
    container.addEventListener("click", () => {
      activate(container);
      loadVideo(container.getAttribute("video"));
    });
  });
  drop_icon.addEventListener("click", () => {
    toggle_list();
  });
});
}
// widget custom smartkid logo
jQuery(document).ready(function($){
				$('.smartkid-logo').slick({
					draggable:false,
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite:true,
					autoplay: true,
					autoplaySpeed: 600,
					arrows: false,
					dots: false,
					speed:6000,
					pauseOnHover: false,
					cssEase: 'ease-in-out',
					variableWidth:true,
					rtl:false,
					initialSlide:1,
					centerMode: true, // Đặt centerMode thành true
					centerPadding: '0',
					pauseOnHover:false,
					 responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
				},
				{
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
				}
				], 
				});
			});
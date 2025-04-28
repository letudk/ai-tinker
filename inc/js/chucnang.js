// back to top
window.onscroll = () => {
  toggleTopButton();
}
function scrollBackToTop(){
  window.scrollTo({top: 0, behavior: 'smooth'});
}
function toggleTopButton() {
  if (document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20) {
    document.getElementById('backtop').classList.remove('d-none');
  } else {
    document.getElementById('backtop').classList.add('d-none');
  }
}
// tab share
function getStyle(x, styleProp) {
    if (x.currentStyle) {
        var y = x.currentStyle[styleProp];
    }
    else if (window.getComputedStyle) {
        var y = document.defaultView.getComputedStyle(x, null).getPropertyValue(styleProp);
    }
    return y;
}
function share(e, div_name) {
    var el = document.getElementById(div_name); 
    var display = el.style.display || getStyle(el, 'display');
    el.style.display = (display == 'none') ? 'block' : 'none';
    share.el = el;
    if (e.stopPropagation) e.stopPropagation();
    e.cancelBubble = true;
    return false;
}
// hien thi popup
function momodal(div_name){
document.getElementById(div_name).classList.toggle("active");
}
// back to top
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
 
if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
document.getElementById("backtop").style.display = "block";
} else {
document.getElementById("backtop").style.display = "none";
}
}
// chuc nang tao tab
function openrank(evt, rankname) {
  var i, x, ranktab;
  x = document.getElementsByClassName("rank");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  ranktab = document.getElementsByClassName("ranktab");
  for (i = 0; i < x.length; i++) {
    ranktab[i].className = ranktab[i].className.replace(" rank-ac", "");
  }
  document.getElementById(rankname).style.display = "block";
  evt.currentTarget.className += " rank-ac";
  localStorage.setItem('selectedRank', rankname);
}
function loadSelectedRank() {
  var selectedRank = localStorage.getItem('selectedRank');
  if (selectedRank) {
    var ranktab = document.querySelector('[onclick="openrank(event, \'' + selectedRank + '\')"]');
    if (ranktab) {
      ranktab.click();
    }
  }
}
document.addEventListener("DOMContentLoaded", function() {
  loadSelectedRank();
});
// hien thi menu icon
function taomenuicon() {
  document.getElementById("hienmenuicon").classList.toggle("hienthiicon");
}
window.onclick = function(event) {
  if (!event.target.matches('.nuticon')) {
    var menuicons = document.getElementsByClassName("menuicon-content");
    var i;
    for (i = 0; i < menuicons.length; i++) {
      var openmenuicon = menuicons[i];
      if (openmenuicon.classList.contains('hienthiicon')) {
        openmenuicon.classList.remove('hienthiicon');
      }
    }
  }
}

// cookie thông báo
var cookiebox = document.getElementById("cookiebox");
if(cookiebox != null){
const cookieBox = document.querySelector(".cookiebox"),
    acceptBtn = cookieBox.querySelector("button");
    acceptBtn.onclick = ()=>{
      document.cookie = "CookieBy=Cookiesmartkid; max-age="+60*60*24*30;
      if(document.cookie){ 
        cookieBox.classList.add("hide"); 
      }else{ 
        alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
      }
    }
    let checkCookie = document.cookie.indexOf("CookieBy=Cookiesmartkid"); 
    checkCookie != -1 ? cookieBox.classList.add("hide") : cookieBox.classList.remove("hide");
}
// auto go key
var sloganspan = document.querySelector(".author-slogan span");
if(sloganspan != null){
var textArr = sloganspan.getAttribute("data-text").split(", "); 
var maxTextIndex = textArr.length; 
var sPerChar = 0.15; 
var sBetweenWord = 1.5;
var textIndex = 0; 
typing(textIndex, textArr[textIndex]); 
function typing(textIndex, text) {
    var charIndex = 0; 
    var maxCharIndex = text.length - 1; 
    var typeInterval = setInterval(function () {
        sloganspan.innerHTML += text[charIndex]; 
        if (charIndex == maxCharIndex) {
            clearInterval(typeInterval);
            setTimeout(function() { deleting(textIndex, text) }, sBetweenWord * 1000); 
            
        } else {
            charIndex += 1; 
        }
    }, sPerChar * 1000); 
}
function deleting(textIndex, text) {
    var minCharIndex = 0; 
    var charIndex = text.length - 1; 
    var typeInterval = setInterval(function () {
        sloganspan.innerHTML = text.substr(0, charIndex); 
        if (charIndex == minCharIndex) {
            clearInterval(typeInterval);
            textIndex + 1 == maxTextIndex ? textIndex = 0 : textIndex += 1; 
            setTimeout(function() { typing(textIndex, textArr[textIndex]) }, sBetweenWord * 1000); 
        } else {
            charIndex -= 1; 
        }
    }, sPerChar * 1000); 
}
} 
// smartkidtheme f12
(function() {
    console['log']('%c There is nothing to search here %c', 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;', 'font-size:12px;color:#999999;')
})()
// chuyen image anh tu data-width sang width
var images = document.getElementsByTagName('img');
for (var i = 0; i < images.length; i++) {
  var image = images[i];
  var dataWidth = image.getAttribute('data-width');
  if (dataWidth) {
    image.removeAttribute('data-width');
    image.setAttribute('width', dataWidth);
  }
}
document.addEventListener("DOMContentLoaded", function () {
  const article = document.querySelector(".danhmucbaiviet"); // Đổi class theo theme
  if (!article) return;

  let elements = Array.from(article.querySelectorAll("figure"));
  let group = [];

  elements.forEach((el, index) => {
      if (!group.length || el.previousElementSibling === group[group.length - 1]) {
          group.push(el);
      } else {
          wrapElements(group);
          group = [el];
      }
  });

  if (group.length) wrapElements(group);

  function wrapElements(elements) {
      if (elements.length < 2) return;
      let wrapper = document.createElement("div");
      wrapper.classList.add("image-grid");
      elements[0].parentNode.insertBefore(wrapper, elements[0]);
      elements.forEach(el => wrapper.appendChild(el));
  }
});


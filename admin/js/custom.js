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
window.onload = loadSelectedRank;
// add code color editor
jQuery(document).ready(function($) {
if($('.smartkid-codex').length){
wp.codeEditor.initialize($('.smartkid-codex'), cm_settings);
}
})
// copi
function codecopi() {
  var textBox = document.getElementById("inputcopi");
    textBox.select();
    document.execCommand("copy");
}
// check thư font chu
const fontSelect = document.getElementById('smartkid_settings[font]');
if(fontSelect !== null){
const fontDemo = document.getElementById('admin-font-demo');
fontDemo.style.fontFamily = fontSelect.value;
fontSelect.addEventListener('change', function() {
  const font = fontSelect.value;
  fontDemo.style.fontFamily = font;
});
}
// xem truoc html khi nhap code vao chan trang
var inputshowco = document.getElementById("code-input");
var outputshowco = document.getElementById("code-output");
var iframeshowco;
var cssCode = ":root{ --body: #e4e7ec; --card: #ffffff; --card-shadow: 0 0px 0px rgba(0, 0, 0, 0.2); --shadow: 0px 1px 7px #0000004a; --htext:#333333; --text: #333333; --texta: #0768ea; --textnote: #555; --border: 1px solid #ccc; --border-one: 1px solid #ccc; --border-hat: 1px dashed #ccc; --comment: #fff; --menu:#eee; --menu-mobile: #ddd; --menu-mobile-chil:#fff; --menu-border: 2px dashed #ccc; --down-border: 2px solid #0768ea; --scroll: #ccc; --bar: #fff; --menu-duoi: #ffffff; --input: #eee; --card-tran: #ffffff82; }";
if(inputshowco !== null){
  inputshowco.addEventListener("input", function() {
    var code = inputshowco.value;
    if (!iframeshowco) {
      iframeshowco = document.createElement("iframe");
      iframeshowco.setAttribute("frameborder", "0");
      iframeshowco.setAttribute("width", "100%");
      iframeshowco.setAttribute("scrolling", "no");
      outputshowco.appendChild(iframeshowco);
    }
    var docshowco = iframeshowco.contentWindow.document;
    docshowco.open();
    docshowco.write("<html><head><style>"+cssCode+"</style></head><body>"+code+"</body></html>");
    docshowco.close();
    iframeshowco.style.height = docshowco.documentElement.scrollHeight + "px"; 
  });
}

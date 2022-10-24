function see(next, prev) {
  if (next.style.display == "none") {
    $(prev).fadeOut("fast", function () {
      $(next).fadeIn(500);
      TweenMax.from($(next), 0.4, { scale: 0, ease: Sine.easeInOut });
      TweenMax.to($(next), 0.4, { scale: 1, ease: Sine.easeInOut });
    });
  }
}


function openform(form) {
  if (form.style.display == "none") {
    $(form).fadeIn(500);
    $("#flat-slider").slider("disable").css({
      'opacity':'.35'
    });
  }
  else {
    $(form).fadeOut(500);
    $("#flat-slider").slider("enable").css({
      'opacity':'1'
    });
  }
}

function auth(form) {
  if (form.style.display == "none") {
    $(document.getElementById("opbut")).fadeOut(700);
    $(form).delay(800).fadeIn(800);
  } else {
    $(form).fadeOut(700);
    $(document.getElementById("opbut")).delay(800).fadeIn(800);
  }
}

function show_hide_password(target) {
  var input = document.getElementById("password-input");
  if (input.getAttribute("type") == "password") {
    target.classList.add("view");
    input.setAttribute("type", "text");
  } else {
    target.classList.remove("view");
    input.setAttribute("type", "password");
  }
  return false;
}

function setCursorPosition(pos, e) {
  e.focus();
  if (e.setSelectionRange) e.setSelectionRange(pos, pos);
  else if (e.createTextRange) {
    var range = e.createTextRange();
    range.collapse(true);
    range.moveEnd("character", pos);
    range.moveStart("character", pos);
    range.select();
  }
}

function mask(e) {
  //console.log('mask',e);
  var matrix = this.placeholder, // .defaultValue
    i = 0,
    def = matrix.replace(/\D/g, ""),
    val = this.value.replace(/\D/g, "");
  def.length >= val.length && (val = def);
  matrix = matrix.replace(/[_\d]/g, function (a) {
    return val.charAt(i++) || "_";
  });
  this.value = matrix;
  i = matrix.lastIndexOf(val.substr(-1));
  i < matrix.length && matrix != this.placeholder
    ? i++
    : (i = matrix.indexOf("_"));
  setCursorPosition(i, this);
}
window.addEventListener("DOMContentLoaded", function () {
  var input = document.querySelector("#online_phone");
  input.addEventListener("input", mask, false);
  input.focus();
  setCursorPosition(3, input);
});

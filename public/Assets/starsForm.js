let starsValues = document.getElementById('starsForm').getElementsByTagName('input');
let stars = document.getElementById('starsForm').getElementsByTagName('svg');


function displayStars() {
  let value = 1;
  for (let i = 0; i < starsValues.length; i++) {
    if(starsValues[i].checked) {
      value = starsValues[i].value;
    }
  }

  for (let i = 0; i < stars.length; i++) {
    if( i <= value - 1 ) {
      stars[i].setAttribute("fill", "yellow");
    } else {
      stars[i].setAttribute("fill", "none");
    }
  }
}

function hoverStars(e) {

  for (let i = 0; i < stars.length; i++) {
    if( i <= e.currentTarget.param ) {
      stars[i].setAttribute("fill", "yellow");
    } else {
      stars[i].setAttribute("fill", "none");
    }
  }
}


for (let i = 0; i < starsValues.length; i++) {
  starsValues[i].addEventListener("change", displayStars)
}

for (let i = 0; i < stars.length; i++) {
  stars[i].addEventListener("mouseover", hoverStars)
  stars[i].param = i;
  stars[i].addEventListener("mouseout", displayStars)
}
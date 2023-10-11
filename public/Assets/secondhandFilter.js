let minMileage= document.getElementById("input-min-mileage");
let minMileageValue= document.getElementById("minval-mileage");
let maxMileage= document.getElementById("input-max-mileage");
let maxMileageValue= document.getElementById("maxval-mileage");

let minPrice= document.getElementById("input-min-price");
let minPriceValue= document.getElementById("minval-price");
let maxPrice= document.getElementById("input-max-price");
let maxPriceValue= document.getElementById("maxval-price");

let minYear= document.getElementById("input-min-year");
let minYearValue= document.getElementById("minval-year");
let maxYear= document.getElementById("input-max-year");
let maxYearValue= document.getElementById("maxval-year");

minMileage.addEventListener('mouseup', () => {
  filter();
})
minMileage.addEventListener('input', () => {
  minMileageValue.innerHTML = minMileage.value + " km";
})

maxMileage.addEventListener('mouseup', () => {
  filter();
})
maxMileage.addEventListener('input', () => {
  maxMileageValue.innerHTML = maxMileage.value + " km";
})

minPrice.addEventListener('mouseup', () => {
  filter();
})
minPrice.addEventListener('input', () => {
  minPriceValue.innerHTML = minPrice.value + " €";
})

maxPrice.addEventListener('mouseup', () => {
  filter();
})
maxPrice.addEventListener('input', () => {
  maxPriceValue.innerHTML = maxPrice.value + " €";
})

minYear.addEventListener('mouseup', () => {
  filter();
})
minYear.addEventListener('input', () => {
  minYearValue.innerHTML = minYear.value;
})

maxYear.addEventListener('mouseup', () => {
  filter();
})
maxYear.addEventListener('input', () => {
  maxYearValue.innerHTML = maxYear.value;
})

function filter() {
  let params = {
    minMileageFilter: minMileage.value,
    maxMileageFilter: maxMileage.value,
    minPriceFilter: minPrice.value,
    maxPriceFilter: maxPrice.value,
    minYearFilter: minYear.value,
    maxYearFilter: maxYear.value 
  };

  let url = '/occasions?filter=1&';
  for (const [key, value] of Object.entries(params)) {
    url += `${key}=${value}&`;
  }
  url = url.substring(0, url.length -1);

  fetch(url
    ).then(response =>
      response.json()
    ).then(data => {
        const filteredContent = document.getElementById("filteredContent");
        filteredContent.innerHTML = data.filteredContent;
        console.log(data);
    }).catch(e => alert(e));
    
}

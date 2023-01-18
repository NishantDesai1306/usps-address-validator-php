var errorDivs = {
  addressLine1: "addressLine1-error",
  addressLine2: "addressLine2-error",
  city: "city-error",
  state: "state-error",
  zip: "zip-error",
}

function clearErrors() {
  var divs = Object.values(errorDivs);

  for (div of divs) {
    document.getElementById(div).innerText = "";
  }
}

function validation() {
  var addressLine1 = document.addressForm.addressLine1.value;
  var addressLine2 = document.addressForm.addressLine2.value;
  var city = document.addressForm.city.value;
  var state = document.addressForm.state.value;
  var zip = document.addressForm.zip.value;

  clearErrors();
  var hasError = false;
  var zipRegex = /[0-9]{5}/;

  if (!addressLine1) {
    document.getElementById(errorDivs.addressLine1).innerText = "Field can't be empty";
    hasError = true;
  }
  if (!addressLine2) {
    document.getElementById(errorDivs.addressLine2).innerText = "Field can't be empty";
    hasError = true;
  }
  if (!city) {
    document.getElementById(errorDivs.city).innerText = "Field can't be empty";
    hasError = true;
  }
  if (!state) {
    document.getElementById(errorDivs.state).innerText = "Field can't be empty";
    hasError = true;
  }
  if (!zip) {
    document.getElementById(errorDivs.zip).innerText = "Field can't be empty";
    hasError = true;
  }
  else if (!zipRegex.test(zip)) {
    document.getElementById(errorDivs.zip).innerText = "Please enter a valid zip code";
    hasError = true;
  }

  return !hasError;
}

var SELECTED_ADDRESS_TYPE = {
  ORIGINAL: "ORIGINAL",
  STANDARDIZED: "STANDARDIZED",
};

var selectedAddressType = SELECTED_ADDRESS_TYPE.STANDARDIZED;

function saveSelectedAddress() {
  var addressSection = document.querySelector("div#address-section-" + selectedAddressType);

  var addressLine1 = addressSection.querySelector("label[name='addressLine1']").textContent;
  var addressLine2 = addressSection.querySelector("label[name='addressLine2']").textContent;
  var state = addressSection.querySelector("label[name='state']").textContent;
  var city = addressSection.querySelector("label[name='city']").textContent;
  var zip = addressSection.querySelector("label[name='zip']").textContent;

  saveAddress(addressLine1, addressLine2, city, state, zip);
}

function saveAddress(addressLine1, addressLine2, city, state, zip) {
  var formData = new FormData();
  formData.append('addressLine1', addressLine1);
  formData.append('addressLine2', addressLine2);
  formData.append('city', city);
  formData.append('state', state);
  formData.append('zip', zip);

  debugger;
  var errorDiv = document.querySelector("#error");
  errorDiv.classList.add("d-none");

  fetch('/api/save-address.php', {
    method: "POST",
    body: formData,
  })
  .then((response) => {
    debugger;
    if (response.status === 200) {
      console.log(response);
      window.location.href = "/saved";
    }
    else {
      errorDiv.classList.remove("d-none");
    }
  })
  .catch((err) => {
  });
}

function highlightCorrectAddressButton() {
  var radios = document.querySelectorAll('input[name="address-selection"]');
  
  for (var radio of radios) {
    var correspondingLabel = document.querySelector("label[for='" + radio.id + "']");

    if (radio.checked) {
      selectedAddressType = radio.value.toUpperCase();

      correspondingLabel.classList.add("btn-primary");
      correspondingLabel.classList.remove("btn-light");
    }
    else {
      correspondingLabel.classList.add("btn-light");
      correspondingLabel.classList.remove("btn-primary");
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  var radios = document.querySelectorAll('input[name="address-selection"]');

  for (var radio of radios) {
    radio.onclick = highlightCorrectAddressButton;
  }
});
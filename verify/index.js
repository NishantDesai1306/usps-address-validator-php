function saveAddress(addressLine1, addressLine2, city, state, zip) {
  var formData = new FormData();
  formData.append('addressLine1', addressLine1);
  formData.append('addressLine2', addressLine2);
  formData.append('city', city);
  formData.append('state', state);
  formData.append('zip', zip);

  fetch('/api/save-address.php', {
    method: "POST",
    body: formData,
  })
  .then((response) => {
    console.log(response);
    window.location.href = "/saved";
  });
}
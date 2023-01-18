<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

  <link rel="stylesheet" href="index.css">
  <script src="index.js"></script>
</head>

<body>
  <?php 
    $json = file_get_contents('./helper/states.json'); 
    $states = json_decode($json,true);  
  ?>
  
  <div class="h-100 w-100 row">
    <div class="col-8 offset-2 col-sm-4 offset-sm-4 d-flex align-items-center">
      <div class="w-100 card">
        <div class="card-body">
          <div class="card-title h5">Address Validator</div>
          <div class="mb-2 text-muted card-subtitle h6">Validate/Standardizes addresses using USPS</div>
          <hr>
          <div class="mt-4">
            <form class="w-100" name="addressForm" action="/verify" onsubmit="return validation()" method="POST">
              <div class="mb-3">
                <label class="form-label">Address Line 1</label>
                <input
                  name="addressLine1"
                  type="text"
                  class="form-control"
                >
                <div id="addressLine1-error" class="text-danger"></div>
              </div>
              <div class="mb-3">
                <label class="form-label">Address Line 2</label>
                <input
                  name="addressLine2"
                  type="text"
                  class="form-control"
                >
                <div id="addressLine2-error" class="text-danger"></div>
              </div>
              <div class="mb-3">
                <label class="form-label">City</label>
                <input
                  name="city"
                  type="text"
                  class="form-control"
                >
                <div id="city-error" class="text-danger"></div>
              </div>
              <div class="mb-3">
                <label class="form-label">State</label>
                <select name="state" class="form-select">
                  <option selected disabled value="">(select)</option>
                  <?php foreach ($states as $state) { ?>
                    <option value="<?= $state["value"] ?>"><?= $state["title"]; ?></option>
                  <?php } ?>
                </select>
                <div id="state-error" class="text-danger"></div>
              </div>
              <div class="mb-3">
                <label class="form-label">Zip Code</label>
                <input
                  name="zip"
                  type="text"
                  class="form-control"
                >
                <div id="zip-error" class="text-danger"></div>
              </div>
              
              <div class="mt-4 d-flex justify-content-center">
                <button 
                  type="submit"
                  class="btn btn-primary btn-lg"
                >
                  Validate
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
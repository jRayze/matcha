<body class="bodyProfile">
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="row">
            <div class="col-md-12 py-2" id="main" style='margin-top: 56px;'>
                <h5>Profile de <?if ($_USER_NAME != null) { echo $_USER_NAME;} else { echo 'Ella Delachatte';} ?></h5>
                <br >
                <label for=validateCustomFile">Vos photos : </label>
                <form class="was-validated">
                    <img src="../img/lachatteatamere.jpg" alt="..." class="img-thumbnail" style="width: 300px; margin-bottom: 10px;">
                    <img src="../img/lachatteatamere.jpg" alt="..." class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                    <img src="../img/lachatteatamere.jpg" alt="..." class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                    <img src="../img/lachatteatamere.jpg" alt="..." class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                    <img src="../img/lachatteatamere.jpg" alt="..." class="img-thumbnail" style="width: 200px; margin-bottom: 10px;">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Selectionnez des photos au format .jpeg, .png, .gif.</div>
                    </div>

                    <label for="customControlValidation2" for="customControlValidation3" for="customControlValidation1">Orientation Sexuelle</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation2">Hétérosexuel</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation3">Homosexuel</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required>
                        <label class="custom-control-label" for="customControlValidation1">Bisexuel</label>
                        <div class="invalid-feedback">Selectionnez votre orientation sexuelle.</div>
                    </div>

                    <label for="custom-select">Genre</label>
                    <div class="mb-3">
                        <select class="custom-select" required>
                        <option></option> 
                        <option value="1">Homme</option>
                        <option value="2">Femme</option>
                        </select>
                        <div class="invalid-feedback">Selectionnez votre genre.</div>
                    </div>

                    <div class="mb-3">
                        <label for="validationTextarea">Bio</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                        <div class="invalid-feedback">
                        Ecrivez une petite biographie.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="validationTextarea">Tags</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                        <div class="invalid-feedback">
                        Choisissez des tags.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<body class="bodyAccueil">
    <div class="container-fluid">
        <!--<div class="col-md-12">-->
            <h1 class="title">Bonjour <?$_NAME?></h1>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 px-1">
                        <div class="row">
                            <div class="card">
                                    <!-- Liste des filtres (par défaut) : 
                                        1 .orientation sexuelle(bouton radio) : bisexuel(par défaut), hétérosexuel, homosexuel
                                        2. distance en km (range line) 
                                        3. centres d'intéret (bouton tag)
                                        4. score de popularité (5 étoiles cliquables)

                                        Liste de filtes ajustable :
                                        1.interval d'age (range line)
                                        2. score de popularité (5 étoiles cliquables)
                                        3. distance en km (range line)
                                        4. centres d'intéret (bouton tag)

                                    
                                     -->
                                    <div class="card-body">
                                    <form>
                                        <h4> Filtres de recherches </h4>
                                        <div class="form-group">
                                            <label for="formControlRange">Age :</label>
                                            <input type="range" class="form-control-range" id="formControlRange">
                                        </div>
                                        <div class="form-group">
                                            <label for="formControlRange">Distance en Km :</label>
                                            <input type="range" class="form-control-range" id="formControlRange">
                                        </div>
                                        <div class="form-group">
                                            <label for="formControlRange">Orientation Sexuelle :</label><br >
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Bisexuel</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Hétérosexuel</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline3">Homosexuel</label>
                                            </div>
                                        </div>
                                        <br >
                                        <div class="form-group">
                                            <label for="formControlRange">Centre d'intérêts :</label>
                                            <div class="d-flex">
                                                <span class="badge badge-pill badge-primary">Sport</span>
                                                <span class="badge badge-pill badge-primary">Voyage</span>
                                                <span class="badge badge-pill badge-primary">Cinéma</span>
                                                <span class="badge badge-pill badge-primary">Jeux video</span>
                                                <span class="badge badge-pill badge-primary">Litterature</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            Centres d'intérêt :
                                            <br ><br >
                                            <div class="d-flex">
                                                <input class="btn btn-outline-primary btn-sm" type="button" value="Sport">
                                                <input class="btn btn-outline-primary btn-sm" type="button" value="Voyage">
                                                <input class="btn btn-outline-primary btn-sm" type="button" value="Cinéma">
                                                <input class="btn btn-outline-primary btn-sm" type="button" value="Jeux video">
                                                <input class="btn btn-outline-primary btn-sm" type="button" value="Litterature">
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col" id="main">
                    <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-3" style="height:1500px;">
 
            </div>-->
        <!--</div>-->
    </div>
</body>
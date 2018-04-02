<form class="form-horizontal adminex-form" action="%BRIDGE_OPTIONLIST_SERVICE%add/" method="post" style="margin-left:auto; margin-right:auto;" >
    <section class="panel">
        <div class="panel-body">
            <div class="form-group ">
                <label for="optionType" class="control-label col-lg-2">Type</label>
                <div class="col-lg-10">%optionType%</div>
            </div>
            <div class="form-group ">
                <label for="optionValue" class="control-label col-lg-2">Valeur</label>
                <div class="col-lg-10">
                    <input class="form-control" id="optionValue" name="optionValue" required type="text" value="%optionValue%" maxlength="255" />
                </div>
            </div>
            <div class="form-group ">
                <label for="optionDisplay" class="control-label col-lg-2">Affichage</label>
                <div class="col-lg-10">
                    <select name="optionDisplay" class="form-control">
                        <option value="1" >Oui</option>
                        <option value="0" >Non</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Ajouter le choix</button>
        </div>
    </section>
</form>

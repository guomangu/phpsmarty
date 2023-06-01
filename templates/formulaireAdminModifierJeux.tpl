<div id="divMessagesJeu" class="invalid-feedback divMessagesFormulaireAdmin"></div>

<form class="formulaireAdmin customShadow" method="POST" action="" enctype="multipart/form-data" onsubmit="return validerModifJeu();" autocomplete="off">
    <div class="">
        <label for="idJeu">Selectionnez un jeu</label>
        <input type="text" class="form-control" id="idJeu" name="idJeu" list="comboJeu">
        <datalist id="comboJeu">
            {foreach from=$tabTabId['Jeux'] item=id}
                <option value="{$id}">
            {/foreach}
        </datalist>
    </div>

    <div class="">
        <label for="dateAjoutJeu">Date d'ajout</label>
        <input type="datetime-local" class="form-control" id="dateAjoutJeu" name="dateAjoutJeu"/>   
    </div>

    <div class="">
        <label for="signaleJeu">Signalé</label>
        <select id="signaleJeu" class="form-control" name="signaleJeu">
            <option></option>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </div>

    <div class="divTextarea formulaireExpand">
        <label for="titreJeu">Titre</label>
        <textarea id="titreJeu" class="form-control" name="titreJeu"></textarea>
    </div>

    <div class="divButton formulaireExpand vCenter">
        <button type="submit" class="btn btn-primary" name="modifierJeu">Modifier</button>
    </div>
</form>

<script>
    function validerModifJeu()
    {
        document.getElementById( 'divMessagesJeu' ).innerHTML = "";
        // contrôles des formulaires nécéssaires
        if ( document.getElementById( 'idJeu' ).value == "" )
        {
            document.getElementById( 'idJeu' ).classList.add( 'is-invalid' );
            document.getElementById( 'divMessagesJeu' ).innerHTML = 'Veuillez préciser un identifiant de jeu';
            return false;
        }
        else
        {
            document.getElementById( 'idJeu' ).classList.remove( 'is-invalid' );
            document.getElementById( 'idJeu' ).classList.add( 'is-valid' );
            var submitOK = false;

            if ( document.getElementById( 'dateAjoutJeu').value != "" )
            {
                document.getElementById( 'dateAjoutJeu').classList.remove( 'is-invalid' );
                document.getElementById( 'dateAjoutJeu').classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'signaleJeu' ).value != "" )
            {
                document.getElementById( 'signaleJeu' ).classList.remove( 'is-invalid' );
                document.getElementById( 'signaleJeu' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'titreJeu' ).value != "" )
            {
                document.getElementById( 'titreJeu' ).classList.remove( 'is-invalid' );
                document.getElementById( 'titreJeu' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( submitOK == false )
            {
                document.getElementById( 'dateAjoutJeu').classList.add( 'is-invalid' );
                document.getElementById( 'signaleJeu' ).classList.add( 'is-invalid' );
                document.getElementById( 'titreJeu' ).classList.add( 'is-invalid' );

                document.getElementById( 'divMessagesJeu' ).innerHTML = 'Veuillez remplir au moins 1 de ces champs.';
            }

            return submitOK;
        }
    }
</script>
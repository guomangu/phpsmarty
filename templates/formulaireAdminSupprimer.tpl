<div id="divMessagesSupprimer{$nomTable}" class="invalid-feedback divMessagesFormulaireAdmin"></div>

<form class="formulaireAdmin customShadow" method="POST" action="" enctype="multipart/form-data" onsubmit="return validerSupprimer{$nomTable}();" autocomplete="off">
    <div class="formulaireExpand">
        <label for="idSuppr{$nomTable}">Selectionnez un {$nomTable|substr:0:-1|lower}</label>
        <input type="text" id="idSuppr{$nomTable}" class="form-control" name="idSuppr{$nomTable}" list="combo{$nomTable}">
        <datalist id="combo{$nomTable}">
            {foreach from=$tabId item=id}
                <option value="{$id}">
            {/foreach}
        </datalist>
    </div>

    <div class="divButton formulaireExpand vCenter">
        <button type="submit" class="btn btn-primary" name="supprimer{$nomTable}">Supprimer</button>
    </div>
</form>

<script>
    function validerSupprimer{$nomTable}()
    {
        document.getElementById( 'divMessagesSupprimer{$nomTable}' ).innerHTML = "";

        if ( document.getElementById( "idSuppr{$nomTable}" ).value == "" )
        {
            document.getElementById( "idSuppr{$nomTable}" ).classList.add( 'is-invalid' );
            document.getElementById( 'divMessagesSupprimer{$nomTable}' ).innerHTML = 'Veuillez préciser un identifiant a supprimer ';
            var submitOK = false;
        }
        else
        {
            if ( document.getElementById( 'idSuppr{$nomTable}').value != "" )
            {
                document.getElementById( 'idSuppr{$nomTable}').classList.remove( 'is-invalid' );
                document.getElementById( 'idSuppr{$nomTable}').classList.add( 'is-valid' );
                submitOK = true;
            }  
        }
        return submitOK;
    }
</script>
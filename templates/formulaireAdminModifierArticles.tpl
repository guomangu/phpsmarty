<div id="divMessagesArticle" class="invalid-feedback divMessagesFormulaireAdmin"></div>

<form class="formulaireAdmin customShadow" method="POST" action="" enctype="multipart/form-data" onsubmit="return validerModifArticle();" autocomplete="off">
    <div class="">
        <label for="idArticle">Selectionnez un article</label>
        <input type="text" id="idArticle" class="form-control" name="idArticle" list="comboArticle">
        <datalist id="comboArticle">
            {foreach from=$tabTabId['Articles'] item=id}
                <option value="{$id}">
            {/foreach}
        </datalist>
    </div>

    <div class="">
        <label for="dateAjoutArticle">Date d'ajout</label>
        <input type="datetime-local" class="form-control" id="dateAjoutArticle" name="dateAjoutArticle"/>   
    </div>

    <div class="">
        <label for="signaleArticle">Signalé</label>
        <select id="signaleArticle" class="form-control" name="signaleArticle">
            <option></option>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
    </div>

    <div class="">
        <label for="idArticleJeux">Identifiant jeu</label>
        <input type="text" id="idArticleJeux" class="form-control" name="idArticleJeux" list="comboArticleJeux">
        <datalist id="comboArticleJeux">
            {foreach from=$tabTabId['Jeux'] item=id}
                <option value="{$id}">
            {/foreach}
        </datalist>
    </div>

    <div class="">
        <label for="idArticleCategories">Catégorie Article</label>
        <input type="text" id="idArticleCategories" class="form-control" name="idArticleCategories" list="comboArticleCategories">
        <datalist id="comboArticleCategories">
            {foreach from=$tabTabId['CatArticles'] item=id}
                <option value="{$id}">
            {/foreach}
        </datalist>
    </div>

    <div class="divTextarea formulaireExpand">
        <label for="texteArticle">Texte</label>
        <textarea id="texteArticle" class="form-control" name="texteArticle"></textarea>
    </div>

    <div class="divButton formulaireExpand vCenter">
        <button type="submit" class="btn btn-primary" name="modifierArticle">Modifier</button>
    </div>
</form>

<script>
    function validerModifArticle()
    {
        document.getElementById( 'divMessagesArticle' ).innerHTML = "";
        // contrôles des formulaires nécéssaires
        if ( document.getElementById( 'idArticle' ).value == "" )
        {
            document.getElementById( 'idArticle' ).classList.add( 'is-invalid' );
            document.getElementById( 'divMessagesArticle' ).innerHTML = 'Veuillez préciser un identifiant de l\'article';
            return false;
        }
        else
        {
            document.getElementById( 'idArticle' ).classList.remove( 'is-invalid' );
            document.getElementById( 'idArticle' ).classList.add( 'is-valid' );
            var submitOK = false;

            if ( document.getElementById( 'dateAjoutArticle').value != "" )
            {
                document.getElementById( 'dateAjoutArticle').classList.remove( 'is-invalid' );
                document.getElementById( 'dateAjoutArticle').classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'signaleArticle' ).value != "" )
            {
                document.getElementById( 'signaleArticle' ).classList.remove( 'is-invalid' );
                document.getElementById( 'signaleArticle' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'idArticleJeux' ).value != "" )
            {
                document.getElementById( 'idArticleJeux' ).classList.remove( 'is-invalid' );
                document.getElementById( 'idArticleJeux' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'idArticleCategories' ).value != "" )
            {
                document.getElementById( 'idArticleCategories' ).classList.remove( 'is-invalid' );
                document.getElementById( 'idArticleCategories' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( document.getElementById( 'texteArticle' ).value != "" )
            {
                document.getElementById( 'texteArticle' ).classList.remove( 'is-invalid' );
                document.getElementById( 'texteArticle' ).classList.add( 'is-valid' );
                submitOK = true;
            }

            if ( submitOK == false )
            {
                document.getElementById( 'dateAjoutArticle').classList.add( 'is-invalid' );
                document.getElementById( 'signaleArticle' ).classList.add( 'is-invalid' );
                document.getElementById( 'idArticleJeux' ).classList.add( 'is-invalid' );
                document.getElementById( 'idArticleCategories' ).classList.add( 'is-invalid' );
                document.getElementById( 'texteArticle' ).classList.add( 'is-invalid' );

                document.getElementById( 'divMessagesArticle' ).innerHTML = 'Veuillez remplir au moins 1 de ces champs.';
            }

            return submitOK;
        }
    }
</script>
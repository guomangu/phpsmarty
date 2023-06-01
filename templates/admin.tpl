{extends file="templates/accueil.tpl"}

{block name=customStyle}
    <link rel="stylesheet" href="templates/assets/css/admin.css" />
{/block}

{block name=headJS}
<script>
    function removeAllChildren( node )
    {
        while ( node.firstChild ) 
        {
            node.removeChild( node.firstChild );
        }
    }

    function creerPagination( nomOnglet, idDernierLi, maxPages )
    {
        var lastLi = document.getElementById( idDernierLi );
        var ul = lastLi.parentNode;
        
        for ( i = 1; i <= maxPages; ++i )
        {
            var p = document.createElement("p");
            p.setAttribute("class", "page-link");
            p.setAttribute("onclick", "setCurrentPage"+nomOnglet+"( " + i + " )");
            p.innerText = i;

            var li = document.createElement("li");
            li.setAttribute("class", "page-item");

            li.appendChild(p);

            ul.insertBefore(li, lastLi);
        }
    }
</script>
{/block}

{block name=background}
{/block}

{block name=barreRecherche}
{/block}

{block name=blocMain}
<main>
    <div class="divPresentation">
        <h2>Administration</h2>
    </div>

    {* onglets tableaux *}
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            {* jeux *}
            <a class="nav-item nav-link active" id="nav-jeux-tab" data-toggle="tab" href="#nav-jeux" role="tab"
                aria-controls="nav-home" aria-selected="true">Jeux</a>
            {* articles *}
            <a class="nav-item nav-link" id="nav-articles-tab" data-toggle="tab" href="#nav-articles" role="tab"
                aria-controls="nav-profile" aria-selected="false">Articles</a>
            {* commentaires *}
            <a class="nav-item nav-link" id="nav-commentaires-tab" data-toggle="tab" href="#nav-commentaires" role="tab"
                aria-controls="nav-contact" aria-selected="false">Commentaires</a>
            {* images *}
            <a class="nav-item nav-link" id="nav-images-tab" data-toggle="tab" href="#nav-images" role="tab"
                aria-controls="nav-contact" aria-selected="false">Images</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <!-- jeux -->
        <div class="tab-pane fade show active" id="nav-jeux" role="tabpanel" aria-labelledby="nav-jeux-tab">
            <!-- affichage du tableau et de la pagination -->
            {include file='templates/afficherTableau.tpl' nomTable = $nomTableJeux cheminModifier=$urlModifierJeux}
        </div>

        <!-- articles -->
        <div class="tab-pane fade" id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab">
            <!-- affichage du tableau et de la pagination -->
            {include file='templates/afficherTableau.tpl' nomTable = $nomTableArticles cheminModifier=$urlModifierArticles}
        </div>

        <!-- commentaires -->
        <div class="tab-pane fade" id="nav-commentaires" role="tabpanel" aria-labelledby="nav-commentaires-tab">
            <!-- affichage du tableau et de la pagination -->
            {include file='templates/afficherTableau.tpl' nomTable = $nomTableCommentaires cheminModifier=$urlModifierCommentaires}
        </div>

        <!-- images -->
        <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
            <!-- affichage du tableau et de la pagination -->
            {include file='templates/afficherTableau.tpl' nomTable = $nomTableImages cheminModifier=$urlModifierImages}
        </div>
    </div>

</main>
{/block}

{block name=barreRechercheJS}
{/block}
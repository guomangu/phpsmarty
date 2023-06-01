{block name='header'}
<header class="customShadow">
    <!-- menu burger -->
    <div id="divBurger">
        <input id="burger" type="checkbox" />

        <label for="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav>
            <hr />
            <a href="liste.php">Liste de jeux complète</a>
            <a href="listeAlpha.php">Liste de jeux alphabétique</a>
            <hr />
            <a href="universHasard.php">Univers au hasard</a>
            <a href="feelingsHasard.php">Instant au hasard</a>
            <a href="instantsHasard.php">Feeling au hasard</a>
            <hr />
            <a href="pageJeu.php">Un jeu au hasard</a>
        </nav>
    </div>

    <!-- titre -->
    <h1><a href="index.php">{$nomSite}</a></h1>

    {block name=barreRecherche}
    <!-- barre de recherche : on s'assure que le autocomplete du formulaire est sur off-->
    <form id="barreRecherche" method="GET" autocomplete="off" action="index.php">
        <div class="autocomplete" style="width:300px;">
            <input id="inputRecherche" type="text" name="{$nameInputRecherche}" placeholder="{$placeholderInputRecherche}">
        </div>

        <input type="submit" class="btn btn-primary">
    </form>
    {/block}
</header>
{/block}
{extends file='templates/accueil.tpl'}

{block name=customStyle}
<link rel="stylesheet" href="templates/assets/css/articlesHasard.css" />
{/block}

{* affichage de plusieurs articles de la même catégorie au hasard *}
{block name=blocMain}
<main>
    <div id="divConteneur">
        <div class="divPresentation customShadow">
            <h2>{$messagePresentation}</h2>
        </div>
        
        {* présentation extraits produits *}
        {if isset($tabArticles)}
            <div class="divExtraits">
            {foreach from=$tabArticles item=article name=tab}
                <div class="divArticle customShadow">
                    <p>{$article->getTexte()}</p>
                    <a class="btn btn-primary" href="{$link->getPageJeuByIdLink($article->getIdJeu())}">Lire Plus</a>
                </div>
            {/foreach}
            </div>
        {/if}
    </div>
</main>
{/block}

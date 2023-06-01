{extends file='templates/accueil.tpl'}

{* liste complete triée par date d'ajout la plus récente *}
{block name=blocMain}
<main>
    <div id="divConteneur">
        <div class="divPresentation customShadow">
            <h2>{$messagePresentation}</h2>
        </div>
        
        {* présentation extraits produits *}
        {if isset($tabProduitsDate)}
            <div class="divExtraits">
            {foreach from=$tabProduitsDate item=produit name=tab}
                <div class="divProduitAccueil customShadow">
                    <h3>{$produit->getTitre()}</h3>

                    {assign "article" $produit->getRandArticle()}
                    {if !empty($article)}
                        {assign "articleTexte" $produit->getRandArticle()->getTexte()}
                        {if !empty($articleTexte)}
                        <p>{$articleTexte}</p>
                        {else}
                        <p>Soyez le premier à ajouter un article</p>
                        {/if}
                    {else}
                    <p>Soyez le premier à ajouter un article</p>
                    {/if}
                    
                    <a class="btn btn-primary" href="{$link->getPageJeuByIdLink($produit->getIdJeu())}">Lire Plus</a>
                </div>
            {/foreach}
            </div>
        {/if}
        
        {* pagination *}
        <ul class="pagination pagination-sm">
        {for $var=1 to $nombrePages}
            {if $var == $pageActuelle}
                <li class="page-item active"><a class="page-link" href="liste.php?page={$var}">{$var}</a></li>
            {else}
                <li class="page-item"><a class="page-link" href="liste.php?page={$var}">{$var}</a></li>
            {/if}
        {/for}
        </ul>
    </div>
</main>
{/block}
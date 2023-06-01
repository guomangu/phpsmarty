{extends file='templates/accueil.tpl'}

{* liste complete triée lettre et date d'ajout la plus récente *}
{block name=blocMain}
<main>
    <div id="divConteneur">
        {* pagination alphabétique *}
        {if !empty($tabValidAlphaNumList)}
            <ul class="pagination pagination-sm">
                {* alphabet *}
                {foreach from=$tabValidAlphaNumList['alpha'] item=valid key=char}
                    {if $valid}
                        {if $char == $catAlpha}
                        <li class="page-item active"><a class="page-link" href="listeAlpha.php?catAlpha={$char}">{$char}</a></li>
                        {else}
                        <li class="page-item"><a class="page-link" href="listeAlpha.php?catAlpha={$char}">{$char}</a></li>
                        {/if}
                    {else}
                    <li class="page-item disabled"><a class="page-link" href="#">{$char}</a></li>
                    {/if}
                {/foreach}
                {* numériques *}
                {if $tabValidAlphaNumList['num'] == true}
                    {if $catAlpha == 'num'}
                    <li class="page-item active"><a class="page-link" href="listeAlpha.php?catAlpha=num">0-9</a></li>
                    {else}
                    <li class="page-item"><a class="page-link" href="listeAlpha.php?catAlpha=num">0-9</a></li>
                    {/if}
                {else}
                <li class="page-item disabled"><a class="page-link" href="#">0-9</a></li>
                {/if}
                {* autres *}
                {if $tabValidAlphaNumList['nonAlphaNum'] == true}
                    {if $catAlpha == 'nonAlphaNum'}
                    <li class="page-item active"><a class="page-link" href="listeAlpha.php?catAlpha=nonAlphaNum">Autres</a></li>
                    {else}
                    <li class="page-item"><a class="page-link" href="listeAlpha.php?catAlpha=nonAlphaNum">Autres</a></li>
                    {/if}
                {else}
                <li class="page-item disabled"><a class="page-link" href="#">Autres</a></li>
                {/if}
            </ul>
        {/if}

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
                <li class="page-item active"><a class="page-link" href="listeAlpha.php?catAlpha={$catAlpha}&page={$var}">{$var}</a></li>
            {else}
                <li class="page-item"><a class="page-link" href="listeAlpha.php?catAlpha={$catAlpha}&page={$var}">{$var}</a></li>
            {/if}
        {/for}
        </ul>
    </div>
</main>
{/block}
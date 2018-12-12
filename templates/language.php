<?php 
    function draw_language($language) {
        //$get = http_get("../api/language.php", array("code" => $language), $snippets);
        $snippets = getLanguageSnippets($language);
        $lang = getLanguage($language);
    ?>
        <div class="main-content center">
            <div class="language-info flex-row-container flex-vert-center">
                <h1 data-code="<?=htmlentities($language)?>"><?=$lang['name']?></h1>
                <div class="follow-button-wrapper" data-code="<?=$language?>">
                    <span class="follow-button">Follow</span>
                </div>
            </div>
            <div class="snippets">
                <?php 
                if (count($snippets) == 0) { ?> 
                    <div class="no-snippets flex-row-container">
                        <span>This language doesn't have snippets.</span>
                        <a href="../pages/new.php">Add one!</a>
                    </div>

                <?php } else {
                foreach ($snippets as $snippet) { 
                $name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
                $countComments = getSnippetCommentCount($snippet['id']);
                $lang = 'language-' . $snippet['language']; ?>
                <div class="snippet-wrapper-feed">
                    <header class="snippet-header flex-row-container flex-space-between flex-vert-center">
                        <div class="rating-wrapper">
                            <span id="snippetId"><?=$snippet['id']?></span>
                            <i class="fas fa-caret-up"></i>
                            <span class="snippet-rating"><?=$snippet['points']?></span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <h1 class="card-title"><?=$snippet['title']?></h1>
                        <div class="language-wrapper">
                            <?=$snippet['languageName']?>
                        </div>
                    </header>
                    <a href="/pages/snippet.php?id=<?=$snippet['id']?>" target="_blank">
                        <pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
                    </a>
                    <footer class="snippet-footer flex-row-container flex-space-between flex-vert-center">
                        <div class="snippet-author-date flex-row-container flex-vert-center">
                            <span class="author-name"><?=$name?></span>
                            <span class="date-posted"><?=getTimeElapsed($snippet['date'])?></span>
                        </div>
                            <span class="comments"><?=$countComments['count']?></span>
                    </footer>
                </div>
            </div>
            <?php }} ?>
<?php
    }
?>
<?php 

    function draw_search($users, $channels, $snippets, $search) {?>
        <div class="search-page main-content center">
            <header class="flex-row-container flex-space-between flex-vert-center">
                 <h1> Search results for "<?=htmlspecialchars($search)?>": </h1>
                <div class="tabs">
                    <button> All </button>
                    <button> Users </button>
                    <button> Channels </button>
                    <button> Snippets </button>
                </div>
            </header>
            <div class="users-search">
                <header class="flex-row-container flex-vert-center">
                    <h1> Users </h1>
                    <h2> <?=count($users)?>
                </header>
                <?php foreach ($users as $user) { ?>
                    <div class="hoverable-card">
                        <a class="hoverable-card-content" href="/pages/profile.php?id=<?=$user['id']?>">
                            <div class="user-info-search flex-row-container flex-vert-center">
                                <img src=<?=getPicture($user['id'])?> />
                                <span class="name"> <?=$user['match']?> </span>
                                <span class="username"> <?=$user['username']?></span>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div> 
            <div class="channels-search">
                <header class="flex-row-container flex-vert-center">
                    <h1> Channels </h1>
                    <h2> <?=count($channels)?>
                </header>
                <?php foreach ($channels as $channel) { ?>
                    <div class="hoverable-card">
                        <a class="hoverable-card-content" href="/pages/channels.php?code=<?=$channel['code']?>">
                            <div class="channel-info">
                                <span class="name"> <?=$channel['match']?> </span>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div> 
            <div class="snippets-search">
                <header class="flex-row-container flex-vert-center">
                    <h1> Snippets </h1>
                    <h2> <?=count($snippets)?>
                </header>
                <?php foreach ($snippets as $snippet) { ?>
                    <div class="hoverable-card">
                        <a class="hoverable-card-content" href="/pages/snippet.php?id=<?=$snippet['id']?>">
                            <div class="snippet-info">
                                <span class="title"> <?=$snippet['match']?> </span>
                            </div>
                            <div class="language-wrapper"> <?=$snippet['languageName']?> </div>
                        </a>
                        <div class="hover-content">
                            <span class="points"> <?=$snippet['points']?> </span>
                        </div>
                    </div>
                <?php } ?>
            </div> 
        </div>

    <?php } ?>


<div class="row">
    <div class="col-sm-8">
        <?php
        foreach( $oPosts as $oPost ) {
            ?>
            <h2><a href="<?= $oPost->url; ?>"><?= $oPost->title; ?></a></h2>
            <p><em><?= $oPost->category ?></em></p>
            <p><?= $oPost->resume; ?></p>
            <?php
        }
        ?>
    </div>
    <div class="col-sm-4">
        <ul>
            <?php
            foreach( $oCategories as $oCategory ) {
                ?>
                <li><a href="<?= $oCategory->url; ?>"><?= $oCategory->title ?></a></li>
                <?php
            }

            ?>
        </ul>
    </div>
</div>

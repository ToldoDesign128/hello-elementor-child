<!-- Questo blocco è l'output delle pagine di secondo livello -->

<div id="postID-<?php echo $post->ID;?>" class="sub__menu__list__page col-4">
    <div class="">
        <a href="<?php the_permalink();?>"> <!-- href temporaneo -->
            <h4 class=""><?php the_title();?></h4>
        </a>
    </div>
</div>
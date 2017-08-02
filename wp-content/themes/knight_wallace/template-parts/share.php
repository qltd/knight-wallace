<div class="small-6 columns text-right">
    <p class="share-wrap">Share:
        <a href="https://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?> https://<?php echo urlencode($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="mailto:?subject=[Shared from wallacehouse.umich.edu] <?php the_title();?>&body=<?php the_permalink();?>"><i class="fa fa-envelope"></i></a>
    </p>
</div>
<?php
/**
 * Ajax Controller for Wallace House Site
 * all requests require an 'action' param
 * @rdarling
 *
 * */

include_once('helpers.php');
include_once('../../../wp-blog-header.php');
$res = '';

//GET requests
if(!empty($_GET['action'])){
    switch($_GET['action']){
    case 'past_winners':
        $winners = get_posts(array('post_type'=>'person_livingston','posts_per_page'=> -1));
        $sorted_winners = sort_past_winners($winners,$_GET['year']);
        if(!empty($sorted_winners)){
            foreach($sorted_winners as $win){
                $res .= '
<div class="row">
    <div class="large-12 columns">
        <div class="past-winner">
            <div class="name">'.$win['first_name'].' '.$win['last_name'].','.$win['age'].'</div>
            <div class="lib-item"><a href="'.$win['library_link'].'">'.$win['lib'].'</a></div> 
            <div class="aff">'.$win['aff'].'</div> 
            <div class="job">'.$win['job'].'</div> 
            <div class="tags">'.$win['year'].' | '.$win['winner'].' | '.$win['type'].'</div>
        </div>
    </div>
</div>';
            }
        }

        break;
    }
}

echo $res;

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
        $award = !empty($_GET['award']) ? $_GET['award'] : null;
        $year = !empty($_GET['year']) ? $_GET['year'] : 'all';
        $sorted_winners = sort_past_winners($winners,$year,$award);
        if(!empty($sorted_winners)){
            foreach($sorted_winners as $win){
                $res .= '
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="past-winner">
            <div class="name">'.$win['first_name'].' '.$win['last_name'].'</div>
            <div class="lib-item"><a href="'.$win['library_link'].'">'.$win['lib'].'</a></div> 
            <div class="winning">
                <span class="job">'.$win['past_job'].',</span> <span class="aff">'.$win['past_aff'].'</span> 
            </div>
            <div class="current">';
            if(!empty($win['job'])){
                $res .= '<span class="job">Current Assignment: '.$win['job'].', </span>';
            }
            if(!empty($win['aff'])){
                $res .= '<span class="aff">'.$win['aff'].'</span>';
            }
            $res .= '</div>
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

<?php
/**
 * Some helpful functions that can be reused in various templates
 * @rdarling42
 *
 * */

/**
 * function sort_homepage_featured_content_blocks
 * takes an array of objects, each object is a hompage featured content block
 * returns a multidim array, 3 main items will all relevant content or false if given an invalid array 
 * @rdarling42
 * **/
function sort_homepage_featured_content_blocks($content){
    $res = array(
        'Wallace House' => array(),
        'Knight-Wallace Fellowships' => array(),
        'Livingston Awards' => array(),
    );
    if(!empty($content)){
        foreach($content as $c){
            $pmeta = get_post_meta($c->ID); 
            $pimage = get_the_post_thumbnail($c->ID);
            if(!empty($pmeta)){
                $res[$pmeta["_fcb_which_page"][0]][] = array(
                    'title' => $c->post_title,
                    'image' => !empty($pimage) ? $pimage : false,
                    'content' => $c->post_content,
                    'link' => $pmeta["_fcb_link"][0]
                );
            }
        } 
    }else{
        $res = false; 
    }
    return $res;
}

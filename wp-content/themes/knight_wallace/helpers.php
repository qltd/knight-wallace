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

function sort_hero_content($content){
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
                $res[$pmeta["_hero_content_which_page"][0]][] = array(
                    'title' => $c->post_title,
                    'image' => !empty($pimage) ? $pimage : false,
                    'content' => $c->post_content,
                    'link' => $pmeta["_hero_content_link"][0]
                );
            }
        } 
    }else{
        $res = false; 
    }
    return $res;
}

/**
 * function random_hero_content
 * takes 2 arguments, the first is a multidim array containing hero content from all 3 pages
 * the second is which page we are displaying this on
 * returns a simple array of hero content to display
 * @rdarling42
 *
 * */

function random_hero_content($content,$page){
    if(empty($content) || empty($page)){
        $res = false; 
    }else{
        $count = count($content[$page]);  
        $random_number = rand(0,$count - 1);
        $res = $content[$page][$random_number];
    }
    return $res;
}

/**
 * function turn_img_tag_to_url
 * takes 1 argumant, an html image tag
 * returns the value of the src attribute
 * @rdarling42
 *
 * */

function turn_img_tag_to_url($img){
    if(empty($img)){
        $src = ''; 
    }else{
        $doc = new DOMDocument();
        $doc->loadHTML($img);
        $xpath = new DOMXPath($doc);
        $src = $xpath->evaluate("string(//img/@src)");
    }
    return $src;
}

function sort_library_items($lib){
    if(!empty($lib)){
        $cats = array(
            'Article' => array(),
            'Book' => array(),
            'Video' => array(),
            'Photojournalism' => array(),
            'Journal' => array()
        );
        foreach($lib as $li){
            $pmeta = get_post_meta($li->ID); 
            $pimage = get_the_post_thumbnail($li->ID);
            $tags = get_the_tags($li->ID);
            if(!empty($pmeta) && !empty($pmeta['_library_item_type'])){
                $cats[$pmeta['_library_item_type'][0]][] = array(
                    'content' => $li->post_content,
                    'title' => $li->post_title,
                    'link' => "/?post_type=library&p={$li->ID}",
                    'slug' => $li->post_name,
                    'image' => $pimage,
                    'publisher' => !empty($pmeta['_library_publisher'][0]) ? $pmeta['_library_publisher'][0] : '',
                    'author' => !empty($pmeta['_library_author'][0]) ? $pmeta['_library_author'][0] : '',
                    'date' => $li->post_date,
                    'tags' => $tags
                );
            }
        }
        $res = $cats;
    }else{
        $res = false; 
    }
    return $res;
}

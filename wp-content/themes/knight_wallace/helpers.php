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

/**
 * Sort Library Items
 *
 **/

function sort_library_items($lib){
    if(!empty($lib)){
        $cats = array(
            'Article' => array(),
            'Book' => array(),
            'Video' => array(),
            'Photojournalism' => array(),
            'Journal' => array(),
            'featured' => array()
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
            if(!empty($pmeta['_library_featured'])){
                $cats['featured'][] = array(
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

function sort_library_items_sub_cat($lib,$cat){
    if(!empty($lib)){
        $res = array();
        foreach($lib as $li){
            $pmeta = get_post_meta($li->ID); 
            $pimage = get_the_post_thumbnail($li->ID);
            $tags = get_the_tags($li->ID);
            if(!empty($pmeta) && !empty($pmeta['_library_item_type']) && $pmeta['_library_item_type'][0] == $cat){
                $res[] = array(
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
            if(!empty($pmeta['_library_featured']) && !empty($pmeta['_library_item_type']) && $pmeta['_library_item_type'][0] == $cat){
                $res['featured'][] = array(
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
    }else{
        $res = false; 
    }

    return $res;
}

/**
 * Sort Award winners
 * */

function sort_winners($winners, $year='2015'){
    if(!empty($winners)){
        $res = array();
        foreach($winners as $win){
            $pmeta = get_post_meta($win->ID); 
            $pimage = get_the_post_thumbnail($win->ID);
            if(!empty($pmeta['_kw_person_liv_win']) 
                && !empty($pmeta['_kw_person_liv_year']) 
                && is_winner_or_co_winner($pmeta['_kw_person_liv_win'][0]) 
                && $pmeta['_kw_person_liv_year'][0] == $year 
                && !empty($pmeta['_kw_person_liv_type']) 
                && $pmeta['_kw_person_liv_type'][0] != 'Richard M. Clurman Award'){
                    //Here we have a winner that we want to display on the winners page
                    $lib_item_name = !empty($pmeta['_kw_person_liv_lib']) ? $pmeta['_kw_person_liv_lib'][0] : '';
                    $lib_item = get_custom_post_by_title('library',$lib_item_name);//get the full library object
                    $lib_image = get_the_post_thumbnail(!empty($lib_item) ? $lib_item->ID : '');
                    $res[] = array(
                        'type' => !empty($pmeta['_kw_person_liv_type']) ? $pmeta['_kw_person_liv_type'][0] : '',
                        'first_name' => !empty($pmeta['_kw_person_liv_first_name']) ? $pmeta['_kw_person_liv_first_name'][0] : '',
                        'last_name' => !empty($pmeta['_kw_person_liv_last_name']) ? $pmeta['_kw_person_liv_last_name'][0] : '',
                        'age' => !empty($pmeta['_kw_person_liv_age']) ? $pmeta['_kw_person_liv_age'][0] : '',
                        'ass' => !empty($pmeta['_kw_person_liv_ass']) ? $pmeta['_kw_person_liv_ass'][0] : '',
                        'job' => !empty($pmeta['_kw_person_liv_job']) ? $pmeta['_kw_person_liv_job'][0] : '',
                        'aff' => !empty($pmeta['_kw_person_liv_aff']) ? $pmeta['_kw_person_liv_aff'][0] : '',
                        'lib' => $lib_item_name,
                        'id' => $win->ID,
                        'image' => $pimage,
                        'library_link' => !empty($lib_item) ? '?post_type=library&p='.$lib_item->ID : '',
                        'library_image' => $lib_image,
                        'winner_quote' => !empty($pmeta['_kw_person_liv_quote']) ? $pmeta['_kw_person_liv_quote'][0] : '',
                        'lib_item_des' => !empty($lib_item) ? $lib_item->post_content : ''
                    );
            }
        }
    }else{
        $res = false;
    }

    return $res;
}

/**
 * Sort Finalists
 * */

function sort_finalists($finalists, $year='2015'){
    if(!empty($finalists)){
        $res = array(
           'Excellence in Local Reporting' => array(),
           'Excellence in National Reporting' => array(),
           'Excellence in International Reporting' => array()
        );
        foreach($finalists as $fin){
            $pmeta = get_post_meta($fin->ID); 
            $pimage = get_the_post_thumbnail($fin->ID);
            if(!empty($pmeta['_kw_person_liv_win']) 
                && !empty($pmeta['_kw_person_liv_year']) 
                && !is_winner_or_co_winner($pmeta['_kw_person_liv_win'][0]) 
                && $pmeta['_kw_person_liv_year'][0] == $year 
                && !empty($pmeta['_kw_person_liv_type']) 
                && $pmeta['_kw_person_liv_type'][0] != 'Richard M. Clurman Award'){
                    //Here we have a finalist that we want to display on the finalists page
                    $lib_item_name = !empty($pmeta['_kw_person_liv_lib']) ? $pmeta['_kw_person_liv_lib'][0] : '';
                    $lib_item = get_custom_post_by_title('library',$lib_item_name);//get the full library object
                    $lib_image = get_the_post_thumbnail(!empty($lib_item) ? $lib_item->ID : '');
                    $res[$pmeta['_kw_person_liv_type'][0]][] = array(
                        'type' => !empty($pmeta['_kw_person_liv_type']) ? $pmeta['_kw_person_liv_type'][0] : '',
                        'first_name' => !empty($pmeta['_kw_person_liv_first_name']) ? $pmeta['_kw_person_liv_first_name'][0] : '',
                        'last_name' => !empty($pmeta['_kw_person_liv_last_name']) ? $pmeta['_kw_person_liv_last_name'][0] : '',
                        'age' => !empty($pmeta['_kw_person_liv_age']) ? $pmeta['_kw_person_liv_age'][0] : '',
                        'ass' => !empty($pmeta['_kw_person_liv_ass']) ? $pmeta['_kw_person_liv_ass'][0] : '',
                        'job' => !empty($pmeta['_kw_person_liv_job']) ? $pmeta['_kw_person_liv_job'][0] : '',
                        'aff' => !empty($pmeta['_kw_person_liv_aff']) ? $pmeta['_kw_person_liv_aff'][0] : '',
                        'lib' => $lib_item_name,
                        'id' => $fin->ID,
                        'image' => $pimage,
                        'library_link' => !empty($lib_item) ? '?post_type=library&p='.$lib_item->ID : '',
                        'library_image' => $lib_image,
                        'winner_quote' => !empty($pmeta['_kw_person_liv_quote']) ? $pmeta['_kw_person_liv_quote'][0] : '',
                        'lib_item_des' => !empty($lib_item) ? $lib_item->post_content : ''
                    );
            }
        }
    }else{
        $res = false;
    }

    return $res;
}
/**
 * Get Custom Post Object by Title
 * Returns an empty string or an object containing a custom post
 *
 * */

function get_custom_post_by_title($post_type, $title){
    $res = '';
    $dig = get_posts(array('post_type'=> $post_type,'posts_per_page' => -1));
    if(!empty($dig)){
        foreach($dig as $p){
            if($p->post_title == $title){
                $res = $p; 
                break;//break because we found what we need
            }
        } 
    }
    return $res;
}

/**
 * Sort Past Winners
 *
 * */

function sort_past_winners($winners, $year='2015', $type_array=null){
    if(!empty($winners)){
        $res = array();
        foreach($winners as $win){
            $pmeta = get_post_meta($win->ID); 
            $award_type = !empty($pmeta['_kw_person_liv_type']) ? $pmeta['_kw_person_liv_type'][0] : '';
            if(!empty($pmeta['_kw_person_liv_win']) 
                && !empty($pmeta['_kw_person_liv_year']) 
                && is_winner_or_co_winner($pmeta['_kw_person_liv_win'][0])
                && is_matching_year($pmeta['_kw_person_liv_year'][0],$year)
                && is_correct_type($type_array,$award_type)){
                    //Here we have a winner that we want to display on the winners page
                    $lib_item_name = !empty($pmeta['_kw_person_liv_lib']) ? $pmeta['_kw_person_liv_lib'][0] : '';
                    $lib_item = get_custom_post_by_title('library', $lib_item_name);//get the full library object
                    $res[] = array(
                        'type' => $award_type,
                        'first_name' => !empty($pmeta['_kw_person_liv_first_name']) ? $pmeta['_kw_person_liv_first_name'][0] : '',
                        'last_name' => !empty($pmeta['_kw_person_liv_last_name']) ? $pmeta['_kw_person_liv_last_name'][0] : '',
                        'age' => !empty($pmeta['_kw_person_liv_age']) ? $pmeta['_kw_person_liv_age'][0] : '',
                        'ass' => !empty($pmeta['_kw_person_liv_ass']) ? $pmeta['_kw_person_liv_ass'][0] : '',
                        'job' => !empty($pmeta['_kw_person_liv_job']) ? $pmeta['_kw_person_liv_job'][0] : '',
                        'aff' => !empty($pmeta['_kw_person_liv_aff']) ? $pmeta['_kw_person_liv_aff'][0] : '',
                        'lib' => $lib_item_name,
                        'id' => $win->ID,
                        'library_link' => !empty($lib_item) ? '?post_type=library&p='.$lib_item->ID : '',
                        'winner' => !empty($pmeta['_kw_person_liv_win']) ? $pmeta['_kw_person_liv_win'][0] : '',
                        'year' => !empty($pmeta['_kw_person_liv_year']) ? $pmeta['_kw_person_liv_year'][0] : ''
                    );
            }
        }
    }else{
        $res = false;
    }

    return $res;
}

function is_matching_year($needle, $haystack){
    if($haystack == 'all'){
        $res = true; 
    }elseif(is_array($haystack)){
        $res = in_array($needle, $haystack); 
    }else{
        $res = $needle == $haystack ? true : false; 
    }
    return $res;
}

function is_winner_or_co_winner($winner){
    return $winner == 'Co-Winner' || $winner == 'Winner' ? true : false;
}

function is_correct_type($type_array, $award_type){
    //$type_array is the awards that a user wants to view
    //$award_type is a string, the award type that the LA Winner won
    if($award_type == 'Richard M. Clurman Award'){
        $res = false; //we are not including Clurman Award at all
    }elseif(is_null($type_array)){
        $res = true; 
    }elseif(is_array($type_array)){
        $full_name_filter = array(
            'Excellence in Local Reporting' => 'Local Reporting', 
            'Excellence in National Reporting' => 'National Reporting', 
            'Excellence in International Reporting' => 'International Reporting', 
            'Richard M. Clurman Award' => 'Clurman Award' 
        );
        $res = in_array($full_name_filter[$award_type], $type_array); 
    }else{
        //it's possible to just past a string for $type_array to this function
        $res = $type == $award_type ? true : false;
    }

    return $res;
}

/**
 * Sort Fellows by year
 * takes an array of objects, each one being a "fellow", and returns only those which 
 * fit the desired year string. if year string is null, returns everything.
 * returns false if array of objects is empty
 *
 * */

function sort_fellows_by_year($fellows,$year=null){
    if(!empty($fellows)){
        $res = array();
        foreach($fellows as $fellow){
            $pmeta = get_post_meta($fellow->ID); 
            if(!empty($pmeta['_kw_person_kw_class_year']) 
                && $pmeta['_kw_person_kw_class_year'][0] == $year 
                || is_null($year)){
                $res[] = array(
                    'image' => get_the_post_thumbnail($fellow->ID),
                    'link' => $fellow->guid,
                    'first_name'=> !empty($pmeta['_kw_person_kw_fellow_first_name']) ? $pmeta['_kw_person_kw_fellow_first_name'][0] : '',
                    'last_name' => !empty($pmeta['_kw_person_kw_fellow_last_name']) ? $pmeta['_kw_person_kw_fellow_last_name'][0] : '',
                    'title' => !empty($pmeta['_kw_person_kw_study_pro_title']) ? $pmeta['_kw_person_kw_study_pro_title'][0] : '',
                    'bio' => !empty($pmeta['_kw_person_kw_bio']) ? $pmeta['_kw_person_kw_bio'][0] : '',
                    'aff' => !empty($pmeta['_kw_person_kw_aff']) ? $pmeta['_kw_person_kw_aff'][0] : '',
                    'job'=> !empty($pmeta['_kw_person_kw_current_job_title']) ? $pmeta['_kw_person_kw_current_job_title'][0] : ''
                );
            }
        } 
    }else{
        $res = false; 
    }

    return $res;
}

/**
 * Sort Judges
 *
 * */

function sort_judges($judges){
    if(!empty($judges)){
        $res = array(
            'National' => array(),
            'Regional' => array()
        );
        foreach($judges as $judge){
            $image = get_the_post_thumbnail($judge->ID); 
            $pmeta = get_post_meta($judge->ID); 
            if(!empty($pmeta['_kw_person_laj_nat'])){
                $res[$pmeta['_kw_person_laj_nat'][0]][] = array(
                   'first_name' => !empty($pmeta['_kw_person_laj_first_name']) ? $pmeta['_kw_person_laj_first_name'][0] : '',
                   'last_name' => !empty($pmeta['_kw_person_laj_last_name']) ? $pmeta['_kw_person_laj_last_name'][0] : '',
                   'title' => !empty($pmeta['_kw_person_laj_title']) ? $pmeta['_kw_person_laj_title'][0] : '',
                   'aff' => !empty($pmeta['_kw_person_laj_aff']) ? $pmeta['_kw_person_laj_aff'][0] : '',
                   'image' => $image,
                   'link' => !empty($judge->guid) ? $judge->guid : ''
                ); 
            }
        }
    }else{
        $res = false; 
    }

    return $res;
}

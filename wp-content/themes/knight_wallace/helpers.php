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
            if (isset($c->ID)){
                $pmeta = get_post_meta($c->ID);
                $pimage = get_the_post_thumbnail_url($c->ID);
                if(!empty($pmeta)){
                    $res[$pmeta["_hero_content_which_page"][0]][] = array(
                        'title' => $c->post_title,
                        'image' => !empty($pimage) ? $pimage : false,
                        'content' => $c->post_content,
                        'link' => !empty($pmeta["_hero_content_link"][0]) ? $pmeta["_hero_content_link"][0] : ''
                    );
                }
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
    if (!array_filter(array_map('array_filter', $content)) || empty($page)) {
        return;
    }
    
    $count = count($content[$page]);
    $random_number = ($count > 0) ? rand(0,$count - 1) : 1;
    $res = $content[$page][$random_number];
    
    return $res;
}

//randomize any array and limit an array
function randomize_and_limit($array,$limit){
    $res = array();
    $count = count($array);
    for($i=0;$i<$limit;$i++){
        $random_number = rand(0,$count - 1);
        $res[] = $array[$random_number];
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

// function turn_img_tag_to_url($img){
//     if(empty($img)){
//         $src = '';
//     }else{
//         $doc = new DOMDocument();
//         $doc->loadHTML($img);
//         $xpath = new DOMXPath($doc);
//         $src = $xpath->evaluate("string(//img/@src)");
//     }
//     return $src;
// }

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
            'Audio' => array(),
            'Photojournalism' => array(),
            'Journal' => array(),
            'featured' => array()
        );
        foreach($lib as $li){
            $pmeta = get_post_meta($li->ID);
            $pimage = get_the_post_thumbnail($li->ID, '', array('class' => strtolower($pmeta['_library_item_type'][0])));
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
            $pimage = get_the_post_thumbnail($li->ID, '', array('class' => strtolower($pmeta['_library_item_type'][0])));
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
    $res = array();
    $dig = get_posts(array('post_type'=> 'library','posts_per_page' => -1));
    if(!empty($winners)){
        $cowin = array();//array needed to deal with co-winners
        foreach($winners as $win){
            $pmeta = get_post_meta($win->ID);
            if(!empty($pmeta['_kw_person_liv_win'])
                && !empty($pmeta['_kw_person_liv_year'])
                && is_winner_or_co_winner($pmeta['_kw_person_liv_win'][0])
                && $pmeta['_kw_person_liv_year'][0] == $year
                && !empty($pmeta['_kw_person_liv_type'])
                && $pmeta['_kw_person_liv_type'][0] != 'Richard M. Clurman Award'){
                    //Here we have a winner that we want to display on the winners page
                    $pimage = get_the_post_thumbnail($win->ID);
                    $lib_item_name = !empty($pmeta['_kw_person_liv_lib']) ? $pmeta['_kw_person_liv_lib'][0] : '';
                    if($pmeta['_kw_person_liv_win'][0] == 'Co-Winner'){
                        //we need to do some special stuff for co-winners
                        if(array_key_exists($lib_item_name,$cowin)){
                            //we have already found the co-winners co-winner
                            //now we need to add the co-winner to the co-winner in res array
                            $add_winner = false;//doesn't need it's own slow in res array
                            foreach($res as $r_key => $r_value){
                                //loop through existing res array
                                if($r_value['lib'] == $lib_item_name){
                                    $co_winner_name_line = !empty($pmeta['_kw_person_liv_first_name']) ?
                                        $pmeta['_kw_person_liv_first_name'][0].' ' : '';
                                    $co_winner_name_line .= !empty($pmeta['_kw_person_liv_last_name']) ?
                                        $pmeta['_kw_person_liv_last_name'][0].', ' : '';
                                    $co_winner_name_line .= !empty($pmeta['_kw_person_liv_age']) ? $pmeta['_kw_person_liv_age'][0] : '';
                                    $res[$r_key]['co-winner_name_line'][] = $co_winner_name_line;
                                    $res[$r_key]['co-winner_image'][] = $pimage;
                                }
                            }

                        }else{
                            //we need to add the co-winner to the cowin array
                            $cowin[$lib_item_name] = true;
                            $add_winner = true;//add the winner, it's the first co-winner
                        }
                    }else{
                        $add_winner = true;//add the winner, it's not a co-winner
                    }

                    if($add_winner){
                    //we want to include this winner in the final array
                    $lib_item = get_custom_post_by_title($dig,$lib_item_name);//get the full library object
                    $lib_image = get_the_post_thumbnail($lib_item->ID, 'winners-thumb');
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
                        'lib_item_des' => !empty($lib_item) ? $lib_item->post_content : '',
                        'year' => !empty($pmeta['_kw_person_liv_year']) ? $pmeta['_kw_person_liv_year'][0] : '',
                        'past_aff' => !empty($pmeta['_kw_person_liv_win_aff']) ? $pmeta['_kw_person_liv_win_aff'][0] : '',
                        'past_job' => !empty($pmeta['_kw_person_liv_win_job']) ? $pmeta['_kw_person_liv_win_job'][0] : '',
                    );
                    }//end if add_winner
            }
        }
        usort($res,"compareBy");//sort Alpha order by last name
    }

    return $res;
}

/**
 * Sort winners by award type
 * takes an array of already sorted winners with information already grabbed
 * the area it takes is created by the sort_winners function
 *
 * */
function sort_winners_by_award_type($winners){
    $res = array();
    if(!empty($winners)){
        foreach($winners as $win){
            //There could be multiple winners for each type
            switch($win['type']){
            case 'Excellence in Local Reporting':
                $local[] = $win;
                break;
            case 'Excellence in National Reporting':
                $national[] = $win;
                break;
            case 'Excellence in International Reporting':
                $international[] = $win;
                break;
            }
        }
        $res = array_merge($local, $national, $international);
    }
    return $res;
}

/**
 * Sort Finalists
 * */

function sort_finalists($finalists, $year='2015'){
    $dig = get_posts(array('post_type'=> 'library','posts_per_page' => -1));
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
                    $lib_item = get_custom_post_by_title($dig,$lib_item_name);//get the full library object
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
                        'lib_item_des' => !empty($lib_item) ? $lib_item->post_content : '',
                        'winning_aff' => !empty($pmeta['_kw_person_liv_win_aff']) ? $pmeta['_kw_person_liv_win_aff'][0] : ''
                    );
            }
        }
        //sort 3 arrays alpha by last name
        usort($res['Excellence in Local Reporting'],'compareBy');
        usort($res['Excellence in National Reporting'],'compareBy');
        usort($res['Excellence in International Reporting'],'compareBy');

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

function get_custom_post_by_title($dig, $title){
    $res = '';
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
    $res = array();
    $dig = get_posts(array('post_type'=> 'library','posts_per_page' => -1));
    if(!empty($winners)){
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
                    $lib_item = get_custom_post_by_title($dig, $lib_item_name);//get the full library object
                    $res[] = array(
                        'type' => $award_type,
                        'first_name' => !empty($pmeta['_kw_person_liv_first_name']) ? $pmeta['_kw_person_liv_first_name'][0] : '',
                        'last_name' => !empty($pmeta['_kw_person_liv_last_name']) ? $pmeta['_kw_person_liv_last_name'][0] : '',
                        'age' => !empty($pmeta['_kw_person_liv_age']) ? $pmeta['_kw_person_liv_age'][0] : '',
                        'ass' => !empty($pmeta['_kw_person_liv_ass']) ? $pmeta['_kw_person_liv_ass'][0] : '',
                        'job' => !empty($pmeta['_kw_person_liv_job']) ? $pmeta['_kw_person_liv_job'][0] : '',
                        'aff' => !empty($pmeta['_kw_person_liv_ass']) ? $pmeta['_kw_person_liv_ass'][0] : '',
                        'lib' => $lib_item_name,
                        'id' => $win->ID,
                        'library_link' => !empty($lib_item) ? '?post_type=library&p='.$lib_item->ID : '',
                        'winner' => !empty($pmeta['_kw_person_liv_win']) ? $pmeta['_kw_person_liv_win'][0] : '',
                        'year' => !empty($pmeta['_kw_person_liv_year']) ? $pmeta['_kw_person_liv_year'][0] : '',
                        'past_aff' => !empty($pmeta['_kw_person_liv_win_aff']) ? $pmeta['_kw_person_liv_win_aff'][0] : '',
                        'past_job' => !empty($pmeta['_kw_person_liv_win_job']) ? $pmeta['_kw_person_liv_win_job'][0] : ''
                    );
            }
        }
        usort($res,"compareBy");//sort Alpha order by last name
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
    $res = array();
    if(!empty($fellows)){
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
                    'job'=> !empty($pmeta['_kw_person_kw_current_job_title']) ? $pmeta['_kw_person_kw_current_job_title'][0] : '',
                    'bio_private' => !empty($pmeta['_kw_person_kw_bio_private']) ? $pmeta['_kw_person_kw_bio_private'][0] : '',
                    'pic_private' => !empty($pmeta['_kw_person_kw_photo_add']) ? $pmeta['_kw_person_kw_photo_add'][0] : ''
                );
            }
        }

        usort($res,"compareBy");
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
                   'link' => !empty($judge->guid) ? $judge->guid : '',
                   'bio' => !empty($pmeta['_kw_person_laj_bio']) ? $pmeta['_kw_person_laj_bio'][0] : ''
                );
            }
        }
        //sort results by Alpha Order
        usort($res['National'],"compareBy");
        usort($res['Regional'],"compareBy");
    }else{
        $res = false;
    }

    return $res;
}

/**
 * login user
 *
 * */

function login_fellows_user($username,$password,$form_id){
    if(empty($username) || empty($password) || empty($form_id)){
        $res = false;
    }else{
        $saved_username = get_option('fellows_username');
        $saved_password = get_option('fellows_password');
        $res = $saved_username == $username && $saved_password == $password ? true : false;
    }

    return $res;
}

function is_fellows_user_logged_in($session){
    return !empty($session['logged_in']) && $session['logged_in'] == $session['form_id'] ? true : false;
}


/**
 * Slider Content
 *
 * */

function sort_slider_content($content){
    $res = array(
        'Knight-Wallace Fellowships' => array(),
        'Livingston Awards' => array(),
        'Donate' => array(),
        'None' => array()
    );
    if(!empty($content)){
        foreach($content as $c){
            $pmeta = get_post_meta($c->ID);
            $pimage = get_the_post_thumbnail($c->ID);
            if(!empty($pmeta)){
                $res[$pmeta["_slider_content_page"][0]][] = array(
                    'name' => !empty($pmeta['_slider_content_name_line']) ? $pmeta['_slider_content_name_line'][0] : '',
                    'heading' => !empty($pmeta['_slider_content_heading']) ? $pmeta['_slider_content_heading'][0] : '',
                    'image' => !empty($pimage) ? $pimage : false,
                    'testimonial' => !empty($pmeta['_slider_content_test']) ? $pmeta['_slider_content_test'][0] : '',
                    'details' => !empty($pmeta['_slider_content_details']) ? $pmeta['_slider_content_details'][0] : ''
                );
            }
        }
    }else{
        $res = false;
    }
    return $res;
}

/**
 * Featured News article
 *
 * */

function find_featured_news_article($news){
    $res = array();
    if(!empty($news)){
        foreach($news as $new){
            $pmeta = get_post_meta($new->ID);
            if(!empty($pmeta['featured']) && $pmeta['featured'][0] == 'featured'){
                $res[] = $new;
            }
        }
    }
    return $res;
}

/**
 * Sort by alpha order
 *
 * */

function compareBy($a, $b) {
    $one = special_char_filter($a["last_name"]);
    $two = special_char_filter($b["last_name"]);
    return strcmp($one, $two);
}

//sort by order field
function orderBy($a, $b) {
    return strcmp($a["order"], $b["order"]);
}

function sortByName($a, $b) {
    return strcmp($a["name"], $b["name"]);
}

function special_char_filter($str){
    //takes a string, compares it to a table of foreign
    //characters, and replaces the foreign character
    //with a non-foreign character
    //retrns the string
    $tlit_table = re_trans_lit_table();
    foreach($tlit_table as $k => $v){
        $str = preg_replace('/'.$k.'/',$v,$str);
    }
    return $str;
}

/**
 * Sort board of directors
 *
 * */

function sort_board_of_directors($directors){
    $res = array();
    if(!empty($directors)){
        foreach($directors as $d){
            $image = get_the_post_thumbnail($d->ID);
            $pmeta = get_post_meta($d->ID);
            $res[] = array(
                'image' => $image,
                'link' => $d->guid,
                'first_name' => !empty($pmeta['_person_board_member_first_name']) ? $pmeta['_person_board_member_first_name'][0] : '',
                'last_name' => !empty($pmeta['_person_board_member_last_name']) ? trim($pmeta['_person_board_member_last_name'][0]) : '',
                'title' => !empty($pmeta['_person_board_member_title']) ? $pmeta['_person_board_member_title'][0] : '',
                'ass' => !empty($pmeta['_person_board_member_ass']) ? $pmeta['_person_board_member_ass'][0] : '',
                'bio' => !empty($pmeta['_person_board_member_bio']) ? $pmeta['_person_board_member_bio'][0] : ''
            );
        }
        usort($res,"compareBy");
    }
    return $res;
}

/**
 * Sort staff members
 *
 * */

function sort_staff($staff){
    $res = array();
    if(!empty($staff)){
        foreach($staff as $s){
            $image = get_the_post_thumbnail($s->ID);
            $pmeta = get_post_meta($s->ID);
            $res[] = array(
                'image' => $image,
                'link' => !empty($s->guid) ? $s->guid : '',
                'first_name' => !empty($pmeta['_kw_person_staff_first_name']) ? $pmeta['_kw_person_staff_first_name'][0] : '',
                'last_name' => !empty($pmeta['_kw_person_staff_last_name']) ? $pmeta['_kw_person_staff_last_name'][0] : '',
                'title' => !empty($pmeta['_kw_person_staff_title']) ? $pmeta['_kw_person_staff_title'][0] : '',
                'bio' => !empty($pmeta['_kw_person_staff_bio']) ? $pmeta['_kw_person_staff_bio'][0] : '',
                'order' => !empty($pmeta['_kw_person_staff_order']) ? $pmeta['_kw_person_staff_order'][0] : ''
            );
        }
        usort($res,"orderBy");
    }
    return $res;
}

/**
 * replace spaces with provided character, such as dashes
 *
 *
 * */

function replace_space($string, $replacement){
    return str_replace(" ",$replacement,$string);
}

/**
 * Return an array of years based on year given
 *
 * */

function year_array($year){
    $res = array();
    for($i=$year;$i>1981;$i--){
        $res[] = $i;
    }
    return $res;
}

/**
 * Sort Donors
 *
 * */

function sort_donors($donors,$type){
    $res = array();
    if(!empty($donors)){
        foreach($donors as $donor){
            $image = get_the_post_thumbnail($donor->ID);
            $pmeta = get_post_meta($donor->ID);
            if(!empty($pmeta['_kw_person_donor_type']) && $pmeta['_kw_person_donor_type'][0] == $type){
                $res[] = array(
                    'image' => $image,
                    'name' => !empty($pmeta['_kw_person_donor_name']) ? $pmeta['_kw_person_donor_name'][0] : '',
                    'description' => !empty($pmeta['_kw_person_donor_description']) ? $pmeta['_kw_person_donor_description'][0] : ''
                );
            }
        }
        usort($res,"sortByName");//alpha order
    }
    return $res;
}

/*
 * Sort Events
 *
 * */

function sort_events($events){
    $res = array(
        'past_events' => array(),
        'future_events' => array()
    );
    if(!empty($events)){
        $current_date = time();
        foreach($events as $event){
            if(strtotime($event->post_date) > $current_date){
                $res['future_events'][] = $event;
            }else{
                $res['past_events'][] = $event;
            }
        }
    }
    return $res;
}

/**
 * Utilities
 *
 * */

function re_trans_lit_table(){
    $transliterationTable = array(
        'á' => 'a',
        'Á' => 'A',
        'à' => 'a',
        'À' => 'A',
        'ă' => 'a',
        'Ă' => 'A',
        'â' => 'a',
        'Â' => 'A',
        'å' => 'a',
        'Å' => 'A',
        'ã' => 'a',
        'Ã' => 'A',
        'ą' => 'a',
        'Ą' => 'A',
        'ā' => 'a',
        'Ā' => 'A',
        'ä' => 'ae',
        'Ä' => 'AE',
        'æ' => 'ae',
        'Æ' => 'AE',
        'ḃ' => 'b',
        'Ḃ' => 'B',
        'ć' => 'c',
        'Ć' => 'C',
        'ĉ' => 'c',
        'Ĉ' => 'C',
        'č' => 'c',
        'Č' => 'C',
        'ċ' => 'c',
        'Ċ' => 'C',
        'ç' => 'c',
        'Ç' => 'C',
        'ď' => 'd',
        'Ď' => 'D',
        'ḋ' => 'd',
        'Ḋ' => 'D',
        'đ' => 'd',
        'Đ' => 'D',
        'ð' => 'dh',
        'Ð' => 'Dh',
        'é' => 'e',
        'É' => 'E',
        'è' => 'e',
        'È' => 'E',
        'ĕ' => 'e',
        'Ĕ' => 'E',
        'ê' => 'e',
        'Ê' => 'E',
        'ě' => 'e',
        'Ě' => 'E',
        'ë' => 'e',
        'Ë' => 'E',
        'ė' => 'e',
        'Ė' => 'E',
        'ę' => 'e',
        'Ę' => 'E',
        'ē' => 'e',
        'Ē' => 'E',
        'ḟ' => 'f',
        'Ḟ' => 'F',
        'ƒ' => 'f',
        'Ƒ' => 'F',
        'ğ' => 'g',
        'Ğ' => 'G',
        'ĝ' => 'g',
        'Ĝ' => 'G',
        'ġ' => 'g',
        'Ġ' => 'G',
        'ģ' => 'g',
        'Ģ' => 'G',
        'ĥ' => 'h',
        'Ĥ' => 'H',
        'ħ' => 'h',
        'Ħ' => 'H',
        'í' => 'i',
        'Í' => 'I',
        'ì' => 'i',
        'Ì' => 'I',
        'î' => 'i',
        'Î' => 'I',
        'ï' => 'i',
        'Ï' => 'I',
        'ĩ' => 'i',
        'Ĩ' => 'I',
        'į' => 'i',
        'Į' => 'I',
        'ī' => 'i',
        'Ī' => 'I',
        'ĵ' => 'j',
        'Ĵ' => 'J',
        'ķ' => 'k',
        'Ķ' => 'K',
        'ĺ' => 'l',
        'Ĺ' => 'L',
        'ľ' => 'l',
        'Ľ' => 'L',
        'ļ' => 'l',
        'Ļ' => 'L',
        'ł' => 'l',
        'Ł' => 'L',
        'ṁ' => 'm',
        'Ṁ' => 'M',
        'ń' => 'n',
        'Ń' => 'N',
        'ň' => 'n',
        'Ň' => 'N',
        'ñ' => 'n',
        'Ñ' => 'N',
        'ņ' => 'n',
        'Ņ' => 'N',
        'ó' => 'o',
        'Ó' => 'O',
        'ò' => 'o',
        'Ò' => 'O',
        'ô' => 'o',
        'Ô' => 'O',
        'ő' => 'o',
        'Ő' => 'O',
        'õ' => 'o',
        'Õ' => 'O',
        'ø' => 'oe',
        'Ø' => 'OE',
        'ō' => 'o',
        'Ō' => 'O',
        'ơ' => 'o',
        'Ơ' => 'O',
        'ö' => 'oe',
        'Ö' => 'O',
        'ṗ' => 'p',
        'Ṗ' => 'P',
        'ŕ' => 'r',
        'Ŕ' => 'R',
        'ř' => 'r',
        'Ř' => 'R',
        'ŗ' => 'r',
        'Ŗ' => 'R',
        'ś' => 's',
        'Ś' => 'S',
        'ŝ' => 's',
        'Ŝ' => 'S',
        'š' => 's',
        'Š' => 'S',
        'ṡ' => 's',
        'Ṡ' => 'S',
        'ş' => 's',
        'Ş' => 'S',
        'ș' => 's',
        'Ș' => 'S',
        'ß' => 'SS',
        'ť' => 't',
        'Ť' => 'T',
        'ṫ' => 't',
        'Ṫ' => 'T',
        'ţ' => 't',
        'Ţ' => 'T',
        'ț' => 't',
        'Ț' => 'T',
        'ŧ' => 't',
        'Ŧ' => 'T',
        'ú' => 'u',
        'Ú' => 'U',
        'ù' => 'u',
        'Ù' => 'U',
        'ŭ' => 'u',
        'Ŭ' => 'U',
        'û' => 'u',
        'Û' => 'U',
        'ů' => 'u',
        'Ů' => 'U',
        'ű' => 'u',
        'Ű' => 'U',
        'ũ' => 'u',
        'Ũ' => 'U',
        'ų' => 'u',
        'Ų' => 'U',
        'ū' => 'u',
        'Ū' => 'U',
        'ư' => 'u',
        'Ư' => 'U',
        'ü' => 'ue',
        'Ü' => 'UE',
        'ẃ' => 'w',
        'Ẃ' => 'W',
        'ẁ' => 'w',
        'Ẁ' => 'W',
        'ŵ' => 'w',
        'Ŵ' => 'W',
        'ẅ' => 'w',
        'Ẅ' => 'W',
        'ý' => 'y',
        'Ý' => 'Y',
        'ỳ' => 'y',
        'Ỳ' => 'Y',
        'ŷ' => 'y',
        'Ŷ' => 'Y',
        'ÿ' => 'y',
        'Ÿ' => 'Y',
        'ź' => 'z',
        'Ź' => 'Z',
        'ž' => 'z',
        'Ž' => 'Z',
        'ż' => 'z',
        'Ż' => 'Z',
        'þ' => 'th',
        'Þ' => 'Th',
        'µ' => 'u',
        'б' => 'b',
        'Б' => 'b',
        'г' => 'g',
        'Г' => 'g',
        'д' => 'd',
        'Д' => 'd',
        'ё' => 'e',
        'Ё' => 'E',
        'ж' => 'zh',
        'Ж' => 'zh',
        'з' => 'z',
        'З' => 'z',
        'и' => 'i',
        'И' => 'i',
        'й' => 'j',
        'Й' => 'j',
        'л' => 'l',
        'Л' => 'l',
        'ф' => 'f',
        'Ф' => 'f',
        'ц' => 'c',
        'Ц' => 'c',
        'ч' => 'ch',
        'Ч' => 'ch',
        'ш' => 'sh',
        'Ш' => 'sh',
        'щ' => 'sch',
        'Щ' => 'sch',
        'ы' => 'y',
        'Ы' => 'y',
        'э' => 'e',
        'Э' => 'e',
        'ю' => 'ju',
        'Ю' => 'ju',
        'я' => 'ja',
        'Я' => 'ja'
    );
    return $transliterationTable;
}

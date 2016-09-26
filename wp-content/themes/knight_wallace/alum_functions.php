<?php
/**
 * Functions for alumni locator
 * @rdarling42
 *
 * */

function sort_alum($alum){
    //main sort alumni function
    $res = array();
    if(!empty($alum)){
        $opt_in_alum = remove_opt_outs($alum);
        $sorted_by_location = sort_alum_by("_kw_person_kw_location",$opt_in_alum);
        $sorted_by_speciality = sort_alum_by("_kw_person_kw_special",$opt_in_alum);
        $res = array(
            'location' => $sorted_by_location,
            'special' => $sorted_by_speciality
        );
    }    
    return $res;
}

function remove_opt_outs($alum){
    //this function strips out the alum who have opted out or have never been included
    //assumes will not be given an empty array
    $res = array();
    foreach($alum as $a){
        $pmeta = get_post_meta($a->ID);
        if(!empty($pmeta["_kw_person_kw_prv"][0]) && $pmeta["_kw_person_kw_prv"][0] != '0'){
            $res[] = $a;
        } 
    }
    return $res;
}

function sort_alum_by($field,$alum){
    $res = array();
    foreach($alum as $a){
        $pmeta = get_post_meta($a->ID);
        $a = add_in_special_field_data($pmeta,$a);
        if(array_key_exists($pmeta[$field][0],$res)){
            $res[$pmeta[$field][0]][] = $a;
        }else{
            $res[$pmeta[$field][0]] = array();
            $res[$pmeta[$field][0]][] = $a;
        } 
    }
    return $res;
}

function add_in_special_field_data($pmeta,$fellow){
    $fellow->extra_data = array(
        'location' => $pmeta["_kw_person_kw_location"][0],
        'special' => $pmeta["_kw_person_kw_special"][0],
        'phone' => $pmeta["_kw_person_kw_personal_phone"][0],
        'email' => $pmeta["_kw_person_kw_personal_email"][0],
        'permission' => $pmeta["_kw_person_kw_prv"][0],
    );
    return $fellow;
}

function use_alum($alum,$fellows){
    //alum is username of alum
    //fellows is array of fellows
    $res = array();
    if(!empty($fellows)){
        foreach($fellows as $fellow){
            $pmeta = get_post_meta($fellow->ID);
            if(!empty($pmeta["_kw_person_kw_username"][0]) && $pmeta["_kw_person_kw_username"][0] == $alum){
                $fellow = add_in_special_field_data($pmeta,$fellow);
                $res[] = $fellow;
                break;
            } 
        }
    }
    return $res;
}

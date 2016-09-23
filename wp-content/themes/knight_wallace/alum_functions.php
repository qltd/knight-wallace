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
        $res = array($sorted_by_location,$sorted_by_speciality);
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
        if(array_key_exists($pmeta[$field][0],$res)){
            $res[$pmeta[$field][0]][] = $a;
        }else{
            $res[$pmeta[$field][0]] = array();
            $res[$pmeta[$field][0]][] = $a;
        } 
    }
    return $res;
}

<?php
/**
 * Functions for alumni locator
 * @rdarling42
 *
 * */

function sort_alum($sort_by, $alum){
    // $sort_by should tell us which metafield we want to sort by ( field for usa, worldwide, subject )
    // sort by USA by default
    if(!$sort_by) { $sort_by = 'usa'; } 
    if(!$alum){ return false; }

    $alum_sorted_by_metafield = null;

    if($sort_by === 'usa'){ 
        $alum_sorted_by_metafield = sort_alum_by("_kw_person_kw_state",$alum);
    }
    if($sort_by === 'worldwide'){ 
        $alum_sorted_by_metafield = sort_alum_by("_kw_person_kw_country",$alum);
    }
    if($sort_by === 'subject'){ 
        $alum_sorted_by_metafield = sort_alum_by("_kw_person_kw_special",$alum);
        // move these around so that the order goes: Local, National, International, then the rest alphabetically...
        $alum_sorted_by_metafield = array('International Reporting' => $alum_sorted_by_metafield['International Reporting']) + $alum_sorted_by_metafield;
        $alum_sorted_by_metafield = array('National Reporting' => $alum_sorted_by_metafield['National Reporting']) + $alum_sorted_by_metafield;
        $alum_sorted_by_metafield = array('Local and State Reporting' => $alum_sorted_by_metafield['Local and State Reporting']) + $alum_sorted_by_metafield;
    }
    
    return $alum_sorted_by_metafield;
}


// $field = meta key
// creates an associative array of meta values and adds each fellow post object to the appropriate array
function sort_alum_by($field,$alum){
    $res = array();
    foreach($alum as $a){

        $pmeta = get_post_meta($a->ID);
        $a = add_in_special_field_data($pmeta,$a); // why is this done here? can we just do this once instead?

        // some meta values may contain comma separated lists of items
        // so let's loop through each of those items
        $pmeta_values = $pmeta[$field][0];
        $pmeta_values = explode(', ',$pmeta_values);
        foreach ($pmeta_values as $value){
            if($value == ''){ continue; } // skip fellows who don't have this data yet
            if(array_key_exists($value, $res)){
                $res[$value][] = $a;
            }
            else {
                $res[$value] = array();
                $res[$value][] = $a;
            }
        }
    }
    // alphabetize the array by key
    ksort($res);
    return $res;
}

function add_in_special_field_data($pmeta,$fellow){
    $fellow->extra_data = array(
        'class_year' => $pmeta["_kw_person_kw_class_year"][0],
        'current_job_title' => $pmeta["_kw_person_kw_locator_current_job_title"][0],
        'current_affiliation' => $pmeta["_kw_person_kw_current_aff"][0],
        'country' => $pmeta["_kw_person_kw_country"][0],
        'state' => $pmeta["_kw_person_kw_state"][0],
        'city' => $pmeta["_kw_person_kw_city"][0],
        'special' => $pmeta["_kw_person_kw_special"][0],
        'available_for' => $pmeta["_kw_person_kw_available_for"][0],
        'additional_info' => $pmeta["_kw_person_kw_additional_info"][0],
        'phone' => $pmeta["_kw_person_kw_personal_phone"][0],
        'email' => $pmeta["_kw_person_kw_personal_email"][0],
        'twitter' => $pmeta["_kw_person_kw_personal_twitter"][0]
    );
    return $fellow;
}


<?php 
//"serviceName" Repeater Field Name slug
//"POSTID" Current Post ID
function getrepeat($serviceName, $POSTID)
{
    $child_columns = toolset_get_related_posts(
        $POSTID, // the parent post
        $serviceName, // the RFG slug
        'parent', // the RFG role in this relationship is 'child'
        100, // the maximum number of results
        0, // the offset
        array(), // additional query arguments
        'post_object', // return format
        'child', // role to return
        '',
        'ASC'
    );
    $data = array();
    $i = 0;
    foreach ($child_columns as $v) {
        $d = (get_post_meta($v->ID));
        foreach ($d as $k => $v1) {

            $data[$i][$k] = get_post_meta($v->ID, $k, true);
        }
        $i++;
    }
    $newarr = array();
    foreach ($data as $k => $v) {
        $newarr[$v['toolset-post-sortorder']] = $v;
        unset($newarr[$v['toolset-post-sortorder']]['toolset-post-sortorder']);
    }

    ksort($newarr);

    return $newarr;
}

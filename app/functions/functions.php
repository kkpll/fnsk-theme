<?php

namespace App\Functions;


function get_the_post_data( $post_id=null ){

    $return = array();

    global $post;

    $return['id'] = $post_id ? $post_id : $post->ID;
    $return['post_type'] = $post->post_type;;
    $post_type_obj = get_post_type_object($return['post_type']);
    $return['post_type_name'] = $post_type_obj->labels->singular_name;
    $return['permalink'] = get_the_permalink(); //パーマリンク
    $return['title'] = $post->post_title; //タイトル
    $return['content'] = $post->post_content; //本文
    $return['thumbnail'] = has_post_thumbnail() ? get_the_post_thumbnail_url($return['id'],'my-thumbnails') : NULL; //サムネイルURL
    $return['date'] = get_the_date(); //日付
    $return['excerpt'] = $post->post_excerpt; //抜粋

    $return['category'] = array();
    $return['tag'] = array();

    //記事が持つタクソノミーをすべて取得
    if($taxs = get_post_taxonomies($return['id'])){
        foreach((array)$taxs as $tax){
            if($tax !== "post_format"){ //post_formatだけ取り除く
                $taxonomy = get_taxonomy($tax);
                $taxonomy_type = $taxonomy->hierarchical ? 'category' : 'tag';
                $return[$taxonomy_type][$tax] = array();
                $terms = get_the_terms($return['id'], $tax);
                if($terms){//この記事に使われていたら
                    foreach ((array)$terms as $term){
                        array_push($return[$taxonomy_type][$tax], array('name' => $term->name, 'slug'=> $term->slug,'link' => get_term_link($term->term_id)));
                    }
                }
            }
        }
    }

    return $return;

}





 ?>

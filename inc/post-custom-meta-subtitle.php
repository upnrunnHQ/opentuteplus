<?php

/**
 * Action
 */
add_action( 'add_meta_boxes', 'opentute_add_metaboxes' );
function opentute_add_metaboxes() 
{    
    add_meta_box( 
        'opentute_post_meta_box',
        'Post Subtitle',
        'opentute_post_meta_callback',
        array('post', 'page'),
        'normal',
        "high"
    );
}

/** 
 * Prints the box content 
 */
function opentute_post_meta_callback( $post ) 
{
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'opentute_meta_noncename' );
    $post_subtitle = get_post_meta($post->ID, 'post_subtitle',true);
    ?>

    <style type="text/css">
        .opentute-metabox textarea {
            height: 4em;
            width: 100%;
            margin-top: 8px;
        }

        .opentute-metabox label {
            font-size: 13px;
            line-height: 1.5;
            margin: 10px 0 0;
            display: inline-block;
        }
    </style>

    <div class="opentute-metabox">
        <textarea name="post_subtitle"><?php echo $post_subtitle ?></textarea>
        <label>Optional subtitle that appears in single post or page under the title.</label>
    </div>
<?php 
}

/**
 * Save
 */
add_action( 'save_post', 'opentute_save_postdata' );
function opentute_save_postdata($post_id) 
{   
    // verify if this is an auto save routine
    // If it is our form has not been submitted, so we dont want to do anything
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // verify this came from the our screen and with proper authorization
    // because save_post can be triggered at other times
    $_POST['opentute_meta_noncename'] = isset($_POST['opentute_meta_noncename']) ? $_POST['opentute_meta_noncename'] : '';
    if(!wp_verify_nonce( $_POST['opentute_meta_noncename'], plugin_basename( __FILE__ ))) return;
    // Check permissions
    if(isset($_POST['post_type']))
    {
        if('page' == $_POST['post_type']) 
        {
            if(! current_user_can('edit_page', $post_id)) return;
        }
        else
        {
            if(! current_user_can('edit_post', $post_id)) return;
        }   
    }
    
    update_post_meta($post_id,'post_subtitle',$_POST['post_subtitle']);
}
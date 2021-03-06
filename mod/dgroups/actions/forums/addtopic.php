<?php

    /**
	 * Elgg dgroups plugin add topic action.
	 * 
	 * @package ElggGroups
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	// Make sure we're logged in; forward to the front page if not
		if (!isloggedin()) forward();
		
	// Check the user is a dgroup member
	    $dgroup_entity =  get_entity(get_input('dgroup_guid'));
	    if (!$dgroup_entity->isMember($vars['user'])) forward();
	    
	// Get input data
	    $title = get_input('topictitle');
		$message = get_input('topicmessage');
		$tags = get_input('topictags');
		$access = get_input('access_id');
		$dgroup_guid = (int) get_input('dgroup_guid');
		$user = $_SESSION['user']->getGUID(); // you need to be logged in to comment on a dgroup forum
		$status = get_input('status'); // sticky, resolved, closed
		
	// Convert string of tags into a preformatted array
		 $tagarray = string_to_tag_array($tags);
		
	// Make sure the title / message aren't blank
		if (empty($title) || empty($message)) {
			register_error(elgg_echo("dgrouptopic:blank"));
			forward("pg/dgroups/forum/{$dgroup_guid}/");
			
	// Otherwise, save the topic
		} else {
			
	// Initialise a new ElggObject
			$dgrouptopic = new ElggObject();
	// Tell the system it's a dgroup forum topic
			$dgrouptopic->subtype = "dgroupforumtopic";
	// Set its owner to the current user
			$dgrouptopic->owner_guid = $user;
	// Set the dgroup it belongs to
			$dgrouptopic->container_guid = $dgroup_guid;
	// For now, set its access to public (we'll add an access dropdown shortly)
			$dgrouptopic->access_id = $access;
	// Set its title and description appropriately
			$dgrouptopic->title = $title;
	// Before we can set metadata, we need to save the topic
			if (!$dgrouptopic->save()) {
				register_error(elgg_echo("dgrouptopic:error"));
				forward("pg/dgroups/forum/{$dgroup_guid}/");
			}
	// Now let's add tags. We can pass an array directly to the object property! Easy.
			if (is_array($tagarray)) {
				$dgrouptopic->tags = $tagarray;
			}
	// add metadata
	        $dgrouptopic->status = $status; // the current status i.e sticky, closed, resolved, open
	           
    // now add the topic message as an annotation
        	$dgrouptopic->annotate('dgroup_topic_post',$message,$access, $user);   
        	
    // add to river
	        add_to_river('river/forum/topic/create','create',$_SESSION['user']->guid,$dgrouptopic->guid);
	        
	// Success message
			system_message(elgg_echo("dgrouptopic:created"));
			
	// Forward to the dgroup forum page
	        global $CONFIG;
	        $url = $CONFIG->wwwroot . "pg/dgroups/forum/{$dgroup_guid}/";
			forward($url);
				
		}
		
?>


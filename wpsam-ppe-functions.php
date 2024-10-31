<?php

/**
 * Return array with all roles
 * 
 * @return multitype:
 */
function wpsam_get_role_names() {

	global $wp_roles;

	if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();

	return $wp_roles->get_names();

}

/**
 * 
 * Check if user has assigned any of $roles
 * 
 * @param array|string $roles
 * @param string $user_id
 * @return boolean
 */
function wpsam_check_user_role( $roles, $user_id = null ) {

	if (!is_array( $roles )){
		$roles = array( $roles );
	}


	if ( is_numeric( $user_id ) ){
		$user = get_userdata( $user_id );
	}
	else{
		$user = wp_get_current_user();
	}

	if ( empty( $user ) ){
		return false;
	}


	$intersect = array_intersect( $roles, (array) $user->roles );

	return !empty( $intersect );
}
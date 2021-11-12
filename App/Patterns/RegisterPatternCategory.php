<?php
/**
 * @package ruijinen-r002-lp
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\R002LP\App\Patterns;

class RegisterCategory {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action(
			'init',
			function() {
				register_block_pattern_category( RJE_R002LP_KEY, array( 'label' => '[類人猿] LPサイト' ) );
			}
		);
	}
}
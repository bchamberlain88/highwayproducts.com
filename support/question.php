<?php

/**
 *
 * This file loads answers based on the question
 * clicked on by the visitor on the support page
 *
 * @author    Sebastian Inman @sebastian_inman, inherited by Barrett Chamberlain
 * @link      http://www.highwayproducts.com
 * @license   http://www.highwayproducts.com/docs/license.txt
 * @copyright Highway Products Inc. 2015
 *
 */

require_once('../_includes/globals.inc.php'); 
$get_question = mysql_query( "SELECT * FROM product_support WHERE selector = '" . $_GET['q'] . "'" );
$question = mysql_fetch_assoc( $get_question );
echo $question['answer'];
// show comments if allowed
if( SET_SUPPORT_COMMENTS == 'true' ) { ?>
	<div class='comments' id='disqus_thread'></div>
	<script type="text/javascript">
	var disqus_shortname = 'highwayproducts';
	(function() {
	var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); })();
	</script>
<?php } ?>
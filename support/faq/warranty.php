<?php // require site globals
require_once('../../_includes/globals.inc.php'); ?>

<h1>Highway Products Warranty Information</h1>
<div class='side-sep smaller'></div>
<h2>Step 1: Contact Us</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mauris velit, auctor at justo at, bibendum cursus augue. 
Duis in consectetur sem, at rhoncus ex. Vivamus sed pretium odio, sit amet sodales ex. In sit amet lacinia metus, et vehicula diam. 
Proin rhoncus eros nulla, eget consequat tortor aliquam vel. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur 
ridiculus mus. Aliquam ullamcorper nisl ac imperdiet convallis. Donec lorem turpis, luctus tincidunt neque vel, feugiat gravida diam.</p>
<div class='side-sep'></div>
<h2>Step 2: Tell Us Your Needs</h2>
<p>Aliquam commodo consequat odio a congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
Cras iaculis urna a massa varius, iaculis ultricies ex mollis. Pellentesque imperdiet volutpat eros, molestie vulputate arcu viverra eleifend. 
Praesent ultricies pulvinar sapien, in congue ex faucibus a. Morbi nec ex id ex tristique sodales. Fusce iaculis odio eget odio condimentum 
pretium sit amet sit amet lacus. Suspendisse tristique mollis rutrum. Curabitur ornare nisi vitae leo euismod, eu porta lorem commodo. 
Praesent eget enim porta, vulputate augue in, vehicula nibh. Nullam mollis, diam non dictum commodo, magna quam porta risus, ut hendrerit 
mauris nibh non lectus. Morbi pharetra laoreet ipsum, eu aliquam neque. Mauris sit amet interdum tellus.</p>
<div class='side-sep'></div>
<h2>Step 3: Detailed Quote</h2>
<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam vel condimentum erat. Etiam pretium felis mauris, nec maximus 
purus varius luctus. Proin ac ornare mi. Nunc quis quam finibus, lacinia orci non, cursus ligula. In non vulputate sapien, quis dictum tellus. 
Praesent maximus orci at velit finibus facilisis. Phasellus magna nulla, tempor in auctor et, rutrum a eros. Mauris dui justo, malesuada 
ut sem vitae, sagittis fringilla sem. Phasellus ullamcorper erat at est posuere, et molestie tortor auctor. Phasellus maximus orci quis 
lacus ullamcorper, et porttitor velit tincidunt. Sed molestie arcu non sem molestie vehicula suscipit at nulla. Nullam accumsan diam id 
augue placerat placerat. Aenean fringilla lacus a hendrerit ultricies. Ut turpis nisi, placerat in rhoncus et, varius non sem.</p>

<?php // show comments if allowed
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
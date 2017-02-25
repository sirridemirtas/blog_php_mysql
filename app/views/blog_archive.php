<script src="<?=ACTUAL_LINK?>js/jquery.1.11.1.js"></script>
<!-- <time datetime="2011-04-01"></time> -->
<?php 

$years = array();
$months = array();
foreach ($data as $key => $value)
	$months[$value['YEAR']][$value['MONTH']] = $value['TOTAL'];
foreach ($months as $year => $value) {
	echo '<a href="javascript:void(0)">'.$year.'</a>
		<ul>';
	ksort($value);
	foreach ($value as $month => $val)
		echo'<li class="t">
				<a href="'.ACTUAL_LINK.'blog/archive/'.$year.'-'.str_pad($month,2,'0',STR_PAD_LEFT).'">'.
					functions::n2M($month).' <small>('.$val.')</small>
				</a> 
				<a href="javascript:void(0)" class="arrow" data="'.$year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'">►</a>
				<ul class="posts"></ul>
			</li>';
	echo '</ul>';
}

?>
<style>
ul{
	list-style: disc outside none;
	margin-left:1em;
}
ul a{border: none;}
ul a:after{color: #444;_content: ' ▾'}
ul li{color:goldenrod;list-style-type: none;}
ul li a.arrow{font-size:80%;color:goldenrod;}
</style>
<script type="text/javascript">

function get_posts(div, date) {
	var url = "<?=ACTUAL_LINK?>blog/archive/"+date+".json";

	$.getJSON(url, function(data) {
		$(div).html('');
		$.each(data, function(x, data) {
			$(div).append('<li><a href="'+data.url+'">'+data.title+'</a></li>');
		});
	});
}

$('ul li.t a.arrow').click(function () {
	var div = $(this).parent().children('ul.posts');

	if(!$(this).attr('v')) $(this).attr('v','0');
	$(this).attr('v', parseInt($(this).attr('v'))+1);
	if($(this).attr('v')%2==1){$(this).html('▼');div.show();}
	else {$(this).html('►');div.hide();}	

	if ($(this).attr("data")) {
		$(div).html('Loading...');
		var date = $(this).attr("data");
		get_posts(div, date);
		$(this).removeAttr("data");
	}
	else{}
});
</script>
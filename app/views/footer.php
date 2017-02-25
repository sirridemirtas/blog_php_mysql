<div class="clear"></div>
</div>
<!-- Wrapper End -->


<footer id="footer" contenteditable="false">
Copyleft ~ John Doe ~ 2016 <?php //echo microtime(); ?>
</footer>

<span id="em" style="position:absolute;top:-99999em">m</span>
<script type="text/javascript">

function footer() {
	var page = window.innerHeight;
	var wrapper = document.getElementsByClassName('wrapper')[0].offsetHeight;
	var header = document.getElementsByTagName('header')[0].offsetHeight;
	var nav = document.getElementsByTagName('nav')[0].offsetHeight;
	var footer = document.getElementsByTagName('footer')[0].offsetHeight;

	var em = document.getElementById('em').offsetWidth;
	var t = wrapper+header+nav+3*em;
	var x = page-t-footer;

	var body = document.getElementsByTagName('body')[0].offsetHeight;
	var y = body-footer;
	//alert(y);

	if (page>t+5*em)
	document.getElementsByTagName('footer')[0].style.marginTop = x-3+"px";
}
footer();

/*function footer() {
	var a = window.innerHeight;
	var b = document.getElementsByTagName('footer')[0].offsetHeight;
	var c = document.getElementsByTagName('footer')[0].offsetTop;
	var d = a-c-b+b*0.25;
	if (a>b+c)
	document.getElementsByTagName('footer')[0].style.marginTop = d+"px";
}*/
footer();
window.onresize = function(event) {
	footer();
};
</script>
<style>html{_background-color: lightblue;}</style>
</body>
</html>
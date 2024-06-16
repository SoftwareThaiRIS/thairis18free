<form action=dictate-report.php>
<div id="reportspace">
<script src="http://localhost/thairis/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	//new nicEditor().panelInstance('area1');
	new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({iconsPath : 'nicEditorIcons.gif'}).panelInstance('area3');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	//new nicEditor({maxHeight : 100}).panelInstance('area5');
});
</script>
<textarea cols="105" rows="20" id="area2">Some Initial Content was in this textarea</textarea>
</div>
<input type=submit value=OK>
</form>

<input type="radio" name="whatever" id="theid" value="your value, url etc." onclick="dosomething()">Red<br>
<html>
<body>
	<p id='demo'></p>
<script>
function dosomething()
{
document.getElementById('demo').innerHTML = document.getElementById("theid").value;
}
</script>

</body>
</html>

<!-- <input type="radio" name="LanguageSelect"  id="LanguageSelect" value="English" onclick="alertValue()" >English &nbsp;&nbsp;

<input type="radio" name="LanguageSelect"  id="LanguageSelect" value="Tamil" onclick="alertValue()">Tamil &nbsp;&nbsp;
<input type="radio" name="LanguageSelect"  id="LanguageSelect" value="Hindi" onclick="alertValue()">Hindi</div><br>

<script>
alertValue = function(){
    var language1 = document.getElementById('LanguageSelect');

    if(language1.checked)
        alert(language1.value);
}
</script> -->

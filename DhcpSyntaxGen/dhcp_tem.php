<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style type="text/css">
.form-style-3{
	max-width: 450px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 label{
	display:block;
	margin-bottom: 10px;
}
.form-style-3 label > span{
	float: left;
	width: 100px;
	color: #F072A9;
	font-weight: bold;
	font-size: 13px;
	text-shadow: 1px 1px 1px #fff;
}
.form-style-3 fieldset{
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	margin: 0px 0px 10px 0px;
	border: 1px solid #FFD2D2;
	padding: 20px;
	background: #FFF4F4;
	box-shadow: inset 0px 0px 15px #FFE5E5;
	-moz-box-shadow: inset 0px 0px 15px #FFE5E5;
	-webkit-box-shadow: inset 0px 0px 15px #FFE5E5;
}
.form-style-3 fieldset legend{
	color: #FFA0C9;
	border-top: 1px solid #FFD2D2;
	border-left: 1px solid #FFD2D2;
	border-right: 1px solid #FFD2D2;
	border-radius: 5px 5px 0px 0px;
	-webkit-border-radius: 5px 5px 0px 0px;
	-moz-border-radius: 5px 5px 0px 0px;
	background: #FFF4F4;
	padding: 0px 8px 3px 8px;
	box-shadow: -0px -1px 2px #F1F1F1;
	-moz-box-shadow:-0px -1px 2px #F1F1F1;
	-webkit-box-shadow:-0px -1px 2px #F1F1F1;
	font-weight: normal;
	font-size: 12px;
}
.form-style-3 textarea{
	width:450px;
	height:100px;
}
.form-style-3 input[type=text],
.form-style-3 input[type=date],
.form-style-3 input[type=datetime],
.form-style-3 input[type=number],
.form-style-3 input[type=search],
.form-style-3 input[type=time],
.form-style-3 input[type=url],
.form-style-3 input[type=email],
.form-style-3 select, 
.form-style-3 textarea{
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border: 1px solid #FFC2DC;
	outline: none;
	color: #F072A9;
	padding: 5px 8px 5px 8px;
	box-shadow: inset 1px 1px 4px #FFD5E7;
	-moz-box-shadow: inset 1px 1px 4px #FFD5E7;
	-webkit-box-shadow: inset 1px 1px 4px #FFD5E7;
	background: #FFEFF6;
	width:95%;
}
.form-style-3  input[type=submit],.buttonr,
.form-style-3  input[type=button]{
	background: #EB3B88;
	border: 1px solid #C94A81;
	padding: 5px 15px 5px 15px;
	color: #FFCBE2;
	box-shadow: inset -1px -1px 3px #FF62A7;
	-moz-box-shadow: inset -1px -1px 3px #FF62A7;
	-webkit-box-shadow: inset -1px -1px 3px #FF62A7;
	border-radius: 3px;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;	
	font-weight: bold;
}
.required{
	color:red;
	font-weight:normal;
}
</style>
</head>
<body>
	<div class="form-style-3">

<fieldset><legend>Input</legend>
<label for="field1"><span>User Name <span class="required">*</span></span><input type="text" class="input-field" name="field1" id="name" value="" required /></label>
<label for="field2"><span>IP address<span class="required">*</span></span><input type="text" class="input-field" name="field2" id="ip" value="" pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" required /></label>
<label for="field3"><span>MAC address<span class="required">*</span></span><input type="text" class="input-field" name="field3" id="mac" value="" required /></label>
<label><span> </span><button onclick="submite()" class="buttonr">Submit</button></label>

</fieldset>
<fieldset><legend>Output</legend>
<label for="field6"><textarea name="field6" id="out" class="textarea-field" readonly=""></textarea></label>

</fieldset>

</div>
	
<script type="text/javascript">
	
function submite() {
	var name=document.getElementById('name').value;
	var ip=document.getElementById('ip').value;
	var mac=document.getElementById('mac').value;

	var name1 = name.trim();
	var name2 = name1.replace(" ", "_");

	out="#"+name2+"\nhost "+name2+" {\n\thardware ethernet "+mac+";\n\tfixed-address "+ip+";\n\t}"
	document.getElementById("out").value=out;
	alert("waite");

	//#geetha_udaykumar
	//host geetha_udaykumar {
    //	  hardware ethernet 14:85:7f:04:33:14;
    //	  fixed-address 10.32.130.89;
    //  }

}


</script>
</body>
</html>
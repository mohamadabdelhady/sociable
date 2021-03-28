function displaysignup(num)
{
	if (num==1)
	{

	document.getElementById('loginform').style.display='none';
	document.getElementById('signupform').style.display='flex';
	document.getElementById('siguparea').style.display='none';
	document.getElementById('loginbtn').style.display='block';
}
else{
	document.getElementById('loginform').style.display='flex';
	document.getElementById('signupform').style.display='none';
	document.getElementById('siguparea').style.display='block';
	document.getElementById('loginbtn').style.display='none';
}
}
var t1 = document.getElementById("t1");
var t2 = document.getElementById("t2");
t2.style.borderBottomColor="black";
var signup = document.getElementById("signup");
var signin = document.getElementById("signin");
signin.style.display="block";
signup.style.display="none";

var messages = document.getElementsByClassName("message");
messages[0].style.display="block";
console.log("!!!");
t2.onclick=function(){ 
	/*window.location.href="StudentSignin.html" ;  */    
	signup.style.display="none";
	signin.style.display="block";
	t2.style.borderBottomColor="black";
	t1.style.borderBottomColor="white";
	messages[0].style.display="block";
}
t1.onclick=function(){ 
		/*window.location.href="StudentSignin.html" ;  */    
	var signup = document.getElementById("signup");
	signup.style.display="block";
	signin.style.display="none";
	t1.style.borderBottomColor="black";
	t2.style.borderBottomColor="white";
	messages[0].style.display="none";
}
var ret = document.getElementById("return");
ret.onclick=function(){
	window.location.href = "Homepage.html";
}
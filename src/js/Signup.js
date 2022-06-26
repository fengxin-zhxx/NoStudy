function SignupChecker(){
	var RegisterMethod = document.getElementById("RegisterMethod");
	if(RegisterMethod == null) {
		//console.log("null");
		return false;
	}
	RegisterMethod = RegisterMethod.selectedIndex;
	if(RegisterMethod == 0){
		alert("请选择注册方式!!")
		return false;
	}
	var RegisterSchool = document.getElementById("RegisterSchool").selectedIndex;
	if(RegisterSchool == 0){
		alert("请选择学校!!")
		return false;
	}
	var StudentID = document.getElementById("StudentID").value;
	let flag=false;
	if(StudentID.length != 8)flag=true;
	if(flag==false)
	for(const ch of StudentID){
		//console.log(ch);
		let tmp = ch.charCodeAt();
		if(tmp < '0'.charCodeAt() || tmp > '9'.charCodeAt()){
			flag=1;
			break;
		}
	}
	if(flag == 1) {
		alert("学号必须是八位数字!!");
		return false;
	}
	
	var StudentName = document.getElementById("StudentName").value;
	if(StudentName.length == 0){
		alert("请输入姓名!!");
		return false;
	}

	var Contact = document.getElementById("RegisterContact").value;
	//console.log(Contact);
	if(Contact.length == 0){
		//alert("!!!");
		alert("请输入手机/邮箱!!");
		return false;
	}	

	var Password = document.getElementById("RegisterPassword").value;
	if(Password == ""){
		alert("请输入密码!!");
		return false;
	}
	return true;
}
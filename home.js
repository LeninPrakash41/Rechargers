	function getCookie(c_name)
	{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	  {
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
		{
		return unescape(y);
		}
	  }
	}
	
	function setCookie(c_name,value,exdays)
	{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
	}
	
	function checkUser()
	{
	var username=getCookie("username");
	if (username!=null && username!="")
	  {
			$("#username").html("< "+username);
	  }
	 else{
		 $("#username").html("My Account");
	  } 
	}
	function checkBalance()
	{
		var username=getCookie("username");
		$.ajax({
			type: "POST",
			url: "balanceCheck.php",
			data: "username="+username,
			success: function(result){
					$("#cashBal").html("You have "+result+" RC Cash<br/><br/>");
					$("#cashBal").show("fast");
					if(result=="0")
					{	
						$('#rcCash').attr('disabled', 'true');
					}
				},
				error: function(xhr){
					alert("An error occured: " + xhr.status + " " + xhr.statusText);
				}
		});
	}
	
	function numeric_val(evt) {
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]/;
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}


	function mobOpsuggest(mobno) {	//For suggesting the mobile operator and clearing out error when mobile no is valid.
		if(mobno.length==10){
			var regexm =/^[789][0-9]{9}$/gi ;
			if(regexm.test(mobno)){
				document.getElementById("errMob").style.display="none";
				document.getElementById("mobNoin").style.border="#c0c0c0 solid 1px";
			}
		}
	}
	
	function OpRcsuggest(op){		//for suggesting popular recharges and offers and clearing out error when valid.
		if(op.value!="Select operator"){
			document.getElementById("errOp").style.display="none";
			document.getElementById("selOp").style.border="#c0c0c0 solid 1px";
		}	
	}


	function validateFormA(){		//validating form before submit.
		var regexm =/^[789][0-9]{9}$/gi ;
		if(!regexm.test(document.getElementById("mobNoin").value)){
			document.getElementById("errMob").style.display="inline";
			document.getElementById("mobNoin").style.border="#FF3300 solid 1px";
			return false;
		}	
		if(document.getElementById("selOp").value=="Select operator"){
			document.getElementById("errOp").style.display="inline";
			document.getElementById("selOp").style.border="#FF3300 solid 1px";
			return false;
		}	
		var regexamt =/[0-9]{1,4}$/gi ;
		if(!regexamt.test(document.getElementById("amt").value)){
			document.getElementById("errAmt").style.display="inline";
			document.getElementById("amt").style.border="#FF3300 solid 1px";
			return false;
		}
		return true;
	}
	
var rcInfo="";
	function rcBoxA(){	
			if(!validateFormA())
			{return false;} //else{setcookie("username",$username,$expire);}
			$(".rcBox").hide("fast");
			//$("#rcBoxB").addClass("rcBox");
				rcInfo='<label for="Mobile Number" style="color:#000">' + $("#mobNoin").val()+' ('+$("#selOp").val()+')  for   <span class="WebRupee">Rs.</span> '+$("#amt").val()+'</label>';
			$("#rcInfo").html(rcInfo);
			var username=getCookie("username");
			if (username!=null && username!="")
			  {
			  	$(".unsigned").hide("fast");
				$(".signed").show("fast");
					checkBalance();
			  }
			$(".rcBoxB").show("fast");//css("display","inline");
	}

var signUrl="loginPost.php";

$(document).ready(function(){
	$("#signIn").click(function(){

		// add email and password checek filters.
		
		var username=$("#emailIn").val();
		var password=$("#passIn").val();
	//	var flag=signUrl.localeCompare("loginPost.php");
		
	 alert(username);
		$.ajax({
			type: "POST",
			url: signUrl,
			data: "username="+username+"&password="+password,
			success: function(result){
							if(result=="login"){
								
								if(rcInfo==""){
									$(".rcBoxB").hide("fast"); 
									$(".rcBox").show("fast"); 
									$("#rcBoxHeader").show("fast");
				
								}else{
									$(".unsigned").hide("fast");
									$(".signed").show("fast");
									}
								var username=getCookie("username");
								if (username!=null && username!="")
								  {
										$("#username").html("< "+username);
								  }
								  checkBalance();
								  
							}
							else if(result=="password incorrect")
									 {
									  $("#test").html(result);
									  $("#errPass").html("Incorrect Password. Please try again.");
								      $("#errPass").addClass("error");
									  $("#passIn").css("border","#FF3300 solid 1px");
									  $("#errPass").show("fast");
								     }
					
						else
						 {
						   $("#test").html(result);
						 }
						},
			error: function(xhr){
      					alert("An error occured: " + xhr.status + " " + xhr.statusText);
					}
		});
		
	}); //signIn click function ends.
});	
$(document).ready(function() {
    $("#username").click(function() {
		var username=getCookie("username");
		if (username!=null && username!="")
		  {
				$(".navOpt").toggle("fast");
		  }
		  else{
			  	
				$("#rcBoxHeader").hide("fast");   // hide rcBoxHeader
				
				$(".rcBox").hide("fast"); // hide rcBoxA
				
				$(".rcBoxB").show("fast"); //show unsigned  - rcBoxB
				
				//if(!validateFormA())   //after login/signup if rcInfo variable not set then go to rcBoxA
					
			}
		  
    });
	$("#logout").click(function() {
        $.removeCookie("username");  $(".navOpt").hide("fast"); $("#username").html("My Account");
		$("#cashBal").html("<br/>"); 
    });
});

$(document).ready(function(){
  $("#emailIn").change(function(){
	  
		email = $("#emailIn").val();
		
		//alert("invalid email"+email);
		filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (filter.test( email )) {
		  // Yay! valid
		  $("#emailIn").css("border","#c0c0c0 solid 1px");
		  $("#errEmail").hide("fast");
		  
			  $.ajax({
				type: "POST",
				url: "emailCheck.php",
				data: "username="+email,
				success: function(result){
								if(result=="checked"){
									$("#signIn").val("Sign In and continue");
									signUrl="loginPost.php";
								}else{
									$("#signIn").val("Sign Up and continue");
									signUrl="signUp.php";
								}
							},
				error: function(xhr){
							alert("An error occured: " + xhr.status + " " + xhr.statusText);
						}
			});
		  
		}
		else{
			$("#emailIn").css("border","#FF3300 solid 1px");
			$("#errEmail").show("fast");
		}
	
  });
});

function validateForm(){
		var username=getCookie("username");
			if (username!=null && username!="")
			 {	if(validateFormA())
			 	{	if (!$("input[name='payOpt']:checked").val()) {
					$("#errPay").show("fast");
					return false;
					}
				}else{return false;}
			}else{
				$(".signed").hide("fast");				  
				$(".unsigned").show("fast");
				return false;
			}
}
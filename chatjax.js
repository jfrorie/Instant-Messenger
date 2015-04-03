function Ajax_Send(GP,URL,PARAMETERS,RESPONSEFUNCTION){
var xmlhttp
try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")}
catch(e){
try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")}
catch(e){
try{xmlhttp=new XMLHttpRequest()}
catch(e){
alert("Your Browser Does Not Support AJAX")}}}

err=""
if (GP==undefined) err="GP "
if (URL==undefined) err +="URL "
if (PARAMETERS==undefined) err+="PARAMETERS"
if (err!=""){alert("Missing Identifier(s)\n\n"+err);return false;}

xmlhttp.onreadystatechange=function(){
if (xmlhttp.readyState == 4){
if (RESPONSEFUNCTION=="") return false;
eval(RESPONSEFUNCTION(xmlhttp.responseText))
}
}

if (GP=="GET"){
URL+="?"+PARAMETERS
xmlhttp.open("GET",URL,true)
xmlhttp.send(null)
}

if (GP="POST"){
PARAMETERS=encodeURI(PARAMETERS)
xmlhttp.open("POST",URL,true)
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
xmlhttp.setRequestHeader("Content-length",PARAMETERS.length)
xmlhttp.setRequestHeader("Connection", "close")
xmlhttp.send(PARAMETERS)
}
}

lastReceived=0;

// Hide the message form
function hideShow(hs){
if(hs=="hide"){
signInForm.signInButt.value="Connect"
signInForm.signInButt.name="signIn"
messageForm.style.display="none"
signInForm.userName.style.display="block"
signInName.innerHTML=""
}
if(hs=="show"){
signInForm.signInButt.value="Sign out"
signInForm.signInButt.name="signOut"
messageForm.style.display="block"
signInForm.userName.style.display="none"
signInName.innerHTML=signInForm.userName.value 
}
}


// Sign in and Out
function signInOut(){
if (signInForm.userName.value=="" || signInForm.userName.value.indexOf(" ")>-1){
alert("Not valid user name\nPlease make sure your user name didn't contains a space\nOr it's not empty.");
signInForm.userName.focus();
return false;
}

// Sign in
if (signInForm.signInButt.name=="signIn"){
data="user=" + signInForm.userName.value +"&oper=signin"
Ajax_Send("POST","users.php",data,checkSignIn);
return false
}

// Sign out
if (signInForm.signInButt.name=="signOut"){
data="user=" + signInForm.userName.value +"&oper=signout"
Ajax_Send("POST","users.php",data,checkSignOut);
return false
}
}

// Sign in response
function checkSignIn(res){
if(res=="userexist"){
alert("The user name you typed is already exist\nPlease try another one");
return false;
}
if(res=="signin"){
hideShow("show")

messageForm.message.focus()
updateInterval=setInterval("updateInfo()",3000);
serverRes.innerHTML="Sign in"
}
}

// Sign out response
function checkSignOut(res){
if(res=="usernotfound"){
serverRes.innerHTML="Sign out error";
res="signout"
}
if(res=="signout"){
hideShow("hide")
signInForm.userName.focus()
clearInterval(updateInterval)
serverRes.innerHTML="Sign out"
return false
}
}

// Update info
function updateInfo(){
serverRes.innerHTML="Updating"
Ajax_Send("POST","users.php","",showUsers)
Ajax_Send("POST","receive.php","lastreceived="+lastReceived,showMessages)
}

// update online users
function showUsers(res){
usersOnLine.innerHTML=res
}

// Update messages view
function showMessages(res){
serverRes.innerHTML=""
msgTmArr=res.split("<SRVTM>")
lastReceived=msgTmArr[1]
messages=document.createElement("span")
messages.innerHTML=msgTmArr[0]
chatBox.appendChild(messages)
chatBox.scrollTop=chatBox.scrollHeight
}

// Send message
function sendMessage(){
data="message="+messageForm.message.value+"&user="+signInForm.userName.value
serverRes.innerHTML="Sending"
Ajax_Send("POST","send.php",data,sentOk)
}

// Sent Ok
function sentOk(res){
if(res=="sentok"){
messageForm.message.value=""
messageForm.message.focus()
serverRes.innerHTML="Sent"
}
else{
serverRes.innerHTML="Not sent"
}
}

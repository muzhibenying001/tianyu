
//获取input的所有id
var user = document.getElementById("user");
var pwd = document.getElementById("pwd");
var surePwd = document.getElementById("surePwd");


//获取span的所有id
var user_pass = document.getElementById("user_pass");
var pwd_pass = document.getElementById("pwd_pass");
var surePwd_pass = document.getElementById("surePwd_pass");
function checkUser(){
    //如果昵称未输入，则提示输入昵称
    if(!user.value){
        user_pass.style.fontSize = "13px";
        user_pass.style.width="31%";
        user_pass.style.height="2em";
        user_pass.style.textAlign="center";
        user_pass.style.lineHeight="2em";
        user_pass.style.marginTop='-13px'
        user_pass.innerHTML = '你还没有填写用户名哦。';
        user_pass.style.display="block";
    }
    else if(user.value){
        user_pass.style.display="none";
    }
}

//输入密码提示
function checkUser1(){
    //如果未输入密码，则提示请输入密码
    if(!pwd.value){
        pwd_pass.style.fontSize = "13px";
        pwd_pass.style.width="31%";
        pwd_pass.style.height="2em";
        pwd_pass.style.textAlign="center";
        pwd_pass.style.lineHeight="2em";
        pwd_pass.innerHTML = '你还没有填写密码哦。';
        pwd_pass.style.display="block";
    }
    else{
        pwd_pass.innerHTML ='';
        // pwd_pass.style.backgroundColor= "#fff";
        pwd_pass.style.border="none";
        pwd_pass.style.display="none";

    }

}

//确认密码提示
function checkUser2(){
    //再次确认密码
    if(!surePwd.value){
        surePwd_pass.style.fontSize = "13px";
        surePwd_pass.style.width="31%";
        surePwd_pass.style.height="2em";
        surePwd_pass.style.textAlign="center";
        surePwd_pass.style.lineHeight="2em";
        surePwd_pass.innerHTML = '你还没有填写验证码哦';
        surePwd_pass.style.display="block";
    }

    else{
        surePwd_pass.innerHTML ='';
        // surePwd_pass.style.backgroundColor= "#fff";
        surePwd_pass.style.border="none";
        surePwd_pass.style.display="none";
    }
}

function submitB(url,login){

    if(!user.value){
        user_pass.style.fontSize = "13px";
        user_pass.style.width="31%";
        user_pass.style.height="2em";
        user_pass.style.textAlign="center";
        user_pass.style.lineHeight="2em";
        user_pass.innerHTML = '请填写您的用户名。';
        user.focus();
        return false;
    }
    if(!pwd.value){
        pwd_pass.style.fontSize = "13px";
        pwd_pass.style.width="31%";
        pwd_pass.style.height="2em";
        pwd_pass.style.textAlign="center";
        pwd_pass.style.lineHeight="2em";
        pwd_pass.innerHTML = '请填写您的用户密码。';
        pwd.focus();
        return false;
    }

    /*发送ajax*/
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if( xhr.readyState == 4 && xhr.status == 200 ){
            var res = xhr.responseText;
            var json = JSON.parse(res)

            if( json.code == 10000 ){
                location.href= url;
                return;
            }else{
                alert(json.msg);
                getElementById('surePwd').style.backgroundImage='url({:captcha_src()}?'+Math.random()+')';
                return false;
            }
        }
    }
    xhr.open('post',login);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('username='+user.value+'&password='+pwd.value+'&captcha='+surePwd.value);
    return false;


}
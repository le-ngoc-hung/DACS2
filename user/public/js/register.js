function validatePhone(phone) {
    const form = /^0\d{9}$/;
    return form.test(phone);
}
function validateEmail(email) {
    const form = /@/;
    return form.test(email);
}
function tkdk(){
    let tkIn = document.getElementById('1');
    let tk = tkIn.value.trim();
    if (!validateEmail(tk)&&!validatePhone(tk)){
        tkIn.style.border="2px solid red";
        document.getElementById('tkdk').style.visibility='visible';
    }
    else{
        tkIn.style.border="2px solid #08A045";
        document.getElementById('tkdk').style.visibility='hidden';
    }
}
function tendn(){
    let nameIn = document.getElementById('2');
    let name = nameIn.value.trim();
    if (name==""){
        nameIn.style.border="2px solid red";
        document.getElementById('tendk').style.visibility='visible';
    }
    else{
        nameIn.style.border="2px solid #08A045";
        document.getElementById('tendk').style.visibility='hidden';
    }
}
function matkhau(){
    let passIn = document.getElementById('3');
    let pass = passIn.value.trim();
    if (pass.length<6){
        passIn.style.border="2px solid red";
        document.getElementById('mkdk').style.visibility='visible';
    }
    else{
        passIn.style.border="2px solid #08A045";
        document.getElementById('mkdk').style.visibility='hidden';
    }
}
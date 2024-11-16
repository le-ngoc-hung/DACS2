function validatePhone(phone) {
    const form = /^0\d{9,10}$/;
    return form.test(phone);
}
function validateEmail(email) {
    const form = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return form.test(email);
}
function kiemTraEmail() {
    let tkIn = document.getElementById('mail');
    let tk = tkIn.value.trim();
    if (!validateEmail(tk)) {
        tkIn.style.border = "2px solid red";
        document.getElementById('email').style.visibility = 'visible';
        return false;
    } else {
        tkIn.style.border = "2px solid #08A045";
        document.getElementById('email').style.visibility = 'hidden';
        return true;
    }
}

function tenDangNhap() {
    let nameIn = document.getElementById('tendn');
    let name = nameIn.value.trim();
    if (name == "") {
        nameIn.style.border = "2px solid red";
        document.getElementById('username').style.visibility = 'visible';
        return false;
    } else {
        nameIn.style.border = "2px solid #08A045";
        document.getElementById('username').style.visibility = 'hidden';
        return true;
    }
}

function matKhau() {
    let passIn = document.getElementById('matkhau');
    let pass = passIn.value.trim();
    if (pass.length < 6) {
        passIn.style.border = "2px solid red";
        document.getElementById('pass').style.visibility = 'visible';
        return false;
    } else {
        passIn.style.border = "2px solid #08A045";
        document.getElementById('pass').style.visibility = 'hidden';
        return true;
    }
}

function hoTen() {
    let nameIn = document.getElementById('ten');
    let name = nameIn.value.trim();
    if (name == "") {
        nameIn.style.border = "2px solid red";
        document.getElementById('name').style.visibility = 'visible';
        return false;
    } else {
        nameIn.style.border = "2px solid #08A045";
        document.getElementById('name').style.visibility = 'hidden';
        return true;
    }
}

function vaiTro() {
    var radios = document.getElementsByName('choose');
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return radios[i].value; 
        }
    }
    return null;
}

function baoLoiVaiTro(){
    let freelancer = document.getElementById('borFree');
    let employer = document.getElementById('borEmploy');
    if(vaiTro() == null){
        freelancer.style.border = "2px solid red";
        employer.style.border = "2px solid red";
        return false;
    }
    else {
        freelancer.style.border = "2px solid #08A045";
        employer.style.border = "2px solid #08A045";
        return true;
    }
}

function kiemTraForm(event) {
    let isValid = hoTen() && kiemTraEmail() && tenDangNhap() && matKhau() && baoLoiVaiTro();
    if (!isValid) {
        event.preventDefault();
        return false;
    }
    return true;
}

window.onload = function() {
    document.getElementById('registerForm').onsubmit = kiemTraForm;
};


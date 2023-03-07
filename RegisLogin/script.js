let sign = document.querySelector(".signn");
let login = document.querySelector(".login");
let low = false;
let upp = false;
let num = false;
let spec = false;
let lent = false;

sign.addEventListener('click', function(){
    document.getElementById("sig").classList.remove('hide');
    document.getElementById("log").classList.add('hide');

});

login.addEventListener('click', function(){
    document.getElementById("sig").classList.add('hide');
    document.getElementById("log").classList.remove('hide');

});

let pswrd = document.getElementById('pswrd');

let lowerCase = document.getElementById('lower');
let upperCase = document.getElementById('upper');
let digit = document.getElementById('number');
let specialChar = document.getElementById('special');
let minLength = document.getElementById('length');

function checkPassword(data) {
    const lower = new RegExp('(?=.*[a-z])');
    const upper = new RegExp('(?=.*[A-Z])');
    const number = new RegExp('(?=.*[0-9])');
    const special = new RegExp('(?=.*[!@#\$%\^&\*])');
    const length = new RegExp('(?=.{8,})');

    if (lower.test(data)) {
        lowerCase.classList.add('valid');
        low = true;
    } else {
        lowerCase.classList.remove('valid');
        low = false;
    }

    if (upper.test(data)) {
        upperCase.classList.add('valid');
        upp = true;
    } else {
        upperCase.classList.remove('valid');
        upp = false;
    }

    if (number.test(data)) {
        digit.classList.add('valid');
        num = true;
    } else {
        digit.classList.remove('valid');
        num = false;
    }

    if (special.test(data)) {
        spec = true;
        specialChar.classList.add('valid');
    } else {
        specialChar.classList.remove('valid');
        spec = false;
    }

    if (length.test(data)) {
        minLength.classList.add('valid');
        lent = true;
    } else {
        minLength.classList.remove('valid');
        lent = false;
    }
}

let val = document.getElementById('val');

pswrd.addEventListener('focus', function () {
    val.style.display = 'block';
})

pswrd.addEventListener('blur', function () {
    val.style.display = 'none';
});

let ket = document.getElementById("ket");
let btn = document.getElementById("btn");
function check(data) {
    if(data == pswrd.value && low === true && upp === true && num === true && spec === true && lent === true){
        ket.innerText = "Confirmed*";
        ket.style.color = "green";
        btn.removeAttribute('disabled');
        btn.style.cursor = 'pointer';

    }else{
        ket.innerText = "Not Confirmed*";
        ket.style.color = "red";
        btn.setAttribute('disabled', '');
        btn.style.cursor = 'default';
    }
}

let form = document.querySelector(".form");
let sig = document.getElementById('sig');
let cpswrd = document.getElementById('cpswrd');
cpswrd.addEventListener('focus', function () {
    ket.style.display = 'block';
    sig.style.marginTop = '0px';
})

cpswrd.addEventListener('blur', function () {
    ket.style.display = 'none';
    sig.style.margin = '100px auto';
});

let icon = document.getElementById("icon");
let pwll = document.querySelector(".pwll");

icon.addEventListener('click', function () {
    if (pwll.type === 'password') {
        pwll.setAttribute('type', 'text');
        icon.classList.add('hidee');
    } else {
        pwll.setAttribute('type', 'password');
        icon.classList.remove('hidee');

    }
})
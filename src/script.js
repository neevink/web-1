const minY = -5, maxY = 5;
const minR = 1, maxR = 4;
let x, y, r;

function isNumeric(val) {
    return !isNaN(parseFloat(val)) && isFinite(val);
}

function isInt(val){
    return /^-?[0-9]{1,10}$/.test(val);

}

function isFloat(val){
    return /^-?[0-9]{0,6}(.|,)[0-9]{0,5}$/.test(val);

}

function validateX() {
    const arr = [...document.querySelectorAll("input[name=x]:checked")];
    if (arr.length === 0) {
        return false;
    }
    x = arr.map(x => x.getAttribute('value'));
    return true;
}

function validateY() {
    let yField = $('#y');
    let yNum = yField.val().replace(',', '.');
    if (isNumeric(yNum) && isFloat(yNum) && minY <= yNum && yNum <= maxY) {
        y = yNum;
        return true;
    }
    return false;
}

function validateR() {
    let rField = $('#r');
    let rNum = rField.val().replace(',', '.');
    if (isNumeric(rNum) && isFloat(rNum) && minR <= rNum && rNum <= maxR) {
        r = rNum;
        return true;
    }
    return false;
}

function validateForm(){
    msg = '';
    if(!validateX()){
        msg += 'Для поля X нужно выбрать один из предложенных вариантов\n';
    }
    if(!validateY()){
        msg += 'В поле Y должно быть число от -5 до 5 с не более чем пятью знаками после запятой\n';
    }
    if(!validateR()){
        msg += 'В поле R должно быть число от 1 до 4 с не более чем пятью знаками после запятой\n';
    }

    if(msg !== ''){
        alert(msg);
        return false;
    }
    else{
        alert('x = ' + x + ', y = ' + y + ',r = ' + r);
        return true;
    }}

function submitForm(form) {
    let isValid = validateForm();

    if(isValid){
        form.submit();
    }
    else{
        form.preventDefault();
    }
}

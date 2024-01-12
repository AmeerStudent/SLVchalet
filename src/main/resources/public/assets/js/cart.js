const minus = document.querySelector(".minus") ;
const plus = document.querySelector(".plus");
const quantity = document.getElementById("quantity");
var available_quan;

function variation() {
    var ch = document.getElementsByName('variation');

    for (var i = ch.length; i--;) {
        ch[i].onchange = function() {
            quantity.value = 1;
            available_quan = this.value;
        }
    }

}


minus.onclick = function(){
    if(quantity.value <= 1){
        alert("Please enter valid quantity");
        quantity.value = 1; 
    }else{
        quantity.value = parseInt(quantity.value) - 1;
    }
}

plus.onclick = function() {
    if(parseInt(quantity.value) >= available_quan){
        alert("You have exceed the maximum quantity of this product.")
        quantity.value = 1; 
    }else{
        quantity.value = parseInt(quantity.value) + 1;

    }
}

function box_quan(){
    if(quantity.value > available_quan){
        alert("You have exceed the maximum quantity of this product.")
        quantity.value = 1; 
    }else if(quantity.value < 1){
        alert("Please enter valid quantity");
        quantity.value = 1; 
    }
}


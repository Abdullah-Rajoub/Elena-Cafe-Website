let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}

let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    cartItem.classList.remove('active');
}

let cartItem = document.querySelector('.cart-items-container');

document.querySelector('#cart-btn').onclick = () =>{
    cartItem.classList.toggle('active');
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}


// HI: Start of Contact
// HI: This is for the Switching Divs in the contact section
function switchVisible() {
    if (document.getElementById('Support')) {

        if (document.getElementById('Support').style.display == 'none') {
            document.getElementById('Support').style.display = 'inline';
            document.getElementById('HireMe').style.display = 'none';
        }
        else {
            document.getElementById('Support').style.display = 'none';
            document.getElementById('HireMe').style.display = 'inline';
        }
    }
}
function disablefirstbutton() {
    document.getElementById("Button1").disabled = true;
    document.getElementById("Button2").disabled = false;
}

function disablesecondbutton() {
    document.getElementById("Button2").disabled = true;
    document.getElementById("Button1").disabled = false;
}

// HI: End of Contact
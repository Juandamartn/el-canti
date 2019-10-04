var newOrder = document.getElementById('newOrder');
var modal = document.getElementById('modal');
var modal1 = document.getElementsByClassName('modal1');
var chek = document.getElementsByClassName('chek');
var cancel = document.getElementsByClassName('cancel');
var deleteOrder = document.getElementById('deleteOrder');
var no = document.getElementsByClassName('no');
var order = document.getElementsByClassName('report');

newOrder.onclick = function () {
    modal.style.display = "block";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } else if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

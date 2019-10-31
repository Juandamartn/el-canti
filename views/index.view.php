<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <title>Antojitos "El Cantinflas"</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>

<body>
    <div class="wrap" id="wrap">
        <header>
            <div class="logo" id="logo">
                <img src="img/cantinflas-logo.png" alt="Antojitos 'El Cantinflas'">
            </div>

            <a href="php/logout.php" class="logout" id="logout">
                <div>
                    <i class="fas fa-sign-out-alt"></i>Cerrar sesión
                </div>
            </a>
        </header>

        <div class="menu" id="menu">
            <ul>
                <a href="index.php?view=home">
                    <li>
                        <i class="fas fa-home"></i> Inicio
                    </li>
                </a>

                <a href="index.php?view=sales">
                    <li>
                        <i class="fas fa-shopping-cart"></i> Ventas
                    </li>
                </a>

                <a href="index.php?view=reports">
                    <li>
                        <i class="fas fa-chart-line"></i> Reportes
                    </li>
                </a>

                <a href="index.php?view=users">
                    <li>
                        <i class="fas fa-users"></i> Usuarios
                    </li>
                </a>
            </ul>
        </div>

        <div class="wrapped-content" id="wrapped-content">
            <?php
            switch ($view) {
                case 'home':
                    require 'views/home.view.php';
                    break;
                
                case 'sales':
                    require 'views/sales.view.php';
                    break;
                    
                case 'reports':
                    require 'views/reports.view.php';
                    break;
                    
                case 'users':
                    require 'views/users.view.php';
                    break;
            }
            ?>
        </div>
    </div>

    <script>
        var selectIng = document.getElementById('selectIng');
        var selectFood = document.getElementById('selectFood');
        var form = document.getElementById('orderList');
        var items = document.getElementsByClassName('items');
        var check = document.getElementsByClassName('check');
        var warning = document.getElementById('warning');
        var noItem = document.getElementById('noItem');
        var charge = document.getElementById('charge');
        var modal = document.getElementById('modal');
        var contOrder = document.getElementById('setOrder');
        var charge01 = document.getElementById('charge01');
        var chargeYes = document.getElementById('chargeYes');
        var totalCharge = document.getElementById('totalCharge');

        function addItem(name, id) {
            selectIng.style.display = 'flex';
            var ind = 0;

            if (items.length == 0) {
                ind = 1;
            } else {
                ind = parseInt(items[items.length - 1].dataset.num, 10) + 1;
            }

            var newInput = document.createElement("INPUT");
            newInput.type = 'text';
            newInput.setAttribute('name', 'item' + ind);
            newInput.setAttribute('value', id);
            newInput.setAttribute('class', 'hidden');

            var newP = document.createElement('p');
            newP.innerText = name;

            var newDiv = document.createElement('div');
            newDiv.setAttribute('class', 'items');
            newDiv.setAttribute('id', 'itemOrder' + ind);
            newDiv.setAttribute('ondblclick', 'deleteItem(this)');
            newDiv.dataset.num = ind;

            selectFood.style.display = 'none';
            form.appendChild(newDiv);
            items[items.length - 1].appendChild(newInput);
            items[items.length - 1].appendChild(newP);
        }

        function addItemIng(name, id) {
            selectFood.style.display = 'flex';
            selectIng.style.display = 'none';

            if (items.length == 0) {
                ind = 1;
            } else {
                ind = items[items.length - 1].dataset.num;
            }

            var nameF = items[items.length - 1].lastChild;
            nameF.innerText += ' ' + name;

            var newInput = document.createElement("INPUT");
            newInput.type = 'text';
            newInput.setAttribute('name', 'id' + ind);
            newInput.setAttribute('value', id);
            newInput.setAttribute('readonly', '');
            newInput.setAttribute('class', 'hidden');

            items[items.length - 1].appendChild(newInput);

            var newCheck = document.createElement("INPUT");
            newCheck.type = 'checkbox';
            newCheck.setAttribute('name', 'check' + ind);
            newCheck.setAttribute('id', 'check' + ind);

            var newLabel = document.createElement("label");
            newLabel.setAttribute('for', 'check' + (items.length));
            newLabel.setAttribute('class', 'check');

            var newSpan = document.createElement("span");

            items[items.length - 1].appendChild(newCheck);
            items[items.length - 1].appendChild(newLabel);
            check[check.length - 1].appendChild(newSpan);

            var newInd = document.createElement('INPUT');
            newInd.type = "text";
            newInd.setAttribute('name', 'ind' + ind);
            newInd.setAttribute('id', 'ind' + ind);
            newInd.setAttribute('value', ind);
            newInd.setAttribute('class', 'hidden');

            items[items.length - 1].appendChild(newInd);
        }

        function accept() {
            if (items.length == 0) {
                warning.style.display = 'block';
            } else {
                var itemCount = items[items.length - 1].dataset;

                form.submit();
            }
        }

        function showForm(form) {
            var cont = form.dataset.container;
        }

        function closeForm(form) {
            var cont = form.parentNode;

            cont.parentNode.style.display = 'none';
            modal.style.display = 'none';
        }

        function deleteItem(id) {
            form.removeChild(id);
        }

        function chargeOrder(form) {
            modal.style.display = 'block';
            contOrder.style.display = 'none';
            charge.style.display = 'block';

            var id = form.dataset.id;
            chargeYes.dataset.id = id;

            var total = document.getElementById('total' + id);
            totalCharge.innerText = 'Total: ' + total.innerHTML;

            chargeYes.dataset.total = total.innerHTML;
        }

        function chargeO() {
            window.location = "php/chargeOrder.php?chek=" + chargeYes.dataset.id + "&total=" + chargeYes.dataset.total.substring(2, chargeYes.dataset.total.length);
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function subtraction(val) {
            var t = 0;
            val = parseInt(val);

            t = chargeYes.dataset.total.substring(2, chargeYes.dataset.total.length);

            t = (t == null || t == undefined || t == "") ? 0 : t;

            t = (parseInt(val) - parseInt(t));

            exchange.innerHTML = 'Cambio: $ ' + t;
        }

    </script>
</body>

</html>

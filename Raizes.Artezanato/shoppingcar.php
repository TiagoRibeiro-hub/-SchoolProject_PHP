<?php
include_once 'header.php';
?>

<!--------Shooping Car---------->
<!--------First Table---------->
<section class="container">
    <table class="table">
        <thead>
            <tr class="table-dark">
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">NameProd</th>
                <td>5.00</td>
                <td>1</td>
                <td>5.00</td>
            </tr>
            <tr>
                <th scope="row">NameProd</th>
                <td>12.00</td>
                <td>1</td>
                <td>12.00</td>
            </tr>
            <tr>
                <th scope="row">NameProd</th>
                <td>8.00</td>
                <td>1</td>
                <td>8.00</td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>
</section>
<!--------End First Table---------->

<!--------Second Table---------->
<section class="container">
    <table class="table">
        <thead>
            <tr class="table-dark">
                <th scope="col">Total</th>
                <th scope="col">Quantity</th>
                <th scope="col">IVA</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">NameProd</th>
                <td>3</td>
                <td>13%</td>
                <td>20.00</td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>
</section> 
<!--------Second Table---------->

<!--------Payment Zone---------->
<section class="container payment-zone">
    <div class="row">
        <div class="col checkout-btn d-flex justify-content-sm-center">
            <select class="opcao-pagam">
                <option selected>Payment Option</option>
                <option value="PayPal" >PayPal</option>
                <option value="CreditCard" >CreditCard</option>
            </select>
        </div> 
        <div class="col checkout-btn d-flex justify-content-sm-center">
            <button type="button" class="btn btn-dark btn-lg">Checkout</button>
        </div>
    </div>
</section>

<!--------Payment Zone---------->
<!--------End Shooping Car---------->

<?php
include_once 'footer.php';
?>
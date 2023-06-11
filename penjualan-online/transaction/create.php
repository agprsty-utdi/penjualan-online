<?php

require_once '../utils.php';
require_once '../repository/TransactionRepository.php';

$repo = new TransactionRepository();
$consumers = $repo->getAllConsumers();
$products = $repo->getAllProducts();

$productPrices = array();
$productNames = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Create Transaction</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Create Transaction</h1>
  
  <form action="process_create.php" method="POST">
    <label for="customer_id">Customer Name:</label>
    <select name="customer_id" required>
      <option value="">Select Customer</option>
      <?php
      foreach ($consumers as $consumer) {
      ?>
      <option value="<?php echo $consumer->_id; ?>"><?php echo $consumer->name; ?></option>
      <?php
      }
      ?>
    </select>
    <br><br>
    
    <table id="order_items">
      <tr>
        <th>Product</th>
        <th>Price per Unit</th>
        <th>Quantity</th>
      </tr>
      <tr>
        <td>
          <select name="product_id[]" required>
            <option value="">Select Product</option>
            <?php
            foreach ($products as $product) {
              $productPrices[$product->_id] = $product->price;
              $productNames[$product->_id] = $product->name;
            ?>
            <option value="<?php echo $product->_id; ?>"><?php echo $product->name; ?></option>
            <?php
            }
            ?>
          </select>
        </td>
        <td>
          <input type="number" name="price_per_unit[]" value="0" min="0" readonly>
        </td>
        <td>
          <input type="number" name="quantity[]" value="1" min="1" onchange="calculateTotalPrice()">
        </td>
      </tr>
      <!-- Add more rows for additional products -->
    </table>
    
    <br>
    <label for="total_price">Total Price:</label>
    <input type="text" id="total_price" name="total_price" value="0" min="0" readonly><br><br>
    
    <br>
    <button onclick="addOrderItem()">Add Item</button>
    <input type="submit" value="Create Transaction">
  </form>
  
  <script>
    // Function to handle dynamic price per unit based on selected product
    $(document).on('change', 'select[name="product_id[]"]', function() {
      var selectedProductId = $(this).val();
      var pricePerUnitInput = $(this).closest('tr').find('input[name="price_per_unit[]"]');
      var productPrices = <?php echo json_encode($productPrices); ?>;
      var pricePerUnit = productPrices[selectedProductId];
      pricePerUnitInput.val(pricePerUnit);
      calculateTotalPrice();
    });
    
    function calculateTotalPrice() {
      var totalPriceInput = $('#total_price');
      var totalPrice = 0;
      var itemsCount = 0;
      
      $('table#order_items tr').each(function() {
        var quantityInput = $(this).find('input[name="quantity[]"]');
        var pricePerUnitInput = $(this).find('input[name="price_per_unit[]"]');
        
        var quantity = parseInt(quantityInput.val());
        var pricePerUnit = parseFloat(pricePerUnitInput.val());
        
        if (!isNaN(quantity) && !isNaN(pricePerUnit)) {
          totalPrice += quantity * pricePerUnit;
          itemsCount++;
        }
      });
      
      if (itemsCount > 0) {
        totalPriceInput.val(totalPrice.toFixed(2));
      } else {
        totalPriceInput.val("0.00");
      }
    }

    function addOrderItem() {
      var table = document.getElementById("order_items");
      var row = table.insertRow(-1);
      var productCell = row.insertCell(0);
      var pricePerUnitCell = row.insertCell(1);
      var quantityCell = row.insertCell(2);
      var selectHTML = '<select name="product_id[]" required>' +
                '  <option value="">Select Product</option>';
      var productNames = <?php echo json_encode($productNames); ?>;
      for (var key in productNames) {
        var value = productNames[key];
        selectHTML += `  <option value="${key}">${value}</option>`;
      }
      selectHTML += '</select>';
      productCell.innerHTML = selectHTML;
      pricePerUnitCell.innerHTML = '<input type="number" name="price_per_unit[]" value="0" min="0" readonly>';
      quantityCell.innerHTML = '<input type="number" name="quantity[]" value="1" min="1" onchange="calculateTotalPrice()">';
    }
  </script>  
</body>
</html>

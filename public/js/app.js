function preview() {
  frame.src = URL.createObjectURL(event.target.files[0]);
}
function clearImage() {
  document.getElementById('coverImage').value = null;
  frame.src = "";
}

var disc_elements = document.querySelectorAll(".item-disc");
var qty_elements = document.querySelectorAll(".item-qty");

disc_elements.forEach(function (element) {

  element.addEventListener("input", function (e) {
    var classList = e.target.className;
    var regex = /bill-item-disc--(\d+)/;
    var match = classList.match(regex);

    if (match) {
      update_bill(match, classList)
    } 
    
  });
});

qty_elements.forEach(function (element) {

  element.addEventListener("input", function (e) {
    var classList = e.target.className;
    var regex = /bill-item-qty--(\d+)/;
    var match = classList.match(regex);

    if (match) {
      update_bill(match, classList)
    }
  });
});

function update_bill(match, classList){
  let disc_regex = /item-disc/;
  let qty_regex = /item-qty/;
  let disc_match = classList.match(disc_regex);
  let qty_match = classList.match(qty_regex);

  let sale_product_id = parseInt(match[1]);
  let bill_item_ele = document.querySelector(".bill-items-list-" + sale_product_id);
  let bill_item_sale_price_ele = document.querySelector(".bill-item-sale-price--" + sale_product_id);
  let bill_item_disc_ele = document.querySelector(".bill-item-disc--" + sale_product_id);
  let bill_item_bill_qty_ele = document.querySelector(".bill-item-qty--" + sale_product_id);
  let bill_item_bill_total_ele = document.querySelector(".bill-item-total--" + sale_product_id);

  

  if(bill_item_sale_price_ele && bill_item_disc_ele && bill_item_bill_qty_ele && bill_item_bill_total_ele ){
    let sale_price_val = bill_item_sale_price_ele.textContent.trim();
    let disc_val = bill_item_disc_ele.value;
    let qty_val = bill_item_bill_qty_ele.value;
    bill_item_bill_total_ele.innerHTML = (sale_price_val-disc_val)*qty_val;
    

    if(qty_match){
      let bill_total_qty_ele = document.querySelector(".bill-item-qty");
      let qty_ele = document.querySelectorAll(".item-qty");
      var totalqty = get_input_total(qty_ele);
      bill_total_qty_ele.innerHTML = totalqty;
    }

    if(disc_match){
      let bill_total_disc_ele = document.querySelector(".bill-item-disc");
      let disc_ele = document.querySelectorAll(".item-disc");
      var totaldisc = get_input_total(disc_ele);
      bill_total_disc_ele.innerHTML = totaldisc;
    }

    let bill_total_ele = document.querySelector(".bill-item-total");
    let total_price_ele = document.querySelectorAll(".item-total");
    var all_total_price = get_text_total(total_price_ele);
    bill_total_ele.innerHTML = all_total_price;
  }
}


function get_text_total(ele){
  var total = 0;

  ele.forEach(function (element) {
    var elementValue = parseFloat(element.textContent.trim());
    if (!isNaN(elementValue)) {
      total += elementValue;
    }
  });
  return total;
}

function get_disc_total(ele){

  var total = 0;

  ele.forEach(function (element) {
    var elementValue = parseFloat(element.value);
    if (!isNaN(elementValue)) {
      total += elementValue;
    }
  });
  return total;
}

function get_input_total(ele){

  var total = 0;

  ele.forEach(function (element) {
    var elementValue = parseFloat(element.value);
    if (!isNaN(elementValue)) {
      total += elementValue;
    }
  });
  return total;
}



$(document).ready(function () {
  var base_url = window.location.origin;

  $('#customer_name, #customer_phone').on('input', function () {
      var searchTerm = $(this).val();

      $.ajax({
          url: '/search-customers',
          method: 'GET',
          data: { term: searchTerm },
          success: function (response) {
              var customerSelect = $('#customerSelect');
              customerSelect.empty();
              customerSelect.append($('<option>', {
                  value: '0',
                  text: 'Select a customer',
                  selected: true,
              }));
              $.each(response, function (index, customer) {
                  customerSelect.append($('<option>', {
                      value: customer.id,
                      text: customer.name + ' (' + customer.phone + ')'
                  }));
              });

              customerSelect.attr('size', customerSelect.find('option').length);

          }
      });
  });

  $('#search_product').on('input', function () {
    var searchTerm = $(this).val();
   
    $.ajax({
        url: '/search-product',
        method: 'GET',
        data: { 
          term: searchTerm
        },
        success: function (response) {
          var _token = $('input[name="_token"]').val();
          var productsContainer = $('#products-listing');
          productsContainer.empty();

          $.each(response, function (index, product) {
            var productHtml = `
                <div class="card sale-product p-0 mb-3 mx-1 border border-3 border-success app-buttons-border rounded-0">
                    <img src="${base_url}/cover_images/${product.cover_image_path}" width="100%" class="img-fluid rounded-start border-bottom rounded product-img" alt="...">
                    <div class="row">
                        <div class="card-body">
                            <div class="col-md-12 card-title fw-bold text-success text-center">
                                <a href="${base_url}/product/${product.id}">${product.title}</a>
                            </div>
                            <div class="col-md-12 card-isbn"><span class="fw-bold">ISBN:</span> ${product.isbn}</div>
                            <div class="col-md-12 card-price">
                                <span class="fw-bold">Price:</span>
                                ${product.disc > 0 ? `
                                <span class="fs-6 text-decoration-line-through">Rs ${product.sale_price}</span>
                                <span class="fs-4 text-success text-decoration-none">Rs ${product.sale_price - product.disc}</span>
                            ` : `
                                <span class="fs-4 text-success text-decoration-none">Rs ${product.sale_price - product.disc}</span>
                            `}
                            </div>
                            <form class="row" action="${base_url}/sale/create" method="POST">
                                <input type="hidden" name="_token" value="${_token}" autocomplete="off">
                                <input type="hidden" class="form-control" name="productId" value="${product.id}">
                                ${product.type === 'new' && product.quantity > 0 ? `
                                    <span class="fw-bold">Stock:</span>
                                    <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">
                                        <input type="number" id="inputQuantity" min="1" max="${product.quantity}" class="form-control w-50" name="productQty" placeholder="1" value="1">
                                        <span class="d-flex"> <span>/</span> ${product.quantity}</span>
                                    </div>
                                    <button type="submit" class="col-4 col-sm-4 col-md-4 button d-flex justify-content-end pe-3 transparent-btn ">
                                        <img src="${base_url}/icons/product-add-icon.svg" width="40%" height="40%" class="" alt="Product-Add-Icon">
                                    </button>
                                ` : product.type === 'custom' && product.quantity === -1 ? `
                                    <span class="fw-bold">Stock:</span>
                                    <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">
                                        <input type="number" id="inputQuantity" min="1" class="form-control w-50" name="productQty" placeholder="1" value="1">
                                    </div>
                                    <button type="submit" class="col-4 col-sm-4 col-md-4 button d-flex justify-content-end pe-3 transparent-btn ">
                                        <img src="${base_url}/icons/product-add-icon.svg" width="40%" height="40%" class="" alt="Product-Add-Icon">
                                    </button>
                                ` : `
                                    <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">
                                        <div class="text-danger fw-bold">OUT OF STOCK</div>
                                    </div>
                                `}
                            </form>
                            
                        </div>
                    </div>
                </div>
            `;

            // Append the product HTML to the container
            productsContainer.append(productHtml);
          });
        }
    });
  });

  $('.remove-sales-product').on('click', function (event) {
    let event_class_list = this.className.split(" ")[1];
    let event_id = event_class_list.split('--')[1]; 
    var _token = $('input[name="_token"]').val();

    $.ajax({
      url: '/cancel/sale-product/'+event_id,
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': _token },
      data: { sale_product_id: event_id },
      success: function (response) {
        // Redirect to the 'create-sale' page
        alert(response.message);
        window.location.href = '/sale/create';
      },
      error: function (xhr) {
          // Redirect to a page with error message
          alert(response.message);
          window.location.href = '/sale/create';
        }
    });
  });

  document.getElementById('payment_method').addEventListener('change', function() {
    var onlinePaymentNumberField = document.getElementById('online_payment_number_field');
    if (this.value === 'online') {
        onlinePaymentNumberField.style.display = 'block';
    } else {
        onlinePaymentNumberField.style.display = 'none';
    }
  });
  
});
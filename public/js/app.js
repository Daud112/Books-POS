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
  // console.log(element);
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
  // console.log(element);
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

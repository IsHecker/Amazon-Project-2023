let proName = document.getElementsByName("name");
let price = document.getElementsByName("price");
let category = document.getElementsByName("category");
let button = document.getElementsByName("submit");
let mode = document.getElementById("updatemode");
let prodid = document.getElementById("productid");

let products = [];

function GetAllProducts(productDetails) {
  mode.value = "";
  let newproduct = {
    productid: productDetails["product_id"],
    name: productDetails["name"],
    price: productDetails["price"],
    category: productDetails["category"],
  }

  products.push(newproduct);
}

function GetProduct(i){
  return products[i];
}

function PrepareUpdate(i) {
  i--;
  
  mode.value = "Update";
  prodid.value = products[i].productid;
  proName[0].value = products[i].name;
  price[0].value = products[i].price.split('$').join('');
  category[0].value = products[i].category;
  button[0].innerHTML = "Update";

  scroll({ top: 0, behavior: "smooth"});
}


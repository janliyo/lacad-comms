// Get the product display and checkout container elements
const productDisplay = document.querySelector('.product-display');
const checkoutContainer = document.querySelector('.checkout-container');

// Add click event listener to each product entry
productDisplay.addEventListener('click', (e) => {
    if (e.target.matches('.product-item, .product-item *')) {
      const product = e.target.closest('.product-item');
      const price = product.dataset.price;
      const name = product.querySelector('.name-tag').textContent;
      const itemList = checkoutContainer.querySelector('.item-list');
      const item = document.createElement('li');
      item.innerHTML = `<span>${name}</span><span>₱ ${price}</span>`;
      itemList.appendChild(item);
  
      // Update the checkout total
      updateCheckoutTotal();
    }
});

// Add click event listener to each product category button
const productButtons = document.querySelectorAll('.product-button');
productButtons.forEach((button) => {
  button.addEventListener('click', (e) => {
    const category = e.target.dataset.category;
    const productItems = productDisplay.querySelectorAll('.product-item');
    productItems.forEach((item) => {
      if (category === 'all' || item.dataset.category === category) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  });
});

// Add click event listener to the search input
const searchInput = document.querySelector('#search-product');
searchInput.addEventListener('input', (e) => {
  const search = e.target.value.toLowerCase();
  const productItems = productDisplay.querySelectorAll('.product-item');
  productItems.forEach((item) => {
    const name = item.querySelector('.name-tag').textContent.toLowerCase();
    if (name.includes(search)) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
});

// Add click event listener to the name-tag element
const nameTags = document.querySelectorAll('.name-tag');
nameTags.forEach((nameTag) => {
  nameTag.addEventListener('click', (e) => {
    const product = e.target.closest('.product-item');
    const price = product.dataset.price;
    const name = e.target.textContent;
    const itemList = checkoutContainer.querySelector('.item-list');
    const item = document.createElement('li');
    item.innerHTML = `<span>${name}</span><span>₱ ${price}</span>`;
    itemList.appendChild(item);

    // Update the checkout total
    updateCheckoutTotal();
  });
});

// Function to update the checkout total
function updateCheckoutTotal() {
  const itemList = checkoutContainer.querySelector('.item-list');
  const items = itemList.querySelectorAll('li');
  let total = 0;
  items.forEach((item) => {
    const price = parseFloat(item.querySelector('span:nth-child(2)').textContent.replace('₱ ', ''));
    total += price;
  });
  const totalElement = checkoutContainer.querySelector('.total span:nth-child(2)');
  totalElement.textContent = `₱ ${total.toFixed(2)}`;
}
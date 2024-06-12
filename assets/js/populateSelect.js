document.addEventListener('DOMContentLoaded', function() {
    const categories = [
        "Fruits & Vegetables",
        "Dairy & Eggs",
        "Meat & Poultry",
        "Bakery",
        "Beverages",
        "Snacks",
        "Frozen Foods",
        "Canned & Packaged Foods",
        "Personal Care",
        "Household Supplies"
    ];

    const selectElement = document.getElementById('grocery-categories');

    if (selectElement) {
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category;
            option.textContent = category;
            selectElement.appendChild(option);
        });
    }
});

// populateSelect.js
if (document.getElementById('myElement')) {
    const myChildElement = document.createElement('div');
    myChildElement.textContent = 'Hello, world!';
    document.getElementById('myElement').appendChild(myChildElement);
}
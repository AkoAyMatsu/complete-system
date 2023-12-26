const fileInput = document.getElementById('file-upload');
const userImageView = document.getElementById("userImageView");
const closeAddProductButton = document.querySelectorAll('.close-add-product')


const productName = document.getElementById('product_type')
const productBuyPrice = document.getElementById('product--buy--price');
const productRefillPrice = document.getElementById('product--refill--price');
const productBorrowPrice = document.getElementById('product--borrow--price');
const productQuantity = document.getElementById('product--quantity');


const addButton = document.getElementById('addButton')



document.addEventListener('DOMContentLoaded', function(){
    // Add an event listener to detect file selection
    fileInput.addEventListener('change', handleFileSelect);

    // Handle file selection
    function handleFileSelect(event) {
        const selectedFile = event.target.files[0];

        // Display the selected image in the preview
        const reader = new FileReader();

        reader.onload = function () {
            userImageView.src = reader.result;
            //imageDataURL = reader.result;
        };

        reader.readAsDataURL(selectedFile);
    }

            // Reference to the form element
        const form = document.getElementById('product-form');

        // Add an event listener to the form for the submit event
        addButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Create a new FormData object
            const formData = new FormData(form);

            console.log(formData)

            // Fetch options
            const options = {
                method: 'POST',
                body: formData,
            };

            console.log(options)

            // Make the fetch request
            fetch('addProduct.php', options)
                .then(response => response.json())
                .then(data => {

                    if(data.errors){
                        // Handle the response data
                        console.log('Response:', data);
                        alert(data.errors);
                        productName.value = ''
                        productBorrowPrice.value = ''
                        productBuyPrice.value = ''
                        productRefillPrice.value = ''
                        productQuantity.value = ''
                        userImageView.src = ''
                    }else{
                        // Handle the response data
                        console.log('Response:', data);
                        alert(data.message);
                        productName.value = ''
                        productBorrowPrice.value = ''
                        productBuyPrice.value = ''
                        productRefillPrice.value = ''
                        productQuantity.value = ''
                        userImageView.src = ''
                    }
                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });



    

    //console.log(selectedImageData)


    closeAddProductButton.forEach(closeButton => {
        closeButton.addEventListener('click', () => {
            console.log("Working button!")
            productName.value = ''
            productBorrowPrice.value = ''
            productBuyPrice.value = ''
            productRefillPrice.value = ''
            productQuantity.value = ''
            userImageView.src = ''

            setTimeout(() => {
                window.location.reload();
            },0)
        })
    })

        

    const retrieveOrdersURL = 'bought.php';
    const retrieveBorrowedOrdersURL = 'borrowed.php';

    fetch(retrieveOrdersURL)
        .then(response => response.json())
        .then(data => {
            const orderData = data.orders

            console.log("Order Data: ", orderData);

            const productBoughtContainer = document.getElementById('product-bought-container');
            
            // Check if there is no data in both objects and arrays
            if (!orderData || Object.keys(orderData).length === 0) {
                // No pending orders found, create a row with a message
                const noOrdersRow = document.createElement('tr');
                noOrdersRow.className = "fw-bold h6 text-center";

                noOrdersRow.innerHTML = `
                    <td colspan="6" class="text-center fs-5">NO PRODUCTS BOUGHT FOUND!</td>
                `
                productBoughtContainer.appendChild(noOrdersRow);
            } else {
                // Loop through the orders
                for (const customerId in orderData) {
                    if (orderData.hasOwnProperty(customerId)) {
                        const orders = orderData[customerId];

                        // Loop through the orders for each customer
                        orders.forEach(order => {
                            const productRow = document.createElement('tr');

                            productRow.className = 'fw-bold h6 text-center';

                            productRow.innerHTML = `
                                <td>
                                    ${order.customer_name}
                                </td>

                                <td>
                                    <img src="../${order.product_image}" alt="" width=150 height=150 class="rounded-3"/>
                                    <span>${order.product_name}</span>
                                </td>

                                <td>
                                    ${order.order_date}
                                </td>

                                <td>
                                    ${order.order_quantity}
                                </td>

                                <td>
                                    ${order.product_id}
                                </td>

                                <td>
                                    ${order.order_type}
                                </td>
                            `
                            productBoughtContainer.appendChild(productRow);
                        });
                    }
                }
            }



        }).catch(error => console.error('Error fetching product data: ', error))



        fetch(retrieveBorrowedOrdersURL)
        .then(response => response.json())
        .then(data => {
            const orderData = data.orders

            console.log("Order Data: ", orderData);

            const productBorrowedContainer = document.getElementById('products-borrowed-container');
            
            // Check if there is no data in both objects and arrays
            if (!orderData || Object.keys(orderData).length === 0) {
                // No pending orders found, create a row with a message
                const noOrdersRow = document.createElement('tr');
                noOrdersRow.className = "fw-bold h6 text-center";

                noOrdersRow.innerHTML = `
                    <td colspan="6" class="text-center fs-5">NO BORROWED PRODUCTS FOUND!</td>
                `
                productBorrowedContainer.appendChild(noOrdersRow);
            } else {
                // Loop through the orders
                for (const customerId in orderData) {
                    if (orderData.hasOwnProperty(customerId)) {
                        const orders = orderData[customerId];

                        // Loop through the orders for each customer
                        orders.forEach(order => {
                            const productRow = document.createElement('tr');

                            productRow.className = 'fw-bold h6 text-center';

                            productRow.innerHTML = `
                                <td>
                                    ${order.customer_name}
                                </td>

                                <td>
                                    <img src="../${order.product_image}" alt="" width=150 height=150 class="rounded-3"/>
                                    <span>${order.product_name}</span>
                                </td>

                                <td>
                                    ${order.order_date}
                                </td>

                                <td>
                                    ${order.order_quantity}
                                </td>

                                <td>
                                    ${order.product_id}
                                </td>

                                <td>
                                    ${order.order_type}
                                </td>
                            `
                            productBorrowedContainer.appendChild(productRow);
                        });
                    }
                }
            }



        }).catch(error => console.error('Error fetching product data: ', error))

        const updateButtons = document.querySelectorAll('.update--button');

        updateButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const row = this.closest('tr');

                // Get the values from the current row
                // Get the values from the current row
                const productName = row.querySelector('.product--name').innerText;
                const productQuantity = row.querySelector('input[name="productNameInput"]').value;
                const productId = row.querySelector('.product--id').innerText;

                // Prepare the data to be sent to the server
                const formData = {
                    productName: productName,
                    productQuantity: productQuantity,
                    productId: productId
                };

                const updateProductsURL = 'updateProducts.php'

                // Make an AJAX request to update the data on the server
                fetch(updateProductsURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server if needed
                    console.log(data.product_id)
                    

                    if(data.message){
                        alert(data.message)

                        setTimeout(() => {
                            window.location.reload();
                        },0)
                    }
                })
                .catch(error => {
                    // Handle errors if the fetch request fails
                    console.error('Error updating product:', error);
                });
            });
        });






})
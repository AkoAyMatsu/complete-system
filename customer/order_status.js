// Function to create HTML for a single order
function createOrderElement(order) {
    const orderElement = document.createElement('div');
    orderElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-black border-2 rounded-1 d-flex mt-2 h-50';

    // Set inner HTML for the order element
    orderElement.innerHTML = `
        <img src="../${order.product_img}" alt="" width="160" height="175" class="rounded-2 border border-1 border-black my-3 mx-3">
        <div class="h6 fw-bold p-3 mt-3 py-1 h-25 w-100 text-end">
            ${order.order_status}
            <div class="h6 text-start mt-3 fw-bold">${order.product_type}</div>
            <div class="h6 mt-2 d-flex">Order Type: 
                <span class="h6 px-1 fw-bold">${order.order_type}</span>
            </div>
            <div class="h6 mt-4 py-1">
                x <span class="h6">${order.order_quantity}</span>
            </div>
            <div class="h6 mt-0 py-0 text-danger">
                Php <span class="h6 text-danger">${parseFloat(order.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
            </div>
        </div>
    `;

    return orderElement;
}

function createItemsAndPricesElement(orders, overallPrice){
    const itemPriceElement = document.createElement('div');
    itemPriceElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-2 border-black rounded-1 d-flex h-50';
    
    itemPriceElement.innerHTML = `
        <div class="h6 mt-2 w-50 mx-3 px-0">${orders.length}
            <span class="h6">item/s</span>
        </div>
        <div class="container d-flex justify-content-end mt-2">
            <div class="h6">Order Total: 
                <span class="h6 text-danger">Php</span>
            </div>
            <div class="h6 text-danger px-1">${overallPrice}</div>
        </div> 
    `;   
    
    return itemPriceElement;
}

function createDateElement(orders){
    const dateContainerElement = document.createElement('div');

    dateContainerElement.className = 'container-sm w-70 ms-0 p-2 d-flex mt-3 h-50 border-bottom border-3 justify-content-between';

    dateContainerElement.innerHTML = `
        <div class="h6 mt-2 w-50 mx-0 px-0 text-primary">Waiting for order confirmation
        </div>
        <div class="mt-2">
            ${orders[0].checkout_date}
        </div>  
        
    `;
    //dateContainer.appendChild(document.createElement('br'));
    return dateContainerElement;              
}
// Function to render orders with pending status
function renderPendingOrders(orders, container, itemsAndPriceContainer, dateContainer, noOrderContainer, orderCancellation) {
    // Clear the container first
    container.innerHTML = '';

    // Calculate the total price
    let totalPrice = 0;

    // Filter orders with pending status
    const pendingOrders = orders.filter(order => order.order_status === 'Pending');

    // Check if there are pending orders
    if (pendingOrders.length > 0) {
        console.log("Meron pang pending orders!")

        // Loop through the pending orders and create HTML for each order
        pendingOrders.forEach(order => {
            totalPrice += parseFloat(order.total_price);
            const orderElement = createOrderElement(order);
            // Append the order element to the container
            container.appendChild(orderElement);
        });

        const overallPrice = totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
        const itemsAndPriceElement = createItemsAndPricesElement(pendingOrders, overallPrice);

        itemsAndPriceContainer.innerHTML = '';
        itemsAndPriceContainer.appendChild(document.createElement('br'));
        itemsAndPriceContainer.appendChild(itemsAndPriceElement);

        const dateContainerElement = createDateElement(pendingOrders);
        dateContainer.innerHTML = '';
        dateContainer.appendChild(document.createElement('br'));
        dateContainer.appendChild(dateContainerElement);

        // Enable the cancel order button
        if (orderCancellation) {
            orderCancellation.disabled = false;
        }

    } else {
        itemsAndPriceContainer.innerHTML = '';
        dateContainer.innerHTML = '';
        console.log("Wala nang laman yung pending orders!")
        cancelOrders(noOrderContainer, orderCancellation);
    }
}

// Function to render orders
function renderOrders(orders, container, itemsAndPriceContainer, dateContainer, noOrderContainer, orderCancellation) {
    // Clear the container first
    container.innerHTML = '';

    console.log("Cancelled Orders Hello: ", orders)

    // Calculate the total price
    let totalPrice = 0;

    // Check if there are orders
    if (orders.length > 0) {
        console.log("Meron pang orders!")
        // Loop through the ordersData and create HTML for each order
        orders.forEach(order => {
            totalPrice += parseFloat(order.total_price);
            const orderElement = createOrderElement(order);
            // Append the order element to the container
            
            container.appendChild(orderElement);
            //container.appendChild(document.createElement('br'))
        });
        const overallPrice = totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
        const itemsAndPriceElement = createItemsAndPricesElement(orders, overallPrice);

        itemsAndPriceContainer.appendChild(document.createElement('br'));
        itemsAndPriceContainer.appendChild(itemsAndPriceElement);

        const dateContainerElement = createDateElement(orders);
        dateContainer.appendChild(document.createElement('br'));
        dateContainer.appendChild(dateContainerElement);

        // Enable the cancel order button
        if (orderCancellation) {
            orderCancellation.disabled = false;
        }

    }else{
        itemsAndPriceContainer.innerHTML = '';
        dateContainer.innerHTML = '';
        console.log("Wala nang laman yung orders!")
        cancelOrders(noOrderContainer, orderCancellation)
    }
}

function cancelOrders(noOrderContainer, cancelOrder){
        console.log('Cancelling orders...')

        if (cancelOrder) {
            cancelOrder.disabled = true;
        }
        const noOrderElement = document.createElement('div');
    
        noOrderElement.className = 'container-fluid w-100 p-2 text-bg-light rounded-1 d-flex mt-0 h-50 justify-content-center';
    
        noOrderElement.innerHTML = `
            <div class="h4 mt-1 mx-3 px-0 fw-bold text-center">
                <img src="clipboard_x.png" alt="" width=150 height=150>
                <div>NO PENDING ORDERS FOUND!</div>
            </div> 
        `;        
        
        noOrderContainer.appendChild(document.createElement('br'));
        noOrderContainer.appendChild(noOrderElement);

        alert("Successfully cancelling the orders!");

}

function displayReceivedOrderItems(receiveOrderItems, dates, container_1, container_2, container_3, container_4, receiveButton, orderStatus, noOrderContainer){
    let overallPrice = 0;

    console.log("Button state: ", receiveButton)

    receiveOrderItems.forEach(item => {

        overallPrice += parseFloat(item.total_price);

        let totalPrice = parseFloat(item.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        const receiveOrderItemsElement = document.createElement('div');

        receiveOrderItemsElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-black border-2 rounded-1 d-flex mt-2 h-50'
        
        receiveOrderItemsElement.innerHTML =  `

            <img src="../${item.product_img}" alt="" width="160" height="175" class="rounded-2 border border-1 border-black my-3 mx-3">
            <div class="h6 fw-bold p-3 mt-3 py-1 h-25 w-100 text-end">
                ${item.order_status}
                <div class="h6 text-start mt-3 fw-bold">${item.product_type}</div>
                <div class="h6 mt-2 d-flex">Order Type: 
                    <span class="h6 px-1 fw-bold">${item.order_type}</span>
                </div>
                <div class="h6 mt-4 py-1">
                    x <span class="h6">${item.order_quantity}</span>
                </div>
                <div class="h6 mt-0 py-0 text-danger">
                    Php <span class="h6 text-danger">${totalPrice}</span>
                </div>
            </div>
        `
        //toShipContainer.appendChild(document.createElement('br'));
        container_1.appendChild(receiveOrderItemsElement);
    })

    const totalPriceElement = document.createElement('div');

    overallPrice = overallPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })

    totalPriceElement.className = "container-sm w-70 ms-0 p-2 text-bg-light border border-2 border-black rounded-1 d-flex h-50"

    totalPriceElement.innerHTML = `
        <div class="h6 mt-2 w-50 mx-3 px-0">${receiveOrderItems.length}
            <span class="h6">item/s</span>
        </div>
        <div class="container d-flex justify-content-end mt-2">
            <div class="h6">Order Total: 
                <span class="h6 text-danger">Php</span>
            </div>
            <div class="h6 text-danger px-1">${overallPrice}</div>
        </div>   
     `

     container_2.appendChild(document.createElement('br'))
     container_2.appendChild(totalPriceElement);

     const dateContainerElement = document.createElement('div');

     dateContainerElement.className = "container-sm w-70 ms-0 p-2 d-flex mt-3 h-50 border-bottom border-3 justify-content-between";
     dateContainerElement.innerHTML = `
     
        <div class="h6 mt-2 w-50 mx-2 px-0 text-primary d-flex">
            <div class="bi bi-truck fs-3"></div>
            <div class="h6 px-2 mt-2">${orderStatus}</div>
        </div>
        <div class="py-1 mt-3">
            ${dates[0]}
        </div> 
     
     `
     container_3.appendChild(dateContainerElement);

     const detailContainerElement = document.createElement('div')

     detailContainerElement.className = "container-sm w-70 ms-0 p-2 mt-3 d-flex h-50 justify-content-between"
     detailContainerElement.innerHTML = `
            <div>
                <div class="h6">Receive products and</div>
                <div class="h6">make payment by 
                    <span class="h6 fw-bold">
                        ${dates[0]}
                    </span>
                </div>
            </div>
            <div>
                <button class="btn btn-primary text-light h-100 ${receiveButton}" id="order--receive">Order Received</button>
            </div>

        `
     container_4.appendChild(detailContainerElement);

     // Add event listener only if the button is not disabled
     if (!receiveButton.disabled) {
        document.getElementById('order--receive').addEventListener('click', function () {
            // Add your event handling logic here
            console.log("Order Received button clicked!");

            const date = new Date();

            const completionDate = date.toLocaleDateString();
    
            // Assuming you have the necessary data available, such as orderIds, paymentIds, checkoutId, and userId
            const orderIds = receiveOrderItems.map(item => item.order_id);
            const paymentIds = receiveOrderItems.map(item => item.payment_id);
            const checkoutId = receiveOrderItems.map(item => item.checkout_id); // Assuming checkout_id is the same for all items
            const userId = receiveOrderItems.map(item => item.user_id); // Assuming user_id is the same for all items
    
            console.log("Order IDS: ", orderIds);
            console.log("Payment IDS: ", paymentIds);
            console.log("Checkout IDS: ", checkoutId);
            console.log("User IDS: ", userId);
            
            // Create an object to hold the data
            const updateData = {
                order_ids: orderIds,
                payment_ids: paymentIds,
                checkout_id: checkoutId,
                user_id: userId,
                completion_date: completionDate
                // Add more data as needed
            };
            const updatedDataJSON = JSON.stringify(updateData);
    
            console.log(updatedDataJSON);
    
            const updateStatusURL = "updateOrderStatusCompleted.php";
    
            // Make a fetch request to update the order status
            fetch(updateStatusURL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: updatedDataJSON,
            })
                .then(response => {
                    // Check for network errors
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    // Parse JSON response
                    return response.json();
                })
                .then(updateData => {
                    // Handle the response from the server
                    console.log('Update Order Status response:', updateData);

                    const receiveItems = 'receiveOrderItems.php';

                    fetch(receiveItems)
                        .then(response => response.json())
                        .then(data => {

                            const receiveItems = data.receiveOrderData;

                            const mapReceiveItems = receiveItems.filter(item => item.order_status === 'To receive');
                            //const completedDate = mapReceiveItems.map(date => date.completion_date);
                            const completedData = updateData.updated_orders; 

                            console.log("Completed Items: ", completedData)
                            const icon = 'receive-icon.png';
                            const dispMessage = 'NO RECEIVED ORDERS'
                            const widthAndHeight = 150

                            if (mapReceiveItems.length === 0){
                                container_1.innerHTML = ''
                                container_2.innerHTML = ''
                                container_3.innerHTML = ''
                                container_4.innerHTML = ''
                                displayNoReceivedItems(noOrderContainer, icon, dispMessage, widthAndHeight);
                            }
                            
                            let totalPrice = 0;

                            completedData.forEach(completedItem => {
                                totalPrice += parseFloat(completedItem.total_price);
                                // Make sure to use the correct property name for the total price
                                const itemPrice = parseFloat(completedItem.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                
                                const completedContainerElement = document.createElement('div');
                            
                                completedContainerElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-black border-2 rounded-1 d-flex mt-2 h-50'
    
                                completedContainerElement.innerHTML = `
    
                                    <img src="../${completedItem.product_img}" alt="" width="160" height="175" class="rounded-2 border border-1 border-black my-3 mx-3">
                                    <div class="h6 fw-bold p-3 mt-3 py-1 h-25 w-100 text-end">
                                        ${completedItem.order_status}
                                        <div class="h6 text-start mt-3 fw-bold">${completedItem.product_type}</div>
                                        <div class="h6 mt-2 d-flex">Order Type: 
                                            <span class="h6 px-1 fw-bold">${completedItem.order_type}</span>
                                        </div>
                                        <div class="h6 mt-4 py-1">
                                            x <span class="h6">${completedItem.order_quantity}</span>
                                        </div>
                                        <div class="h6 mt-0 py-0 text-danger">
                                            Php <span class="h6 text-danger">${itemPrice}</span>
                                        </div>
                                    </div>
                                `
                                completedItemsContainer.appendChild(completedContainerElement);
                            })

                            const completedPricesElement = document.createElement('div')

                            const overallPrice = totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })

                            completedPricesElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-2 border-black rounded-1 d-flex h-50'
                            completedPricesElement.innerHTML = `
                            
                                    <div class="h6 mt-2 w-50 mx-3 px-0">${completedData.length}
                                        <span class="h6">item/s</span>
                                    </div>
                                    <div class="container d-flex justify-content-end mt-2">
                                        <div class="h6">Order Total: 
                                            <span class="h6 text-danger">Php</span>
                                        </div>
                                        <div class="h6 text-danger px-1">${overallPrice}</div>
                                    </div> 
                            
                            `
                            completedPricesContainer.appendChild(document.createElement('br'))
                            completedPricesContainer.appendChild(completedPricesElement)

                            const dateCompletedElement = document.createElement('div')

                            dateCompletedElement.className = 'container-sm w-70 ms-0 p-2 d-flex mt-3 h-50 border-bottom border-3 justify-content-between'

                            dateCompletedElement.innerHTML = `
                            
                                    <div class="h6 mt-2 w-50 mx-2 px-0 text-primary d-flex">
                                        <div class="bi bi-truck fs-3"></div>
                                        <div class="h6 px-2 mt-2">Order Completed</div>
                                    </div>
                                    <div class="py-1 mt-3">
                                        ${completedData[0].completion_date}
                                    </div>
                            
                            `
                            dateCompletedContainer.appendChild(dateCompletedElement)

                            const updateQuantityURL = "updateQuantity.php";

                            const updatedQuantityData = JSON.stringify(completedData)

                            console.log("Update quantity data: ", updatedQuantityData);

                            fetch(updateQuantityURL, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: updatedQuantityData,
                            })
                                .then(response => response.json())
                                .then(data => {

                                    const updatedQuantityData = data.updated_quantities;

                                    const updateMessage = data.message;
                                    
                                    console.log("Updated message: ", updateMessage);
                                    console.log("Updated quantity of products: ", updatedQuantityData)
                                    


                                }).catch(error => console.error('Error updating the quantity of the products', error))



                                //Completed Order Containers
                                //const completedItemsContainer = document.getElementById('completedContainer')
                                //const completedPricesContainer = document.getElementById('completedPricesContainer')
                                //const dateCompletedContainer = document.getElementById('dateCompletedContainer')
                                //const completedOrderDisplay = document.getElementById('completedOrderDisplay');
                            
                            

                        }).catch(error => {
                            console.error("Error receiving items: ", error)
                        })
                          

                })
                .catch(error => {
                    console.error('Error updating order status:', error);
                    console.error('An error occurred while updating the order status. Please try again.', error);
                    // Optionally, you can provide more details about the error to the user
                });

        });
    }
    

}

function displayNoReceivedItems(noOrderContainer, icons, displayNoItemsInTransit, widthAndHeight){
    const noReceivedElement = document.createElement('div')

    noReceivedElement.className = "container-fluid w-100 p-2 text-bg-light rounded-1 d-flex mt-0 h-50 justify-content-center"
    noReceivedElement.innerHTML = `
    
        <div class="h4 mt-1 mx-3 px-0 fw-bold text-center">
            <img src="${icons}" alt="" width=${widthAndHeight} height=${widthAndHeight} class="mt-3">
            <div class="py-2 mt-3">${displayNoItemsInTransit}</div>
        </div>  
    `

    //noOrderContainer.appendChild(document.createElement('br'))
    noOrderContainer.appendChild(noReceivedElement)
}

function renderCancelledItems(cancelledItems, cancelledItemsContainer, itemCancelled, dateCancelled){
            
    console.log("Cancelled Items: ", cancelledItems);
    console.log("Cancelled Items Container: ", cancelledItemsContainer);
    console.log("Items Cancelled Container: ", itemCancelled);
    console.log("Date Cancelled Element: ", dateCancelled);

    let overallPrice = 0;

    cancelledItems.forEach(cancelledItem => {
        overallPrice += parseFloat(cancelledItem.total_price)
        const cancelledItemElement = document.createElement('div');

        cancelledItemElement.className = "container-sm w-70 ms-0 p-2 text-bg-light border border-black border-2 rounded-1 d-flex mt-2 h-50";


        cancelledItemElement.innerHTML = `
        
            <img src="../${cancelledItem.product_img}" alt="" width="160" height="175" class="rounded-2 border border-1 border-black my-3 mx-3">
            <div class="h6 fw-bold p-3 mt-3 py-1 h-25 w-100 text-end">
                ${cancelledItem.order_status}
                <div class="h6 text-start mt-3 fw-bold">${cancelledItem.product_type}</div>
                <div class="h6 mt-2 d-flex">Order Type: 
                    <span class="h6 px-1 fw-bold">${cancelledItem.order_type}</span>
                </div>
                <div class="h6 mt-4 py-1">
                    x <span class="h6">${cancelledItem.order_quantity}</span>
                </div>
                <div class="h6 mt-0 py-0 text-danger">
                    Php <span class="h6 text-danger">${parseFloat(cancelledItem.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
                </div>
            </div>
        
        `
        // Append each cancelledItemElement to the container
         cancelledItemsContainer.appendChild(cancelledItemElement);
    })

    const itemCancelledElement = document.createElement('div')

    itemCancelledElement.className = 'container-sm w-70 ms-0 p-2 text-bg-light border border-2 border-black rounded-1 d-flex h-50';

    itemCancelledElement.innerHTML =  `

        <div class="h6 mt-2 w-50 mx-3 px-0">${cancelledItems.length}
            <span class="h6">item/s</span>
        </div>
        <div class="container d-flex justify-content-end mt-2">
            <div class="h6">Order Total: 
                <span class="h6 text-danger">Php</span>
            </div>
            <div class="h6 text-danger px-1">${overallPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
        </div>          
    
    `
    itemCancelled.appendChild(document.createElement('br'))
    itemCancelled.appendChild(itemCancelledElement);


    const dateCancelledElement = document.createElement('div');

    dateCancelledElement.className = 'container-sm w-70 ms-0 p-2 d-flex mt-3 h-50 border-bottom border-3 justify-content-between';

    dateCancelledElement.innerHTML = `
            <div class="h6 mt-2 w-50 mx-2 px-0 text-primary d-flex">
                <div class="bi bi-truck fs-3"></div>
                <div class="h6 px-2 mt-2">Order Cancelled</div>
            </div>

            <div class="py-1 mt-3">
                ${cancelledItems[0].cancel_date}
            </div> 
    `
    dateCancelled.appendChild(dateCancelledElement);
    
}

    

    //Completed Order Containers
const completedItemsContainer = document.getElementById('completedContainer')
const completedPricesContainer = document.getElementById('completedPricesContainer')
const dateCompletedContainer = document.getElementById('dateCompletedContainer')
const completedOrderDisplay = document.getElementById('completedOrderDisplay');

document.addEventListener('DOMContentLoaded', function () {
    
    const receiveCheckoutItemsURL = 'receiveCheckoutItems.php';
    // Get the container elements
    const container = document.getElementById('checkoutItemsContainer');
    const itemsAndPriceContainer = document.getElementById('itemsAndPriceContainer');
    const dateContainer = document.getElementById('dateContainer');
    const noOrderContainer = document.getElementById('noOrderContainer')
    const orderCancellation = document.getElementById('order--cancellation')

    const itemCancelled = document.getElementById('itemsCancelled');
    const dateCancelled = document.getElementById('dateCancelled');
    const cancelledItemsContainer = document.getElementById('cancelledItemsContainer');
    const cancelledOrderDisplay = document.getElementById('cancelledOrderDisplay') 

    const receiveOrdersURL = 'receiveOrderItems.php'

    //In Transit Containers
    const toShipContainer = document.getElementById('toShipContainer');
    const toShipPricesContainer = document.getElementById('toShipPricesContainer')
    const toShipDateContainer = document.getElementById('toShipDateContainer')
    const receiveDetailsContainer = document.getElementById('receiveDetailsContainer')
    const noToShipContainer = document.getElementById('noToShipContainer')

    //To receive containers
    const toReceiveContainer = document.getElementById('toReceiveContainer');
    const toReceivePricesContainer = document.getElementById('toReceivePricesContainer')
    const toReceiveDateContainer = document.getElementById('toReceiveDateContainer')
    const toReceiveInfoContainer = document.getElementById('toReceiveInfoContainer')
    const receivedItemsContainer = document.getElementById('receivedItemContainer')


    // Fetch data from PHP script
    fetch(receiveCheckoutItemsURL)
        .then(response => response.json())
        .then(data => {
            const orders = data.orders;
            const checkoutID = data.checkout_ids;
            let order_ids = [];
            let payment_ids = [];
            let product_ids = [];
            let user_ids = [];

            if (orders) {
                order_ids = orders.map(order => order.order_id);
                payment_ids = orders.map(order => order.payment_id);
                product_ids = orders.map(order => order.product_id);
                user_ids = orders.map(order => order.user_id);
            } else {
                console.log('No pending orders found!');
            }


            console.log('Data received from PHP:', data);
            console.log("Orders: ", orders);
            console.log(typeof(orders));
            console.log("Checkout ID for orders: ", checkoutID);
            console.log("Order ID for checkout: ", order_ids);
            console.log("Payment ID for orders: ", payment_ids);
            console.log("Product ID for orders: ", product_ids);
            console.log("User ID for orders: ", user_ids);

            console.log("Button: ", orderCancellation)

            // Render orders using the function
            renderPendingOrders(orders, container, itemsAndPriceContainer, dateContainer, noOrderContainer, orderCancellation);

            // Check if there are orders before rendering items and price
                orderCancellation.addEventListener('click', () => {
                    // Assuming you have a PHP script to handle cancellation
                    const cancelOrderURL = 'cancelOrder.php'; // Replace with the actual URL

                    const date = new Date();

                    const cancelDate = date.toLocaleDateString();
                    
                    const pendingOrderIds = orders.filter(order => order.order_status === 'Pending').map(order => order.order_id);
                    // Assuming you want to send the checkoutID, order_ids, payment_ids, product_ids, and user_ids to the server
                    console.log("Pending Orders: ", pendingOrderIds);

                    const cancelData = {
                        checkout_id: checkoutID,
                        order_ids: pendingOrderIds,
                        payment_ids: payment_ids,
                        product_ids: product_ids,
                        user_ids: user_ids,
                        cancel_date: cancelDate,
                    };
                    
                    const cancelDataJSON = JSON.stringify(cancelData);

                    console.log("Sending data information to be cancelled: ", cancelDataJSON)
                
                    // Fetch to cancel_order.php with POST method
                    fetch(cancelOrderURL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: cancelDataJSON,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response from the server
                        console.log('Cancellation response:', data);
                
                        // Assuming the cancellation was successful, you may want to update the UI accordingly
                        if (data.success) {
                            console.log(data.msg)

                            const dataJSON = JSON.stringify(data);


                            console.log("TO SEND JSON DATA: ", dataJSON);

                            /*setTimeout(() => {
                                window.location.reload();
                            },1000)*/
                            // Render orders using the function
                            //if()
                            renderOrders(data, container, itemsAndPriceContainer, dateContainer, noOrderContainer, orderCancellation);
                            const cancelledItemsURL = "cancelledItemsDisplay.php";

                            fetch(cancelledItemsURL, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: dataJSON,
                            })
                                .then(response => response.json())
                                .then(cancelledItemsData => {
                                    // Handle the response from cancelledItemsDisplay.php
                                    console.log('Cancelled Items Data:', cancelledItemsData);

                                    // Assuming you have a function to render cancelled items
                                    renderCancelledItems(cancelledItemsData, cancelledItemsContainer, itemCancelled, dateCancelled);
                                })
                                .catch(error => {
                                    console.error('Error fetching cancelled items:', error);
                                    // Handle the error
                                });

                        } else {
                            alert('Failed to cancel order. Please try again.');
                            // Optionally, you can provide more details about the failure to the user
                        }
                    })
                    .catch(error => {
                        console.error('Error cancelling order:', error);
                        alert('An error occurred while cancelling the order. Please try again.');
                        // Optionally, you can provide more details about the error to the user
                    });
                });
        })
        .catch(error => {
            const noOrderElement = document.createElement('div');

            noOrderElement.className = 'container-fluid w-100 p-2 text-bg-light rounded-1 d-flex mt-0 h-50 justify-content-center';

            noOrderElement.innerHTML = `
                <div class="h4 mt-1 mx-3 px-0 fw-bold text-center">
                    <img src="clipboard_x.png" alt="" width=200 height=200>
                    <div>NO PENDING ORDERS FOUND!</div>
                </div> 
            `; 
            orderCancellation.disabled="true"
            noOrderContainer.appendChild(noOrderElement);
            //console.error('Error fetching data from PHP:', error);
        });
    
    fetch(receiveOrdersURL)
        .then(response => response.json())
        .then(data => {
            const receiveOrderItems = data.receiveOrderData;
            console.log("In transit items: ", receiveOrderItems);
            console.log(typeof(receiveOrderItems));
            
            const inTransitItems = receiveOrderItems.filter(item => item.order_status === 'In transit');
            const toReceiveItems = receiveOrderItems.filter(item => item.order_status === 'To receive');
            const completedItems = receiveOrderItems.filter(item => item.order_status === 'Completed');

            // Get transit dates for inTransitItems
            const transitDates = inTransitItems.map(item => item.transit_date);

            // Get receive dates for toReceiveItems
            const receiveDates = toReceiveItems.map(item => item.completion_date);

            console.log("Completed Items: ", completedItems);

            console.log("In transit items: ", inTransitItems);
            console.log("To receive items: ", toReceiveItems);

            const displayNoItemsInTransit = "NO ORDER IN TRANSIT";

            const displayNoReceivedOrders = "NO RECEIVED ORDERS";

            const icons = ["truck-icon.png", "receive-icon.png"]

            const widthAndHeight = [200, 150];

            const enableReceiveButton = "disabled"

            const disabledReceiveButton = ""

            const inTransit = "Item in transit";
            const toReceive = "Item to receive";


            if(inTransitItems.length > 0){
                console.log("Meron pang in transit items");
                displayReceivedOrderItems(inTransitItems, transitDates, toShipContainer, toShipPricesContainer, toShipDateContainer, receiveDetailsContainer, enableReceiveButton, inTransit, noToShipContainer)
                noToShipContainer.innerHTML = "";

            }else{
                console.log("Wala ng laman ang in transit items")
                displayNoReceivedItems(noToShipContainer, icons[0], displayNoItemsInTransit, widthAndHeight[0])
            
            }

            //if to receive Items
            if(toReceiveItems.length > 0){
                console.log("Meron pang to receive items");
                displayReceivedOrderItems(toReceiveItems, receiveDates, toReceiveContainer, toReceivePricesContainer, toReceiveDateContainer, toReceiveInfoContainer, disabledReceiveButton, toReceive, receivedItemsContainer)
                //receivedItemsContainer.innerHTML = "";
            }else{
                console.log("Wala ng laman ang receive items")
                displayNoReceivedItems(receivedItemsContainer, icons[1], displayNoReceivedOrders, widthAndHeight[1]);
            }
        
        }).catch(error => {
            console.error('Error:', error);
        })

    


        
        // Loop through the ordersData and create HTML for each order
        /*orders.forEach(order => {
            totalPrice += parseFloat(order.total_price);
            const orderElement = createOrderElement(order);
            // Append the order element to the container
            
            container.appendChild(orderElement);
            //container.appendChild(document.createElement('br'))
        });*/


        
});

document.addEventListener('DOMContentLoaded', function () {

    const handleOrdersURL = "handleOrders.php";

    // Fetch data from the PHP script
    fetch(handleOrdersURL)
        .then(response => response.json())
        .then(data => {
            // Extract the relevant data arrays
            const allUserData = data.allUserData;

            console.log(allUserData)

            // Get the table body element
            const tableBody = document.getElementById('data-table-body');

            console.log("All User Data: ", allUserData)

            // Check if there is data in objects
            const hasObjectData = Object.keys(allUserData).some(key => Object.keys(allUserData[key]).length > 0);

            // Check if there is data in arrays
            const hasArrayData = Object.keys(allUserData).some(key => Array.isArray(allUserData[key]) && allUserData[key].length > 0);

            // Check if there is no data in both objects and arrays
            if (!hasObjectData && !hasArrayData) {
                // No pending orders found, create a row with a message
                const noOrdersRow = document.createElement('tr');
                noOrdersRow.className = "fw-bold h6 text-center";

                noOrdersRow.innerHTML = `
                    <td colspan="11" class="text-center fs-5">NO ORDERS YET</td>
                `
                tableBody.appendChild(noOrdersRow);
            }else {
                // Iterate through each user
                for (const userId in allUserData) {
                    if (allUserData.hasOwnProperty(userId)) {
                        const userData = allUserData[userId];

                        console.log(userData)

                        // Iterate through each order for the current user
                        userData.forEach(order => {
                            const totalPrice = parseFloat(order.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                            const row = document.createElement('tr');

                            row.className = "fw-bold h6 text-center"

                            let unitPrice = 0;
                            switch (order.order_type) {
                                case 'Refill':
                                    unitPrice = order.product_refill_price;
                                    break;
                                case 'Borrow':
                                    unitPrice = order.product_borrow_price;
                                    break;
                                case 'Buy':
                                    unitPrice = order.product_buy_price;
                                    break;
                                default:
                                    unitPrice = 0;
                            }

                            row.innerHTML = `
                                <td>
                                    ${order.firstname} 
                                    <span>
                                        ${order.lastname}
                                    </span>
                                </td>

                                <td>
                                    ${order.address}
                                </td>

                                <td class="d-flex">
                                    <img src = "../${order.product_img}" alt="" width=80 height=80 class="rounded-2">
                                    <span class="px-2 text-center py-3 mt-3">${order.product_type}</span>
                                </td>

                                <td>
                                    ${order.order_type}
                                </td>
                                
                                <td>
                                    ${order.checkout_date}
                                </td>
                                
                                <td>
                                    ${order.payment_type}
                                </td>
                                
                                <td>
                                    Php ${unitPrice}
                                </td>
                                
                                <td class="">
                                    ${order.order_quantity}
                                </td>
                                
                                <td class="">
                                    Php ${totalPrice}
                                </td>
                                
                                <td>
                                    <select class="form-select mt-4" id="orderStatus_${order.order_id}" onchange="handleOrderStatusChange('${order.order_id}')" data-original-status="${order.order_status}">
                                        <option value="Pending" ${order.order_status === 'Pending' ? 'selected' : ''}>Pending</option>
                                        <option value="In transit" ${order.order_status === 'In transit' ? 'selected' : ''}>In transit</option>
                                        <option value="To receive" ${order.order_status === 'To receive' ? 'selected' : ''}>To receive</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </td>

                                <td>
                                
                                    <button class="btn btn-info btn-md mt-4 update--button" onclick="updateOrderStatus('${order.order_id}', '${order.user_id}')">Update</button>

                                </td>
                            `;

                            tableBody.appendChild(row);

                            // Disable previous selections in the select element
                            //disablePreviousSelections(order.order_id, order.order_status);
                        });
                    }
                }
            }
        })
        .catch(error => console.error('Error fetching data:', error));

        const completedOrdersURL = 'handleCompletedOrders.php'

        fetch(completedOrdersURL)
            .then(response => response.json())
            .then(data => {
                const completedOrderData = data.allUserData
                console.log("Fetched Data: ", completedOrderData);


                const completedTableContainer = document.getElementById('completed-table-container')
                // Check if there is data in objects or arrays
                const hasData = Object.keys(completedOrderData).some(key => {
                    return (
                        (Object.keys(completedOrderData[key]).length > 0) ||
                        (Array.isArray(completedOrderData[key]) && completedOrderData[key].length > 0)
                    );
                });

                // Check if there is no data in both objects and arrays
                if (!hasData) {
                    // No pending orders found, create a row with a message
                    const noCompletedOrdersRow = document.createElement('tr');
                    noCompletedOrdersRow.className = "fw-bold h6 text-center";

                    noCompletedOrdersRow.innerHTML = `
                        <td colspan="10" class="text-center fs-5">NO COMPLETED ORDERS</td>
                    `
                    completedTableContainer.appendChild(noCompletedOrdersRow);
                }else {
                    // Iterate through each user
                    for (const userId in completedOrderData) {
                        if (completedOrderData.hasOwnProperty(userId)) {
                            const userData = completedOrderData[userId];

                            console.log(userData)

                            // Iterate through each order for the current user
                            userData.forEach(order => {
                                const totalPrice = parseFloat(order.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                                const completedRow = document.createElement('tr');

                                completedRow.className = "fw-bold h6 text-center"

                                let unitPrice = 0;
                                switch (order.order_type) {
                                    case 'Refill':
                                        unitPrice = order.product_refill_price;
                                        break;
                                    case 'Borrow':
                                        unitPrice = order.product_borrow_price;
                                        break;
                                    case 'Buy':
                                        unitPrice = order.product_buy_price;
                                        break;
                                    default:
                                        unitPrice = 0;
                                }

                                completedRow.innerHTML = `
                                    <td>
                                        ${order.firstname} 
                                        <span>
                                            ${order.lastname}
                                        </span>
                                    </td>

                                    <td>
                                        ${order.address}
                                    </td>

                                    <td class="d-flex">
                                        <img src = "../${order.product_img}" alt="" width=80 height=80 class="rounded-2">
                                        <span class="px-2 text-center py-3 mt-3">${order.product_type}</span>
                                    </td>

                                    <td>
                                        ${order.order_type}
                                    </td>
                                    
                                    <td>
                                        ${order.completion_date}
                                    </td>
                                    
                                    <td>
                                        ${order.payment_type}
                                    </td>
                                    
                                    <td>
                                        Php ${unitPrice}
                                    </td>
                                    
                                    <td class="">
                                        ${order.order_quantity}
                                    </td>
                                    
                                    <td class="">
                                        Php ${totalPrice}
                                    </td>
                                    
                                    <td>
                                        ${order.order_status}
                                    </td>
                                `;

                                completedTableContainer.appendChild(completedRow);

                                // Disable previous selections in the select element
                                //disablePreviousSelections(order.order_id, order.order_status);
                            });
                        }
                    }
                }
                


            }).catch(error => console.log("Error fetching data: ", error))


            const cancelledURL = 'handleCancelledOrders.php'

            fetch(cancelledURL)
            .then(response => response.json())
            .then(data => {
                const cancelledOrderData = data.allUserData
                console.log("Fetched Data: ", cancelledOrderData);


                const cancelledTableContainer = document.getElementById('cancelled-table-container')
                // Check if there is data in objects or arrays
                const hasData = Object.keys(cancelledOrderData).some(key => {
                    return (
                        (Object.keys(cancelledOrderData[key]).length > 0) ||
                        (Array.isArray(cancelledOrderData[key]) && cancelledOrderData[key].length > 0)
                    );
                });

                // Check if there is no data in both objects and arrays
                if (!hasData) {
                    // No pending orders found, create a row with a message
                    const noCancelledOrdersRow = document.createElement('tr');
                    noCancelledOrdersRow.className = "fw-bold h6 text-center";

                    noCancelledOrdersRow.innerHTML = `
                        <td colspan="10" class="text-center fs-5">NO CANCELLED ORDERS</td>
                    `
                    cancelledTableContainer.appendChild(noCancelledOrdersRow);
                }else {
                    // Iterate through each user
                    for (const userId in cancelledOrderData) {
                        if (cancelledOrderData.hasOwnProperty(userId)) {
                            const userData = cancelledOrderData[userId];

                            console.log(userData)

                            // Iterate through each order for the current user
                            userData.forEach(order => {
                                const totalPrice = parseFloat(order.total_price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                                const cancelledRow = document.createElement('tr');

                                cancelledRow.className = "fw-bold h6 text-center"

                                let unitPrice = 0;
                                switch (order.order_type) {
                                    case 'Refill':
                                        unitPrice = order.product_refill_price;
                                        break;
                                    case 'Borrow':
                                        unitPrice = order.product_borrow_price;
                                        break;
                                    case 'Buy':
                                        unitPrice = order.product_buy_price;
                                        break;
                                    default:
                                        unitPrice = 0;
                                }

                                cancelledRow.innerHTML = `
                                    <td>
                                        ${order.firstname} 
                                        <span>
                                            ${order.lastname}
                                        </span>
                                    </td>

                                    <td>
                                        ${order.address}
                                    </td>

                                    <td class="d-flex">
                                        <img src = "../${order.product_img}" alt="" width=80 height=80 class="rounded-2">
                                        <span class="px-2 text-center py-3 mt-3">${order.product_type}</span>
                                    </td>

                                    <td>
                                        ${order.order_type}
                                    </td>
                                    
                                    <td>
                                        ${order.cancel_date}
                                    </td>
                                    
                                    <td>
                                        ${order.payment_type}
                                    </td>
                                    
                                    <td>
                                        Php ${unitPrice}
                                    </td>
                                    
                                    <td class="">
                                        ${order.order_quantity}
                                    </td>
                                    
                                    <td class="">
                                        Php ${totalPrice}
                                    </td>
                                    
                                    <td>
                                        ${order.order_status}
                                    </td>
                                `;

                                cancelledTableContainer.appendChild(cancelledRow);

                                // Disable previous selections in the select element
                                //disablePreviousSelections(order.order_id, order.order_status);
                            });
                        }
                    }
                }
                


            }).catch(error => console.log("Error fetching data: ", error))
                
});

function handleOrderStatusChange(orderId) {
    const selectElements = document.querySelectorAll(`select[id^="orderStatus_${orderId}"]`);
    
    selectElements.forEach(selectElement => {
        const updateButton = selectElement.closest('tr').querySelector('.update--button');

        // I-check kung ang orihinal na order status ay pareho sa bagong napiling order status
        const originalStatus = selectElement.getAttribute('data-original-status');
        const selectedStatus = selectElement.value;

        // I-disable o i-enable ang button base sa kung nagbago o hindi
        updateButton.disabled = (originalStatus === selectedStatus);
    });
}



// Function to handle the update button click
function updateOrderStatus(orderId, userId) {
    const selectElement = document.getElementById(`orderStatus_${orderId}`);
    const selectedStatus = selectElement.value;

    const date = new Date();
    const updateOrderStatusURL = 'updateOrderStatus.php'

    console.log("Order Statuses: ", selectedStatus)
    console.log("User IDs: ", userId);
    console.log("Order IDs: ", orderId)

    const transitDate = date.toLocaleDateString('en-US');
    const completionDate = date.toLocaleDateString('en-US');

    console.log("Transit Date: ", transitDate)

    if(selectedStatus === 'In transit'){
        updateFunction(updateOrderStatusURL, orderId, userId, selectedStatus, transitDate)
    }else if(selectedStatus === 'To receive'){
        updateFunction(updateOrderStatusURL, orderId, userId, selectedStatus, completionDate)
    }else if(selectedStatus === 'Pending'){
        alert("Items pending!")
    }

}

function updateFunction(updateURL, orderId, userId, orderStatus, date_status){
    // Send an update request to the server with the selected order status and order ID
    console.log(date_status)
    console.log(orderStatus)
    fetch(updateURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            update_status_date: date_status,
            user_id: userId,
            order_id: orderId,
            order_status: orderStatus,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update successful, you can add any additional logic here
            console.log('Order status updated successfully');

            setTimeout(() => {
                window.location.reload();
            },0)

        } else {
            // Handle the case where the update failed
            console.error('Failed to update order status:', data.error);
        }
    })
    .catch(error => console.error('Error updating order status:', error));
}

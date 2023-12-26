$(function () {
    $('#weekly_monthly_picker_1').datetimepicker({
        locale: 'en',
        format: 'MM/DD/YYYY', // This format represents month/day/year   
    });
});

$(function () {
    $('#weekly_monthly_picker_2').datetimepicker({
        locale: 'en',
        format: 'MM/DD/YYYY', // This format represents month/day/year   
    });
});

$(function () {
    $('#daily_picker_1').datetimepicker({
        locale: 'en',
        format: 'MM/DD/YYYY', // This format represents month/day/year   
    });
});

document.addEventListener('DOMContentLoaded', function(){
    const closeSalesModal = document.querySelectorAll('.close-sales-modal')
    const weekly_monthly_datepicker_1 = document.getElementById('weekly_monthly_datepicker_1')
    const weekly_monthly_datepicker_2 = document.getElementById('weekly_monthly_datepicker_2')
    const dailyDatePicker = document.getElementById('daily_datepicker_1')
    // Add an event listener to the print button
    const printButton = document.querySelector('.print-sale-report');

    const dailyForm = document.getElementById('daily-form')

    const weeklMonthlyForm = document.getElementById('weekly-monthly-form')

    const submitSaleDate = document.getElementById('dateOfSale')



    closeSalesModal.forEach(button => {
        button.addEventListener('click', function(){
            weekly_monthly_datepicker_1.value = ''
            weekly_monthly_datepicker_2.value = ''
            dailyDatePicker.value = ''
        })
    })

    const dateSelector = document.getElementById('dateSelector')
    const dailyGroup = document.getElementById('dailyGroup')
    const weeklyMonthlyGroup = document.getElementById('weeklyMonthlyGroup')

    if(!dateSelector.selectedIndex){
        dailyGroup.classList.remove('d-none')
    }

    dateSelector.addEventListener('change', function(){
        
        if (dateSelector.value === "Daily") {
            dailyGroup.classList.remove('d-none')
            weeklyMonthlyGroup.classList.add('d-none')

        } else {
            weeklyMonthlyGroup.classList.remove('d-none')
            dailyGroup.classList.add('d-none')
        }
    })
    const salesContainer = document.getElementById('sales-container');

    submitSaleDate.addEventListener('click', function(){

        console.log(dailyDatePicker.value);

        if(dateSelector.value === 'Daily'){
            
            const dailyFormData = new FormData(dailyForm)

            const dailyFormOptions = {
                method: 'POST',
                body: dailyFormData
            }

            console.log("Daily Form Options: ", dailyFormOptions)

            const getDailySalesURL = 'getDailySales.php'

            fetchSalesReportData(getDailySalesURL, dailyFormOptions)

        }else if(dateSelector.value === 'WeeklyMonthly'){

            console.log(weekly_monthly_datepicker_1.value)
            console.log(weekly_monthly_datepicker_2.value)
            
            const weeklyMonthlyFormData = new FormData(weeklMonthlyForm)

            const weeklyMonthlyFormOptions = {
                method: 'POST',
                body: weeklyMonthlyFormData
            }
            const getWeeklyMonthlySalesURL = 'getWeeklyMonthlySales.php'
            
            console.log("Weekly and Monthly Form Options: ", weeklyMonthlyFormOptions)
            
            fetchSalesReportData(getWeeklyMonthlySalesURL, weeklyMonthlyFormOptions)
        }
    
    })

    function fetchSalesReportData(salesURL, formOptions){
        fetch(salesURL, formOptions)
                .then(response => response.json())
                .then(data => {

                    console.log(data)

                    if (data.error && data.error.message) {
                        // Display error message
                        alert(data.error.message);
                        printButton.classList.add('disabled');
                        
                    } else if (data.success && data.success.message) {
                        // Display success message
                        alert(data.success.message);

                        salesContainer.innerHTML = '';

                        let successData = data.success_data;

                        let overallPrice = 0;

                        let totalQuantity = 0;

                        let totalPrice = 0.00;

                        console.log(successData)

                        if(successData.length > 0){
                            printButton.classList.remove('disabled');
                            // Iterate through the successData array and create HTML rows
                            successData.forEach((row) => {
    
                                totalPrice = parseFloat(row.total_price)
    
                                overallPrice += parseFloat(row.total_price)

                                totalQuantity += parseInt(row.order_quantity)
    
                                totalPrice = totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })
    
                                const salesElement = document.createElement('tr');
                                
                                salesElement.className = 'fs-6 text-center'
    
                                salesElement.innerHTML = `
                                
                                    <td>
                                        ${row.product_name}
                                    </td>
    
                                    <td>
                                        ${row.sale_date}
                                    </td>

                                    <td>
                                        ${row.order_id}
                                    </td>

                                    <td>
                                        ${row.order_status}
                                    </td>

                                    <td>
                                        ${row.order_type}
                                    </td>

                                    <td>
                                        ${row.payment_method}
                                    </td>
    
                                    <td>
                                        Php ${totalPrice}
                                    </td>

                                    <td>
                                        ${row.order_quantity}
                                    </td>
                                    
                                    
                                
                                `
                                // Append the row to the tbody
                                salesContainer.appendChild(salesElement);
                            });

                            overallPrice = overallPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })

                            const totalElement = document.createElement('tr')

                            totalElement.className = 'fw-bold fs-5 text-center'
                            totalElement.innerHTML = `
                            
                                <td colspan='6' class='text-start'>TOTAL</td>
                                <td class='text-center'>Php ${overallPrice}</td>
                                <td class='text-center'>${totalQuantity}</td>
                            
                            `
                            salesContainer.appendChild(totalElement);

                        }

                    }else{
                        alert(data.noResults.noresults)

                        printButton.classList.add('disabled');
                        salesContainer.innerHTML = ''
                        let noResultsMessage = data.noResults.noresults;

                        // Convert the message to uppercase
                        noResultsMessage = noResultsMessage.toUpperCase();
                        
                        const noSalesRowElement = document.createElement('tr')

                        noSalesRowElement.className = 'fw-bold fs-5'

                        noSalesRowElement.innerHTML = `

                            <td colspan='8' class='text-center'>${noResultsMessage}</td>
                        
                        `

                        salesContainer.appendChild(noSalesRowElement)
                    }

        }).catch(error => console.error("Error fetching data: ", error))
    
    }
    // Function to print the sales report
    function printSalesReport() {
        // Reference to the sales table container
        const salesContainer = document.getElementById('sales-container');

        // Check if there is content in the sales table
        if (salesContainer.innerHTML.trim() !== '') {
            // Open the print dialog for the current window
            window.print();
        } else {
            // If no data in the sales table, show an alert
            alert('No data to print!');
        }
    }

    printButton.addEventListener('click', printSalesReport);



})

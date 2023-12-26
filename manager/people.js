const customerProfileImage = document.getElementById('customer-file-upload');
const employeeProfileImage = document.getElementById('employee-file-upload');

const customerImageView = document.getElementById('customerImageView');
const employeeImageView = document.getElementById('employeeImageView'); //


const editCustomerImageView = document.getElementById('editCustomerImageView');
const editEmployeeImageView = document.getElementById('editEmployeeImageView');

const editCustomerProfileImage = document.getElementById('edit-customer-file-upload')
const editEmployeeProfileImage = document.getElementById('edit-employee-file-upload');

const passwordToggle = document.querySelectorAll('.passwordToggle');

//Contact Number Handling
function handleContactNumberInput(input) {
    const placeholder = "(e.g. 09999999999)";
    const prefix = "09";
    
    if (input.value === "") {
        input.placeholder = placeholder; // Display the placeholder
    } else {
        input.placeholder = ""; // Remove the placeholder
        if (!input.value.startsWith(prefix)) {
        input.value = prefix + input.value; // Prepend "09" to the input value
        }
    }
}



document.addEventListener("DOMContentLoaded",function (){

    
const customer_first_name = document.getElementById('customer-fname');
const customer_last_name = document.getElementById('customer-lname');
const customer_home_address = document.getElementById('customer-home-address');
const customer_contact_number = document.getElementById('customer-contact-number');
const customer_username = document.getElementById('customer-username');
const customer_password = document.getElementById('customer-password');

const employee_first_name = document.getElementById('employee-fname');
const employee_last_name = document.getElementById('employee-lname');
const employee_home_address = document.getElementById('employee-home-address');
const employee_contact_number = document.getElementById('employee-contact-number');
const employee_username = document.getElementById('employee-username');
const employee_password = document.getElementById('employee-password');


const closeCustomerModal = document.querySelectorAll('.close-customer-modal')
const closeEmployeeModal = document.querySelectorAll('.close-employee-modal');


//EDIT CUSTOMER PROFILE VARIABLES

const edit_customer_first_name = document.getElementById('edit-customer-fname');
const edit_customer_last_name = document.getElementById('edit-customer-lname');
const edit_customer_home_address = document.getElementById('edit-customer-home-address');
const edit_customer_contact_number = document.getElementById('edit-customer-contact-number');
const edit_customer_username = document.getElementById('edit-customer-username');
const edit_customer_password = document.getElementById('edit-customer-password');

const edit_employee_first_name = document.getElementById('edit-employee-fname');
const edit_employee_last_name = document.getElementById('edit-employee-lname');
const edit_employee_home_address = document.getElementById('edit-employee-home-address');
const edit_employee_contact_number = document.getElementById('edit-employee-contact-number');
const edit_employee_username = document.getElementById('edit-employee-username');
const edit_employee_password = document.getElementById('edit-employee-password');


const closeCustomerEditModal = document.querySelectorAll('.close-customer-edit-modal')
const closeEmployeeEditModal = document.querySelectorAll('.close-employee-edit-modal');

function togglePasswordVisibility(input) {
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}

passwordToggle.forEach(pass => {
    pass.addEventListener('click', function () {
        //for editing
        togglePasswordVisibility(edit_customer_password);
        togglePasswordVisibility(edit_employee_password);

        //for inserting
        togglePasswordVisibility(customer_password);
        togglePasswordVisibility(employee_password);

        pass.classList.toggle('clicked');
    });
});
    
customerProfileImage.addEventListener('change', handleCustomerFileSelect);

employeeProfileImage.addEventListener('change', handleEmployeeFileSelect);

editCustomerProfileImage.addEventListener('change', handleCustomerEditFile);

editEmployeeProfileImage.addEventListener('change', handleEmployeeEditFile);

    // Handle file selection
    function handleEmployeeEditFile(event) {
        const selectedFile = event.target.files[0];

        // Display the selected image in the preview
        const reader = new FileReader();

        reader.onload = function () {
            editEmployeeImageView.src = reader.result;
            //imageDataURL = reader.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    // Handle file selection
    function handleCustomerEditFile(event) {
        const selectedFile = event.target.files[0];

        // Display the selected image in the preview
        const reader = new FileReader();

        reader.onload = function () {
            editCustomerImageView.src = reader.result;
            //imageDataURL = reader.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    // Handle file selection
    function handleCustomerFileSelect(event) {
        const selectedFile = event.target.files[0];

        // Display the selected image in the preview
        const reader = new FileReader();

        reader.onload = function () {
            customerImageView.src = reader.result;
            //imageDataURL = reader.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    // Handle file selection
    function handleEmployeeFileSelect(event) {
        const selectedFile = event.target.files[0];

        // Display the selected image in the preview
        const reader = new FileReader();

        reader.onload = function () {
            employeeImageView.src = reader.result;
            //imageDataURL = reader.result;
        };

        reader.readAsDataURL(selectedFile);
    }

    const customer_form = document.getElementById('customer-form');
    const employee_form = document.getElementById('employee-form');

    const edit_customer_form = document.getElementById('customer-edit-form');
    const edit_employee_form = document.getElementById('employee-edit-form');

    const editSaveCustomerDetails = document.getElementById('save-edit-customer')
    const editSaveEmployeeDetails = document.getElementById('save-edit-employee')

    const saveCustomerDetails = document.getElementById('save-customer')
    const saveEmployeeDetails = document.getElementById('save-employee')

    const addCustomerURL = 'addCustomer.php';
    const addEmployeeURL = 'addEmployee.php';

    const editCustomerURL = 'updateCustomerProfile.php'
    const editEmployeeURL = 'updateEmployeeProfile.php'


    const customer_edit_id = document.getElementById('customer-id')
    const employee_edit_id = document.getElementById('employee-id')

    const customerImagePath = document.getElementById('customer-image-path')
    const employeeImagePath = document.getElementById('employee-image-path')

    editSaveCustomerDetails.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission

        console.log("Hello")

        // Create a new FormData object
        const customerFormData = new FormData(edit_customer_form);

        console.log(customerFormData)

        // Fetch options
        const options = {
            method: 'POST',
            body: customerFormData,
        };

        console.log(options)

        // Make the fetch request
        fetch(editCustomerURL, options)
            .then(response => response.json())
            .then(data => {

                if(data.errors){
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.errors);
                    /*edit_customer_first_name.value = ''
                    edit_customer_last_name.value = ''
                    edit_customer_home_address.value = ''
                    edit_customer_contact_number.value = ''
                    edit_customer_username.value = ''
                    edit_customer_password.value = ''
                    editCustomerImageView.src = ''
                    customer_edit_id.value = ''*/
                }else{
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.message);
                    /*edit_customer_first_name.value = ''
                    edit_customer_last_name.value = ''
                    edit_customer_home_address.value = ''
                    edit_customer_contact_number.value = ''
                    edit_customer_username.value = ''
                    edit_customer_password.value = ''
                    editCustomerImageView.src = ''
                    customer_edit_id.value = ''*/
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    editSaveEmployeeDetails.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission

        console.log("Hello")

        // Create a new FormData object
        const customerFormData = new FormData(edit_employee_form);

        console.log(customerFormData)

        // Fetch options
        const options = {
            method: 'POST',
            body: customerFormData,
        };

        console.log(options)

        // Make the fetch request
        fetch(editEmployeeURL, options)
            .then(response => response.json())
            .then(data => {

                if(data.errors){
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.errors);
                    /*edit_customer_first_name.value = ''
                    edit_customer_last_name.value = ''
                    edit_customer_home_address.value = ''
                    edit_customer_contact_number.value = ''
                    edit_customer_username.value = ''
                    edit_customer_password.value = ''
                    editCustomerImageView.src = ''
                    customer_edit_id.value = ''*/
                }else{
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.message);
                    /*edit_customer_first_name.value = ''
                    edit_customer_last_name.value = ''
                    edit_customer_home_address.value = ''
                    edit_customer_contact_number.value = ''
                    edit_customer_username.value = ''
                    edit_customer_password.value = ''
                    editCustomerImageView.src = ''
                    customer_edit_id.value = ''*/
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    saveCustomerDetails.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission

        console.log("Hello")

        // Create a new FormData object
        const customerFormData = new FormData(customer_form);

        console.log(customerFormData)

        // Fetch options
        const options = {
            method: 'POST',
            body: customerFormData,
        };

        console.log(options)

        // Make the fetch request
        fetch(addCustomerURL, options)
            .then(response => response.json())
            .then(data => {

                if(data.errors){
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.errors);
                    customer_first_name.value = ''
                    customer_last_name.value = ''
                    customer_home_address.value = ''
                    customer_contact_number.value = ''
                    customer_username.value = ''
                    customer_password.value = ''
                    customerImageView.src = ''
                }else{
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.message);
                    customer_first_name.value = ''
                    customer_last_name.value = ''
                    customer_home_address.value = ''
                    customer_contact_number.value = ''
                    customer_username.value = ''
                    customer_password.value = ''
                    customerImageView.src = ''
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    saveEmployeeDetails.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a new FormData object
        const employeeFormData = new FormData(employee_form);

        console.log(employeeFormData)

        // Fetch options
        const options = {
            method: 'POST',
            body: employeeFormData,
        };

        console.log(options)

        // Make the fetch request
        fetch(addEmployeeURL, options)
            .then(response => response.json())
            .then(data => {

                if(data.errors){
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.errors);
                    employee_first_name.value = ''
                    employee_last_name.value = ''
                    employee_home_address.value = ''
                    employee_contact_number.value = ''
                    employee_username.value = ''
                    employee_password.value = ''
                    employeeImageView.src = ''
                }else{
                    // Handle the response data
                    console.log('Response:', data);
                    alert(data.message);
                    employee_first_name.value = ''
                    employee_last_name.value = ''
                    employee_home_address.value = ''
                    employee_contact_number.value = ''
                    employee_username.value = ''
                    employee_password.value = ''
                    employeeImageView.src = ''
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    closeCustomerModal.forEach(closeCustomerButton => {

        closeCustomerButton.addEventListener('click', () => {
            customer_first_name.value = ''
            customer_last_name.value = ''
            customer_home_address.value = ''
            customer_contact_number.value = ''
            customer_username.value = ''
            customer_password.value = ''
            customerImageView.src = ''

            reloadTimeout();
        })

    })

    closeEmployeeModal.forEach(closeEmployeeButton => {

        closeEmployeeButton.addEventListener('click', () => {
            employee_first_name.value = ''
            employee_last_name.value = ''
            employee_home_address.value = ''
            employee_contact_number.value = ''
            employee_username.value = ''
            employee_password.value = ''
            employeeImageView.src = ''  

            reloadTimeout();
        })

    })

    closeCustomerEditModal.forEach(closeCustomerButton => {

        closeCustomerButton.addEventListener('click', () => {
            edit_customer_first_name.value = ''
            edit_customer_last_name.value = ''
            edit_customer_home_address.value = ''
            edit_customer_contact_number.value = ''
            edit_customer_username.value = ''
            edit_customer_password.value = ''
            editCustomerImageView.src = ''
            customer_edit_id.value = ''

            reloadTimeout();
        })

    })

    closeEmployeeEditModal.forEach(closeEmployeeButton => {

        closeEmployeeButton.addEventListener('click', () => {
            edit_employee_first_name.value = ''
            edit_employee_last_name.value = ''
            edit_employee_home_address.value = ''
            edit_employee_contact_number.value = ''
            edit_employee_username.value = ''
            edit_employee_password.value = ''
            editEmployeeImageView.src = ''
            employee_edit_id.value = ''  

            reloadTimeout();
        })

    })

    // Select all delete buttons with a specific class (adjust the class accordingly)
    const deleteCustomerButtons = document.querySelectorAll('.delete-customer-button');
    const deleteEmployeeButtons = document.querySelectorAll('.delete-employee-button');

    // Iterate over each delete button and attach a click event listener
    deleteCustomerButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Retrieve customer ID and customer name from data attributes
            const customerId = this.getAttribute('data-customer-id');
            const customerName = this.getAttribute('data-customer-name');

            // Show a confirmation dialog with customer information
            const confirmDelete = confirm("Are you sure you want to delete customer: " + customerName + "?");
            const deleteCustomerDataURL = 'deleteCustomerData.php';

            // If the user confirms deletion, proceed with the deletion logic
            if (confirmDelete) {
                // Call the function to perform the deletion
                performDeleteRequest(customerId, deleteCustomerDataURL);
            }
        });
    });

    // Iterate over each delete button and attach a click event listener
    deleteEmployeeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Retrieve customer ID and customer name from data attributes
            const employeeId = this.getAttribute('data-employee-id');
            const employeeName = this.getAttribute('data-employee-name');

            // Show a confirmation dialog with customer information
            const confirmDelete = confirm("Are you sure you want to delete customer: " + employeeName + "?");
            const deleteEmployeeDataURL = 'deleteEmployeeData.php';

            // If the user confirms deletion, proceed with the deletion logic
            if (confirmDelete) {
                // Call the function to perform the deletion
                performDeleteRequest(employeeId, deleteEmployeeDataURL);
            }
        });
    });



    function performDeleteRequest(userId, deleteUserDataURL) {
        // Replace the following lines with your actual URL and headers if needed
        const url = `${deleteUserDataURL}?userId=` + userId;
    
        // Using the Fetch API for deletion
        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json', // adjust headers if needed
                // Additional headers if needed
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the response from the server
            alert(data.message);
            // Reload the page or update the UI as needed
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
    


    function reloadTimeout(){
        setTimeout(() => {
            window.location.reload();
        },0)
    }


    const editCustomerDetailsButtons = document.querySelectorAll('.edit-customer-button')
    const editEmployeeDetailsButtons = document.querySelectorAll('.edit-employee-button')

    editCustomerDetailsButtons.forEach(buttons => {
        buttons.addEventListener('click', function(){

            console.log("working");
            const customer_id = this.getAttribute('data-customer-id');
            const customer_fname =  this.getAttribute('data-customer-fname');
            const customer_lname =  this.getAttribute('data-customer-lname');
            const customer_image =  this.getAttribute('data-customer-image');
            const customer_address = this.getAttribute('data-customer-address');
            const customer_contact =  this.getAttribute('data-customer-contact-number');
            const cust_username =  this.getAttribute('data-customer-username');
            const cust_password = this.getAttribute('data-customer-password');
            const customerImageFile = this.getAttribute('data-customer-image-path');

            console.log(customer_id);

            edit_customer_first_name.value = customer_fname;
            edit_customer_last_name.value = customer_lname;
            editCustomerImageView.src = customer_image;
            edit_customer_home_address.value = customer_address;
            edit_customer_contact_number.value = customer_contact;
            edit_customer_username.value = cust_username;
            customer_edit_id.value = customer_id;
            edit_customer_password.value = cust_password;
            customerImagePath.value = customerImageFile;

            console.log(edit_customer_form)

        })
    })

    editEmployeeDetailsButtons.forEach(buttons => {
        buttons.addEventListener('click', function(){

            console.log("working");
            const employee_id = this.getAttribute('data-employee-id');
            const employee_fname =  this.getAttribute('data-employee-fname');
            const employee_lname =  this.getAttribute('data-employee-lname');
            const employee_image =  this.getAttribute('data-employee-image');
            const employee_address = this.getAttribute('data-employee-address');
            const employee_contact =  this.getAttribute('data-employee-contact-number');
            const emp_username =  this.getAttribute('data-employee-username');
            const emp_password = this.getAttribute('data-employee-password');
            const employeeImageFile = this.getAttribute('data-employee-image-path')

            console.log(employee_id);

            edit_employee_first_name.value = employee_fname;
            edit_employee_last_name.value = employee_lname;
            editEmployeeImageView.src = employee_image;
            edit_employee_home_address.value = employee_address;
            edit_employee_contact_number.value = employee_contact;
            edit_employee_username.value = emp_username;
            employee_edit_id.value = employee_id;
            edit_employee_password.value = emp_password;
            employeeImagePath.value = employeeImageFile;
            

            console.log(edit_employee_form)

        })
    })
    
})




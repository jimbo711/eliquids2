/*

    # Called on submission of the 'new order' form, 
    the validateOrder function checks for valid user inputs and cancels 
    submission if it finds errors.

*/
// Error Message
var errors = "";

// Validate New Order Field on Submit
function validateOrder() {
    
    //    Check Name    //
    var name = document.getElementById('name').value;
    if (name = "" || name.length < 2) {
        errors += "Invalid Name.\n";
    }

    //    Check Username    //
    var username = document.getElementById('username').value;
    if (username = "" || username.length < 2) {
        errors += "Invalid Username.\n";
    }

    //    Check Size    //
    var size = "";
    var sizebtn = document.getElementsByName('size');
    // Loop through elements named 'size'
    for(var i = 0; i < sizebtn.length; i++){
        if(sizebtn[i].checked){
            // if a button is checked, assign it's value to $size
            size = sizebtn[i].value;
        }
    }
    if (size==0 || size=="" || isNaN(size)) {
        errors += "Size not selected.\n";
    }

    //    Check Qty    //
    var orderQty = document.getElementById('orderQty').value;
    if (orderQty = "" || orderQty.length < 1 || order.Qty < 1 || isNaN(orderQty)) {
        errors += "Invalid Quantity.\n";
    }


    // Check for errors
    if (errors !== "") {
        // Display error message
        errors = "Error:\n" + errors;
        alert(errors);
        // Return false to cancel the form submission.
        errors = ""; // reset errors
        return false;
    } else {
        // Return true and submit the form.
        return true;
    }
}
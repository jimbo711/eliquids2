/*

    # Called on submission of the 'new order' form, 
    the validateOrder function checks for valid user inputs and cancels 
    submission if it finds errors.

*/
/*
    validateDelRow()
        validate delete row form on submit
*/
function validateDelRow() {
    //  New Error Msg
    var errors = "";
    //  Check row id 
    var row = document.getElementById('delrowid').value;
    if (row == "" || isNaN(row) || row < 0) {
        errors += "Invalid Row ID.\n";
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
/*  
    validateAddFlv()
        Validate 'Add Flavour' form on submit
*/
function validateAddFlv() {
    //  New Error Msg
    var errors = "";
    //  Check flavour name 
    var name = document.getElementById('addFlavourName').value;
    if (name == "" || typeof name !== "string" || name.length < 3) {
        errors += "Invalid Flavour Name.\n";
    }
    //  Check quantity
    var qty = document.getElementById('addFlavourQty').value;
    if (qty == "" || isNaN(qty) || qty > 2000) {
        errors += "Invalid Quantity";
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

// Validate New Order form on submit
function validateOrder() {
    
    //    New Error Msg     //
    var errors = "";

    //    Check Name    //
    var name = document.getElementById('name').value;
    if (name == "" || name.length < 2) {
        errors += "Invalid Name.\n";
    }

    //    Check Username    //
    var username = document.getElementById('username').value;
    if (username == "" || username.length < 2) {
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
    if (orderQty == "" || orderQty.length < 1 || orderQty < 1 || isNaN(orderQty)) {
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
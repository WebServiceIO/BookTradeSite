function validateForm() {

   // Regular expression requring a non-empty something@something.edu
   var patt1 = /^.+@.+\.edu$/i;

   // Regular expression requiring at least 8 characters with at least one
   // letter (upper and lower), one symbol, and one number
   var patt2 = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,15}$/;

   // reads from the "email" field and checks against regex patt1
   var x = document.forms["registration"]["email"].value;
   if (patt1.test(x) == false) {
      alert("Invalid E-mail!");
      return false;
   }

   // reads from the "password" field and checks agaianst regex patt2
   var x = document.forms["registration"]["password"].value;
   if (patt2.test(x) == false) {
      alert("Invalid password! \nPasswords must be between 8 and 15 characters long" +
          " and must include at least one number, one uppercase letter, one" +
           " lowercase letter, and one symbol!");
      return false;
   }

   // Checks to make sure the password was entered the same both times
   var y = document.forms["registration"]["password_conf"].value;
   if (x != y) {
      alert("Passwords do not match. Please check again.");
      return false;
   }
}

function validateForm() {

   // Regular expression requring a non-empty something@something.edu
   var patt1 = /^.+@.+\.edu$/i;

   // Regular expression requiring at least 8 characters with at least one
   // letter and one number
   var patt2 = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/i

   // reads from the "email" field and checks against regex patt1
   var x = document.forms["registration"]["email"].value;
   if (patt1.test(x) == false) {
      alert("Invalid E-mail!");
      return false;
   }

   // reads from the "password" field and checks agaianst regex patt2
   var x = document.forms["registration"]["password"].value;
   if (patt2.test(x) == false) {
      alert("Invalid password! \nPasswords must be at least 8 characters long" +
          " and must include at least one number and one letter");
      return false;
   }

   // Checks to make sure the password was entered the same both times
   var y = document.forms["registration"]["password_conf"].value;
   if (x != y) {
      alert("Passwords do not match. Please check again.");
      return false;
   }
}

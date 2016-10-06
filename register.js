function validateForm() {
   // Regular expression requring a non-empty something@something.edu
   var patt1 = /^.+@.+\.edu$/i;

   var patt2 = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/i

   // reads from the "email" field and checks against regex patt1
   var x = document.forms["register"]["email"].value;
   if (patt1.test(x) == false) {
      alert("Invalid E-mail!");
      return false;
   }

   var x = document.forms["register"]["password"].value;
   if (patt2.test(x) == false) {
      alert("Invalid password! \nPasswords must be at least 8 characters long" +
               " and must include at least one number and one letter");
      return false;
   }
}

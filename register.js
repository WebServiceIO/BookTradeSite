function validateForm() {
   // Regular expression requring a non-empty something@something.edu
   var patt1 = /^.+@.+\.edu$/i;

   // reads from the "email" field and checks against regex patt1
   var x = document.forms["register"]["email"].value;
   if (patt1.test(x) == false) {
      alert("Invalid E-mail!");
      return false;
   }
}

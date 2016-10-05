function validateForm() {
   var patt = new RegExp("@cpp.edu");
   var x = document.forms["register"]["email"].value;
   if (x == null || x == "" || patt.test(x) == false) {
      alert("Invalid E-mail!");
      return false;
   }
   x = document.forms["register"]["username"].value;
   if (x == null || x == "") {
      alert("User name must not be empty.");
      return false;
   }
   x = document.forms["register"]["password"].value;
   if (x == null || x == "") {
      alert("Password must not be empty.");
      return false;
   }
   x = document.forms["register"]["first_name"].value;
   if (x == null || x == "") {
      alert("First name must not be empty.");
      return false;
   }
   x = document.forms["register"]["last_name"].value;
   if (x == null || x == "") {
   alert("Last name must not be empty.");
   return false;
   }
}

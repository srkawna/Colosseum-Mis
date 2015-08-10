function isNumberKey(evt)
      {
          var charCode = (evt.which) ? evt.which : event.keyCode
        // alert(evt.which)
         if (charCode >47&&charCode<58)
            return true;
         else
            return false;
      }
	     function isEmailid(evt) {
             var charCode = (evt.which) ? evt.which : event.keyCode
             //alert(evt.which+"  "+event.keyCode)

             if (charCode > 64 && charCode < 91 || charCode > 96 && charCode < 123 || charCode == 46 || charCode == 95 || charCode == 64 || charCode > 47 && charCode < 58)
                 return true;
             else
                 return false;
         }
		   function isAlphabet(evt)
         {
             var charCode = (evt.which) ? evt.which : event.keyCode
             //alert(evt.which+"  "+event.keyCode)

             if (charCode > 64 && charCode < 91 || charCode > 96 && charCode < 123 || charCode==32)
                return true;
             else
                return false;
         }



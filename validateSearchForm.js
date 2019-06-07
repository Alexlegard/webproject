/*
Got this code from

https://www.sitepoint.com/community/t/prevent-submitting-empty-form/4286/2

Answered by DidUSayScript on October 2008.
*/

window.onload = function(){
	function ValidateSearchForm(){
		
		//If city field is empty
		if(document.getElementById("search__city").value == ""){
			alert("City is required.");
			return false;
		} else {
			return true;
		}
	}
}
'use strict';

// Call this function when the page loads (the "ready" event)
$(document).ready(function() {
	initializePage();
})

/*
 * Function that is called when the document is ready.
 */
function initializePage() {
	$("#testjs").click(function(e) {
		$('.jumbotron h1').text("Javascript is connected");
		$("#testjs").text("Please wait...");
		$(".jumbotron p").toggleClass("active");
	});

	// Add any additional listeners here
	// example: $("#div-id").click(functionToCall);
	$("a.thumbnail").click(projectClick);
	$("#submitBtn").click(submitClick);
}

function projectClick(e) {
	e.preventDefault();

	var projectTitle = $(this).find("p").text();
	var jumbotronHeader = $(".jumbotron h1");
	jumbotronHeader.text(projectTitle);
	//$(this).css("background-color","#7fff00");

    var containingProject = $(this).closest(".project");
    var description = $(containingProject).find(".project-description");
    if (description.length == 0) {
       $(containingProject).append("<div class='project-description'><p>Description of the project.</p></div>");
    } else {
       description.html("<p>Stop clicking on me! You just did it at " + (new Date()) + "</p>");
    }
    $(".project-description").toggle();
    $(".img").toggle();
}

function submitClick(e) {
	var projectName = $("#project").val();
	$(projectName).animate({
		width: $("#width").val()
	});

	var newText = $('#description').val();
	$(projectName + " .project-description").text(newText);
}

$(function() {
    var $document   = $(document),
        $inputRange = $('input[type="range"]');
    
    // Example functionality to demonstrate a value feedback
    function valueOutput(element) {
        var value = element.value,
            output = element.parentNode.getElementsByTagName('output')[0];
        output.innerHTML = value;
    }
    for (var i = $inputRange.length - 1; i >= 0; i--) {
        valueOutput($inputRange[i]);
    };
    $document.on('input', 'input[type="range"]', function(e) {
        valueOutput(e.target);
    });
    // end
  
    $inputRange.rangeslider({
      polyfill: false 
    });
});

//For activities page
//JavaScript function to count down character length in form
var maxLength = 50;
$('textarea').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#chars').text(length);
});

//For timer function
/*function startTimer() {
  userInput = document.getElementById('userTime').value;
    if(userInput.length == 0){
        alert("Please enter a value");
    }

    else {
      var numericExpression = /^[0-9]+$/;

      if(!userInput.match(numericExpression)) {
      alert("Please enter a number")
      } 

      else {
        function display( notifier, str ) {
        document.getElementById(notifier).innerHTML = str;
        }
        
        function toMinuteAndSecond( x ) {
        return Math.floor(x/60) + ":" + x%60;
        }
        
        function setTimer( remain, actions ) {
         (function countdown() {
          display("countdown", toMinuteAndSecond(remain));         
          actions[remain] && actions[remain]();
          (remain -= 1) >= 0 && setTimeout(arguments.callee, 1000);
          })();
        }

        setTimer(userInput, {
        10: function () { display("notifier", "Just 10 seconds to go"); },
        5: function () { display("notifier", "5 seconds left");        },
        0: function () { display("notifier", "Time is up");       }
        }); 
      }  
    }
}*/

//Writes the added activities to activity page
function showInput(){
  var new_activity = document.getElementById("activities").value;
  document.getElementById('display').innerHTML = new_activity;
}

function validateLogin() {
  $.getJSON("./accounts.html", function(json) {
    //console.log(json[0].accounts);
      for(var i in json[0].accounts) {
        /*console.log("Username " + i + " " + json[0].accounts[i].username);
      console.log("Password " + i + " " + json[0].accounts[i].password);*/
      if((username==json[0].accounts[i].username) &&
        (password==json[0].accounts[i].password)) {
        console.log("Success!");
        window.location = "homepage.html";
        valid = true;
        return false;
      }
      else{
        console.log("Meow Burrito");
      }
          
        }

        if(valid == false) {
      alert("Login info was unMEOWlievably wrong!");
    }
  });
  var valid = false;
  var username = document.getElementById("inputUsername").value;
  var password = document.getElementById("inputPassword").value;
}

function setCookie(cname, cpassword) {
  document.cookie = "username=" + cname "; password= " + cpassword;
}

function getCookie(cname) {
  var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0)
          return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
  var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } 
}
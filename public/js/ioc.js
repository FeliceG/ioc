/* hwfp.js  */


"use strict";

// First we do a self-invoking function that contains everything - there will be nothing
//  exposed to the global scope.
(function(){

//split words into array and check the number of words entered into the field. Return the
//number of words function checkWordcount (either title, research or abstract) to display
//a message in red with the number of words entered.

function countWords(id) {

//count words based on the reg expression for all characters and eliminate extra spaces.

	var spaces = /\s* | \r+ | \n+/;
	if (id) {
		var textArray = id.split(spaces);
		var checkCounter = textArray.length;
		return checkCounter;
	}
}

//post message for title, research and abstract in html with the number of words entered.
//If number reaches maximum number, display a note to alert user, and no extra text can
//be entered in that field. But, backspace is allowed to delete text.

function postMessage(type, id, i, max, evt) {

    if (id && type && max && i) {
        if ( i <= max ) {
		    document.getElementById(id).innerHTML = "<strong>" + max + " word limit for " + type + ". Total words so far: " + i + "</strong>";
			document.getElementById(id).style.display = "block";
        } else if ( i > max && evt.which != "8" ) {
	        document.getElementById(id).innerHTML = "<strong>You have reached the maximum number of words: " + max + ". </strong>";
			evt.preventDefault();
        }
    }
}

//Depending on the event target (title, research, abstract field), check the word count and
//post the appropriate message via the postMessage function. Validate word count is under
//maximum number of words.

function checkWordcount(evt) {

   if (evt.target.id && evt.target.value) {
        var count = 0;
        if ( evt.target.id == "title" ) {
            var count = countWords(evt.target.value);
            postMessage("Title", "title_count", count, 40, evt);
        } else if ( evt.target.id == "research" ) {
            var count = countWords(evt.target.value);
            postMessage("Research Description", "research_count", count, 500, evt);
        } else if ( evt.target.id == "abstract" ) {
            var count = countWords(evt.target.value);
            postMessage("Abstract", "abstract_count", count, 200, evt);
		}
    }
}

//When createElements function is called, the id, classname, number of rows and number of
//columns is added to the new co-author element.

function createFields(name, i) {

	var addElement = document.createElement('TEXTAREA');
	var className = document.createAttribute("class");

	className.value = name;
	addElement.setAttributeNode(className);
	addElement.id = name + i;
	addElement.class = name;
	addElement.name = name + i;
	addElement.rows = "1";
	addElement.cols = "40";

	return addElement;
}

//When addAuthor function is called, new input fields are created to add new co-author
//information. The addAuthor function calls the createFields function to add text area
//information.

function createElements(i) {

	var p = document.createElement('p');
	p.innerHTML = "<br><strong>First Name:&nbsp;&nbsp;&nbsp;</strong>";
	var addFirst = createFields("first", i);
	p.appendChild(addFirst);
	p.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Last Name:&nbsp;&nbsp;&nbsp;</strong>";
	var addLast = createFields("last", i);
	p.appendChild(addLast);
	p.innerHTML += "<br><br><strong>Organization:&nbsp;&nbsp;&nbsp;</strong>";
	var addOrganization = createFields("org", i);
	p.appendChild(addOrganization);

	return p;
}

//add another co-author field if there are less than six fields.

function addAuthors(evt) {

    var addElements = document.getElementById('authors');
    var countAuths = document.getElementsByClassName('first').length;

    if (evt.target.id) {
        if (evt.target.id == "auth_button") {
          if (countAuths < 5) {
					var p = createElements(countAuths);
					addElements.appendChild( p );
			} else if (countAuths == 4) {
				  document.getElementById('countAuths').value = countAuths;
				  alert("You have reached the maximum number of co-authors for this submission.");
			    }
					document.getElementById('countAuths').value = countAuths;
      }
    }
};


//If "Paper" is selected from the "Research Presentation Format" select, display another
//selection list to determine which track to present research.

function paperTrack(evt) {

if (evt.target.id) {
		if(evt.target.value == "Paper" || evt.target.value == "Both") {
			document.getElementById("paper_track").style.display = "block";
		}
		else if (evt.target.value == "Poster") {
			document.getElementById("paper_track").style.display = "none";
		}
  }
}


function highLight(evt) {

	var active = "home";
	var target = evt.target.id;

  if (evt.target.id) {
		if( target == "guide" || target == "login" || target == "reg" || target == "r_home" || target == "r_guide" || target == "r_add" || target == "r_show" || target == "r_delete" ) {
			active = target;
		}
	}
	window.localStorage.setItem("active", JSON.stringify(active));
}


//When user refreshes browser, data from localStorage is sent to writeValueToField to add
//to input fields in form.

    function writeValueToField(items) {

			if ( items.length != 0 ) {
        var length = items.length;

				var count = document.getElementById('navHighlight').getElementsByTagName('A').length;
				for (var i=0; i<count; i++) {
					document.getElementById('navHighlight').getElementsByTagName('A')[i].removeAttribute("class");
					var target = 	document.getElementById('navHighlight').getElementsByTagName('LI')[i];
				}
				document.getElementById(items).setAttribute('class', 'active');
				target = document.getElementById(items);
				console.log("target" +target.innerHTML);
			}
	}


//on click, invoke addAuthors function to see if button id = add_authors. If so, add authors.
document.addEventListener("click", addAuthors);

//if target.id is equal to title, research, or abstract, check the input text word count.
document.addEventListener("keypress", checkWordcount);

//if "paper" is selected for Research Presentation Format, display the track selections
//to take input.
document.addEventListener("click", paperTrack);

document.addEventListener("click", highLight);


//if target.id is equal to "submit", store the data from the input fields in the data object
//and store in window.localStorage.
//document.addEventListener("click", storeObject);


window.onload = function() {

//localStorage.clear();

    var length = window.localStorage.length;  //check to see if localStorage contains items

//if there is data in localStorage, pull those items out of storage and write out the
//values to input fields by invoking writeValueToField function.

    if ( length != 0 ) {
 		var items = JSON.parse(window.localStorage.getItem("active"));
		    if ( items != null ) {
		        console.log("items 1 " + items);
		 	      writeValueToField(items);
        }
		}
};

})();

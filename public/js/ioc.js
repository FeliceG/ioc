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
            postMessage("Abstract", "abstract_count", count, 250, evt);
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
	p.innerHTML = "<strong>First Name:&nbsp;&nbsp;&nbsp;</strong>";
	var addFirst = createFields("first", i);
	p.appendChild(addFirst);
	p.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Last Name:&nbsp;&nbsp;&nbsp;</strong>";
	var addLast = createFields("last", i);
	p.appendChild(addLast);

	return p;
}

//add another co-author field if there are less than six fields.

function addAuthors(evt) {

    var addElements = document.getElementById('authors');
    var countAuths = document.getElementsByClassName('first').length;

    if (evt.target.id) {
        if (evt.target.id == "auth_button") {
          if (countAuths < 5) {
					alert('The value of countAuths 1:' + countAuths);
					var p = createElements(countAuths);
					addElements.appendChild( p );
			} else if (countAuths == 4) {
				document.getElementById('countAuths').value = countAuths;
				alert("You have reached the maximum number of co-authors for this submission.");
				alert('The value of countAuths:' + countAuths);
			}
							alert('The value of countAuths 2:' + countAuths);
        }
			document.getElementById('countAuths').value = countAuths;
    }
};


//If "Paper" is selected from the "Research Presentation Format" select, display another
//selection list to determine which track to present research.

function paperTrack(evt) {

//    var checkSelect = document.getElementById("paper_poster");
//    console.log("checkSelect: " + checkSelect.value);

//console.log(evt.target.id);

if (evt.target.id) {
		if(evt.target.id == "paper" || evt.target.id == "both_research") {
			document.getElementById("paper_track").style.display = "block";
		}
		else if (evt.target.id == "poster") {
			document.getElementById("paper_track").style.display = "none";
		}
  }
}

//When "Submit" is clicked, gather all the input field information and store in object to
//store in window.localStorage to retrieve and add to HTML form when user returns to browser.

    function storeObject(evt) {

    if ( evt.target.id == "submit" ) {

// traverse authors to see how many author fields have been created--up to 4 fields possible.
		var authors_first = document.getElementsByClassName("first");
		var authors_last = document.getElementsByClassName("last");
		var firsts = [];
		var lasts = [];

	    //check the number of co-authors entered and iterate through the list to add first and
	    //last names to the arrays firsts and lasts

	    if ( authors_first.length > 0 ) {
				for (var i=0; i < authors_first.length; i++) {
				    if ( authors_first[i].value != "null" && authors_last[i].value != "null" ) {
						firsts[i] = authors_first[i].value;
						lasts[i] = authors_last[i].value;
					}
				}
		 }

		//check title field to see if text entered. If yes, add to variable title.
		var title = "";
		if (document.getElementById("title").value != "null") {
            title = document.getElementById("title").value;
        }

		//check paper_poster field to see if text entered. If yes, add to variable paper_poster.
		//If "Paper" is selected, check to if a track was selected. If yes, add to variable track.
        var paper_poster = "";
		if (document.getElementById("paper_poster").value != "null") {
            paper_poster = document.getElementById("paper_poster").value;
            if (paper_poster == "Paper") {
                var track = "";
		        if (document.getElementById("track").value != "null") {
                    track = document.getElementById("track").value;
                }
            }
        }

        //check to see if text for research was added. If yes, add to variable research.
        var research = "";
        if (document.getElementById("research").value != "null") {
            research = document.getElementById("research").value;
        }

 		//check to see if abstract information was added. If yes, add to variable summary.
        var summary = "";
        if (document.getElementById("abstract").value != "null") {
            var summary = document.getElementById("abstract").value;
        }

				//check to see if abstract information was added. If yes, add to variable summary.
				var countAuths = document.getElementsByClassName("first").length;
//				document.getElementById("countAuths") = countAuths;
					 if (authCounts == null) {
							 var countAuths = 0;
					 }

        // Create data structure to store data in localStorage

        var researchData = {};
        researchData.firsts = firsts;
        researchData.lasts =  lasts;
				researchData.countAuths = countAuths;
        researchData.title = title;
        researchData.paper_poster = paper_poster;
        researchData.track = track;
        researchData.research = research;
        researchData.summary = summary;

        window.localStorage.setItem("researchData", JSON.stringify(researchData));
   }
}

//When user refreshes browser, data from localStorage is sent to writeValueToField to add
//to input fields in form.

    function writeValueToField(items) {

        var length = items.length;
        var addElements = document.getElementById('authors');

        //iterate through co-author information and create fields if more than one co-author
        //and add first and last name to each new author field. Check all other fields for
        //data. If not null, add information to the input field for title, paper_poster,
        //track for paper if paper selected, research, and abstract.

        for ( var element in items ) {
            if ( element == 'firsts' && items.firsts != "null") {
                var count = items.firsts.length;
                for (var c=0; c < count; c++) {
                   if ( c == 0 && items.firsts[0] != "null" && items.lasts[0] != "null" ) {
						document.getElementById('first0').value = items.firsts[c];
						document.getElementById('last0').value = items.lasts[c];
                   } else if ( c > 0 && c < count && items.firsts[c] != "null" && items.lasts[c] != "null") {
						var p = createElements(c);
						addElements.appendChild( p );
						document.getElementById('first'+c).value = items.firsts[c];
						document.getElementById('last'+c).value = items.lasts[c];
				   }
				}
			} else if ( element == 'title' && items.title != "null" ) {
                document.getElementById('title').value = items.title;
            } else if (element == 'paper_poster' && items.paper_poster != "null") {
                document.getElementById('paper_poster').value = items.paper_poster;
            } else if (element == 'track' && items.track != "null" ) {
                document.getElementById('track').value = items.track;
                document.getElementById("paper_track").style.display = "block";
            } else if ( element == 'research' && items.research != "null" ) {
                document.getElementById('research').value  = items.research;
            } else if ( element == 'summary' && items.summary != "null" ) {
                document.getElementById('abstract').value  = items.summary;
            }
       }
}

//on click, invoke addAuthors function to see if button id = add_authors. If so, add authors.
document.addEventListener("click", addAuthors);

//if target.id is equal to title, research, or abstract, check the input text word count.
document.addEventListener("keypress", checkWordcount);

//if "paper" is selected for Research Presentation Format, display the track selections
//to take input.
document.addEventListener("click", paperTrack);

//if target.id is equal to "submit", store the data from the input fields in the data object
//and store in window.localStorage.
//document.addEventListener("click", storeObject);



window.onload = function() {

    var length = window.localStorage.length;  //check to see if localStorage contains items
//		Storage.clear();

//if there is data in localStorage, pull those items out of storage and write out the
//values to input fields by invoking writeValueToField function.

    if ( length != 0 ) {
 		var items = JSON.parse(window.localStorage.getItem("researchData"));
// 	    writeValueToField(items);
     }
};

})();

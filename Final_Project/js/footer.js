
//Code to control the footer information and formatting

window.onload = function date() {
    //Creates new date item
    var x = new Date(); 
    //Stores the year
    var y = x.getFullYear();
    //Stores the date
    var da = x.getDate();
    //Adds proper suffix to the date
    if (da==1){
        da=da+"st";
    }
    else if (da==2){
        da=da+"nd";
    }
    else if (da==3){
        da=da+"rd";
    }
    else {
        da=da+"th";
    }

    //Array of month names
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"] 
    //Stores month name using the index number that is returned 
    var m = monthNames[x.getMonth()]; 
    
    //Creates the new paragraph elements
    var new_p = document.createElement('p');
    var foot1p = document.createElement('p');
    var foot2p = document.createElement('p');
    var foot3p = document.createElement('p');
    //Creates a new text element for that paragraph
    var new_text = document.createTextNode(m + " " + da + ", " + y);
    //Creates the static text element
    var foot1 = document.createTextNode("CS2300 Final Project, ©2017");
    var foot2 = document.createTextNode("Last Updated: May 17th, 2017");
    var foot3 = document.createTextNode("Created by SNOW Sports");
    //Isolates the footer element
    var location = document.getElementsByTagName('footer')[0];
    //Appends items to footer
    new_p.appendChild(new_text);
    foot1p.appendChild(foot1);
    foot2p.appendChild(foot2);
    foot3p.appendChild(foot3);
    location.appendChild(foot1p);
    location.appendChild(new_p);
    location.appendChild(foot2p);
    location.appendChild(foot3p);


                
}
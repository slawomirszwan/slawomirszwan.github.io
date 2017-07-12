function abbr() 
{
var  ramkaabbr

ramkaabbr=document.createElement("iframe")
dane=document.createElement("div")
ramkaabbr.src="http://plotkarka.eu/b/abbr.html"
ramkaabbr.style.cssText='display: none;'
dane.style.cssText='display: none;'
document.body.appendChild(ramkaabbr)
document.body.appendChild(dane)

	var onmessage = function(e) {
	dane.innerHTML=e.data

	}
	if (typeof window.addEventListener != 'undefined') {
      	window.addEventListener('message', onmessage, false);
  	} else if (typeof window.attachEvent != 'undefined') {
     	window.attachEvent('onmessage', onmessage);
   	}

var dt=dane.getElementsByTagName("dt")
var dd=dane.getElementsByTagName("dd")
var abbr=document.getElementsByTagName("abbr")

for (var i=0; i<abbr.length; i++ ) 
{
	abbr[i].onmouseover=function() {

		for (var j=0; j<dt.length; j++ ) 
		{
			for (var i=0; i<abbr.length; i++ ) 
			{
			if(dt[j].firstChild.nodeValue==abbr[i].innerHTML)
			{
			abbr[i].title=abbr[i].innerHTML+" - "+dd[j].getAttribute("lang")+". "+dd[j].firstChild.nodeValue
			}
		}
	}
}


}
}
abbr()
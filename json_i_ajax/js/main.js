var myCat = {
  "name": "DużoMiałczek",
  "species": "kot",
  "favFood": "tuńczyk"
};

console.log(myCat.name, myCat.favFood);

var myFavColors = [
  "white","blue","red"
];

console.log(myFavColors[0]);

//object, array

var thePets = [
  {
  "name": "DużoMiałczek",
  "species": "kot",
  "favFood": "tuńczyk"
  },
  {
  "name": "Milus",
  "species": "kot",
  "favFood": "tuńczyk"
  }
];

console.log(thePets[0].favFood);

//Java Script Object Notation

//ajax
//XMLHttpRequest
//=========================================
var ourRequest = new XMLHttpRequest();

ourRequest.open(
  'GET', //method
  'https://learnwebcode.github.io/json-example/animals-1.json' //url
);

//'https://raw.githubusercontent.com/LearnWebCode/json-example/master/animals-1.json'      

onloadFun1 = function() {
      console.log(ourRequest.responseText);
};

onloadFun2 = function() {
    
      var ourDataText = ourRequest.responseText;
      console.log(ourDataText);
      
      var ourData = JSON.parce(ourDataText);
      console.log(ourData[0]);
      
      
       
};

//ourRequest.onload = onloadFun1;
ourRequest.onload = onloadFun2;

ourRequest.send();


//ajax
//asynchronous javascript and xml

var btn = document.getElementById('btn');
var animalContainer = document.getElementById('animal-info');

btn.addEventListener('click', funbtn);

funbtn = function() {
    var ourRequest = new XMLHttpRequest();  
    ourRequest.open(
      'GET', //method
      'https://learnwebcode.github.io/json-example/animals-1.json' //url
    );
    ourRequest.onload = onloadFun3;
    ourRequest.send();
}
  
onloadFun3 = function(){
      var ourDataText = ourRequest.responseText;
      console.log(ourDataText);
      
      var ourData = JSON.parce(ourDataText);
      console.log(ourData[0]);
 
      renderHTML(ourData); 
};



function renderHTML(data) {
   //animalContainer.insertAdjacentHTML('beforeend','testing123');
                                                 
   //var htmlString = "this is a test";
   //animalContainer.insertAdjacentHTML('beforeend',htmlString);

   var htmlString = "";
   for (var i=0; i<data.length; i++) {
      htmlString += "<p>"+data[i].name +"is a " + data[i].species + "</p>";
   }
   animalContainer.insertAdjacentHTML('beforeend',htmlString);

   
}
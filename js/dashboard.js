//variable declaration
var cards = document.querySelectorAll(".card");
var cardContainer = document.querySelector(".cardContainer");
var cardOptions = document.querySelector(".cardOptions");
var courseTitle = document.querySelector(".course-title");


//function calling
for(i=0; i<cards.length; i++){
    cards[i].addEventListener("click", toggleNavActive);
  }
  
//function definition
function toggleNavActive(){
    //for nav active

     // Get the inner text of the cardTitle span inside this card
     const cardTitle = this.querySelector('.cardTitle').innerText;
     // Output the card title to console (you can do whatever you want with it)
    courseTitle.innerHTML = cardTitle;
    
    cardContainer.classList.add("hidden");
    cardOptions.classList.remove("hidden");
  
  }
  var one = document.querySelector(".one");
  var two = document.querySelector(".two");
  var three = document.querySelector(".three");
  var four = document.querySelector(".four");
  one.addEventListener("click", showOne);
  two.addEventListener("click", showTwo);
  three.addEventListener("click", showThree);
  four.addEventListener("click", showFour);
  var studentDetails = document.getElementById("studentDetails");
  var courseDetails = document.getElementById("courseDetails");
  var editCos = document.getElementById("editCos");
  var questionPaper = document.getElementById("questionPaper");
  function showOne(){
    one.classList.add("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    four.classList.remove("isActive");
    courseDetails.classList.remove("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.add("hidden");
  }
  function showTwo(){
    one.classList.remove("isActive");
    two.classList.add("isActive");
    three.classList.remove("isActive");
    four.classList.remove("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.remove("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.add("hidden");
  }
  function showThree(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.add("isActive");
    four.classList.remove("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.remove("hidden");
    studentDetails.classList.add("hidden");
  }
  function showFour(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    four.classList.add("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.remove("hidden");
  }

  function logout(){
    window.location.href = "index.html";
}
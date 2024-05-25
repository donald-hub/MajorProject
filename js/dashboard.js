//variable declaration
var cards = document.querySelectorAll(".card");
var cardContainer = document.querySelector(".cardContainer");
var cardOptions = document.querySelector(".cardOptions");
var courseTitle = document.querySelector(".course-title");
var courseId = document.getElementsByClassName(".courseTitle");

function goBack(){
  if(cardContainer.classList.contains("hidden")){
    cardContainer.classList.remove("hidden");
    cardOptions.classList.add("hidden");
  }
}

function showHint(str) {
  if (str.length == 0) {
      return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint").innerHTML = this.responseText;
          }
      };
      xmlhttp.open("GET", "resources/getCOs.php?q=" + str, true);
      xmlhttp.send();
  }
}

//function calling
for(i=0; i<cards.length; i++){
    cards[i].addEventListener("click", toggleNavActive);
    
    //ajax part 
    cards[i].addEventListener("click", function() {
      var courseId = document.getElementsByClassName(".courseTitle").innerHTML;
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "resources/ajaxFacultyEditCos.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('responseCos').innerHTML = xhr.responseText;
        }
      };
      xhr.send("course_id1=" + courseId);
      showHint(courseId);

    });
    //end of ajax part


    cards[i].addEventListener("click", function() {
      var courseId = document.getElementsByClassName(".courseTitle").innerHTML;
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "resources/ajaxFacultyStdDetails.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('responseStdDetails').innerHTML = xhr.responseText;
        }
      };
      xhr.send("course_id2=" + courseId);
    });
    //end of ajax part



     //ajax part 
     cards[i].addEventListener("click", function() {
      var courseId = document.getElementsByClassName(".courseTitle").innerHTML;
  
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "resources/ajaxFacultyCourseCode.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('responseCode').innerHTML = xhr.responseText;
        }
      };
      xhr.send("course_id3=" + courseId);
    });
    //end of ajax part
  }

//function definition
function toggleNavActive(){
    //for nav active

     // Get the inner text of the cardTitle span inside this card
     const cardTitle = this.querySelector('.cardTitle').innerText;
     // Output the card title to console (you can do whatever you want with it)
    courseTitle.innerHTML = cardTitle;
    courseId.innerHTML = cardTitle;
    
    cardContainer.classList.add("hidden");
    cardOptions.classList.remove("hidden");
  
  }
  var one = document.querySelector(".one");
  var two = document.querySelector(".two");
  var three = document.querySelector(".three");
  var four = document.querySelector(".four");
  var five = document.querySelector(".five");
  one.addEventListener("click", showOne);
  two.addEventListener("click", showTwo);
  three.addEventListener("click", showThree);
  four.addEventListener("click", showFour);
  five.addEventListener("click", showFive);
  var studentDetails = document.getElementById("studentDetails");
  var courseDetails = document.getElementById("courseDetails");
  var editCos = document.getElementById("editCos");
  var questionPaper = document.getElementById("questionPaper");
  var answers = document.getElementById("answers");
  function showOne(){
    one.classList.add("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    four.classList.remove("isActive");
    five.classList.remove("isActive");
    courseDetails.classList.remove("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.add("hidden");
    answers.classList.add("hidden");
  }
  function showTwo(){
    one.classList.remove("isActive");
    two.classList.add("isActive");
    three.classList.remove("isActive");
    four.classList.remove("isActive");
    five.classList.remove("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.remove("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.add("hidden");
    answers.classList.add("hidden");
  }
  function showThree(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.add("isActive");
    four.classList.remove("isActive");
    five.classList.remove("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.remove("hidden");
    studentDetails.classList.add("hidden");
    answers.classList.add("hidden");
  }
  function showFour(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    four.classList.add("isActive");
    five.classList.remove("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.remove("hidden");
    answers.classList.add("hidden");
  }
  function showFive(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    four.classList.remove("isActive");
    five.classList.add("isActive");
    courseDetails.classList.add("hidden");
    editCos.classList.add("hidden");
    questionPaper.classList.add("hidden");
    studentDetails.classList.add("hidden");
    answers.classList.remove("hidden");
  }


function download(){
  print();
}


function edit(row){
  console.log(row);
  var editOption = document.getElementById("editOption");
  editOption.classList.remove("hidden");
}


var firstTerm = document.getElementById("first_term");
var midTerm = document.getElementById("mid_term");
var secondTerm = document.getElementById("second_term");
var endTerm = document.getElementById("end_term");


firstTerm.addEventListener('click', () => {

    var courseId = document.getElementsByClassName(".courseTitle").innerHTML;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "resources/ajaxFacultyInsertFirst.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('responseInsertMarks').innerHTML = xhr.responseText;
      }
    };
    xhr.send("course_id=" + courseId);
});

midTerm.addEventListener('click', () => {
  alert("mid");
});

secondTerm.addEventListener('click', () => {
  alert("2");
});

endTerm.addEventListener('click', () => {
  alert("end");
});
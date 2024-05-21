var createTable = document.getElementById("createTable");
var populateData = document.getElementById("populateData");
var generateReport = document.getElementById("generateReport");
var createTableSection = document.getElementById("createTableSection");
var populateDataSection = document.getElementById("populateDataSection");
var generateReportSection = document.getElementById("generateReportSection");
var next = document.getElementById("next");
var section1 = document.getElementById("section1");
var tableName = document.getElementById("tname");
var columns = document.getElementById("columns");
var section2 = document.getElementById("section2");
var one = document.querySelector(".one");
var two = document.querySelector(".two");
var three = document.querySelector(".three");

createTable.addEventListener('click', showCreateTableSection);
populateData.addEventListener('click', showPopulateDataSection);
generateReport.addEventListener('click', showGenerateReportSection);
next.addEventListener('click', nextForm);

function showCreateTableSection(){
    one.classList.add("isActive");
    two.classList.remove("isActive");
    three.classList.remove("isActive");
    createTableSection.classList.remove("hidden");
    populateDataSection.classList.add("hidden");
    generateReportSection.classList.add("hidden");
}
function showPopulateDataSection(){
    one.classList.remove("isActive");
    two.classList.add("isActive");
    three.classList.remove("isActive");
    createTableSection.classList.add("hidden");
    populateDataSection.classList.remove("hidden");
    generateReportSection.classList.add("hidden");
}
function showGenerateReportSection(){
    one.classList.remove("isActive");
    two.classList.remove("isActive");
    three.classList.add("isActive");
    createTableSection.classList.add("hidden");
    populateDataSection.classList.add("hidden");
    generateReportSection.classList.remove("hidden");
}
function nextForm(){
    if(columns.value != "" && tableName.value != ""){
        var decrement = columns.value;
        addColumn(decrement);
        section1.classList.add("hidden");
        section2.classList.remove("hidden");
    }
    
}



//for selection form section using buttons in populate data section
var answers = document.getElementById("answers");
var courses = document.getElementById("courses");
var courseOb = document.getElementById("courseOb");
var department = document.getElementById("department");
var faculty = document.getElementById("faculty");
var exam = document.getElementById("exam");
var programme = document.getElementById("programme");
var programmeOb = document.getElementById("programmeOb");
var questions = document.getElementById("questions");
var students = document.getElementById("students");



answers.addEventListener("click", showAnswers);
courses.addEventListener("click", showCourses);
courseOb.addEventListener("click", showCourseOb);
department.addEventListener("click", showDepartment);
faculty.addEventListener("click", showFaculty);
exam.addEventListener("click", showExam);
programme.addEventListener("click", showProgramme);
programmeOb.addEventListener("click", showProgrammeOb);
questions.addEventListener("click", showQuestions);
students.addEventListener("click", showStudents);

var section = document.querySelectorAll(".section");
var answers = document.querySelector(".answers");
var courses = document.querySelector(".courses");
var courseOb = document.querySelector(".courseOb");
var department = document.querySelector(".department");
var faculty = document.querySelector(".faculty");
var exam = document.querySelector(".exam");
var programme = document.querySelector(".programme");
var programmeOb = document.querySelector(".programmeOb");
var questions = document.querySelector(".questions");
var students = document.querySelector(".students");

// function removeClassFromElements() { 
//     var elements = document.querySelectorAll("section"); 
//     for (let i = 0; i < elements.length; i++) {
//         elements[i].classList.add('hidden');
//     }
// } 

function showAnswers(){
    answers.classList.remove("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showCourses(){
    answers.classList.add("hidden");
    courses.classList.remove("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showCourseOb(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.remove("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showDepartment(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.remove("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showExam(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.remove("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showFaculty(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.remove("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}


function showProgramme(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.remove("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showProgrammeOb(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.remove("hidden");
    questions.classList.add("hidden");
    students.classList.add("hidden");
}
function showQuestions(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.remove("hidden");
    students.classList.add("hidden");}

function showStudents(){
    answers.classList.add("hidden");
    courses.classList.add("hidden");
    courseOb.classList.add("hidden");
    department.classList.add("hidden");
    exam.classList.add("hidden");
    faculty.classList.add("hidden");
    programme.classList.add("hidden");
    programmeOb.classList.add("hidden");
    questions.classList.add("hidden");
    students.classList.remove("hidden");
}


function logout(){
    window.location.href = "index.html";
}


function addColumn(decrement){
    
    var html = '<div class="form-group row">' + 
    '<div class="col-md-2">' +
        '<input class="form-control" type="text" name="column_name[]" placeholder="Column Name" >' +
    '</div>' +
    '<div class="col-md-2">' +
        '<input class="form-control" type="text" name="data_type[]" placeholder="datetype">' +
    '</div>' +
    '<div class="col-md-2">' +
        '<label for="isPrimary">Primary?</label>' +
        '<input type="radio" name="primary[]" id="yes">Yes</input>' +
        '<input type="radio" name="primary[]" id="no">No</input>' +
    '</div>' +
    '<div class="col-md-3">' +
        '<label for="isNull">Null/Not Null</label>' +
        '<input type="radio" name="null[]" id="yes" value="yes">Yes</input>' +
        '<input type="radio" name="null[]" id="no" value="no">No</input>' +
    '</div>' +
        '<div class="col-md-2">' +
            '<input class="form-control" type="number" name="size[]" placeholder="Size(in bytes)">' +
        '</div>' +
    '</div>';
    
    section2.innerHTML = '<legend class="title">Create</legend>' ;
    while(decrement > 0){
        section2.innerHTML += html;
        decrement--;
    }
    section2.innerHTML += '<input class="btn btn-success btn-block" type="submit" value="Create Table">';
    

}
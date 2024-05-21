var questionHtml = document.getElementById("question");
var addQuestion = document.getElementById("addQuestion");
var addSubQuestion = document.getElementById("addSubQuestion");
var increment = 1;
var array = ['a', 'b', 'c', 'd', 'e', 'f', 'g','h', 'i'];
var subincrement = 0;

addQuestion.addEventListener('click', addQuestionFunction);
addSubQuestion.addEventListener('click', addSubQuestionFunction);

function addQuestionFunction(){
    increment++;
    var string ='<div id="question">' +
                    '<div class="form-group">' +
                        '<div class="col-md-8">' +
                            '<label for="questions">' + increment + ' </label>' +
                            '<textarea class="form-control" name="questions" id="questions" rows="5" cols="70" required></textarea>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<label for="mark">Mark</label>' +
                            '<input class="form-control" type="number" id="mark" name="mark" min="1" max="20" value ="1">' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<input class="form-control" type="file" src="" alt="">' +
                        '</div>' +
                    '</div>' +
                '</div>';
    questionHtml.innerHTML += string;
};

function addSubQuestionFunction(){
    var string ='<div class="form-group">' +
                '<div class="col-md-8">' +
                '<label for="subquestions">(' + array[subincrement] + ') </label>' +
                    '<textarea class="form-control" name="subquestions" id="subquestions" rows="5" cols="70" required></textarea>' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<label for="mark">Mark</label>' +
                    '<input class="form-control" type="number" id="mark" name="mark" min="1" max="20" value ="1">' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<input class="form-control" type="file" src="" alt="">' +
                '</div>' +
            '</div>' ;
    subincrement++;
    questionHtml.innerHTML += string;
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

function test(str){
    alert(str);
}



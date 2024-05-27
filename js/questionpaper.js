var questionHtml = document.getElementById("question");
var addQuestion = document.getElementById("addQuestion");
var addSubQuestion = document.getElementById("addSubQuestion");
var increment = 1;
var array = ['a', 'b', 'c', 'd', 'e', 'f', 'g','h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
var subincrement = 0;

addQuestion.addEventListener('click', addQuestionFunction);
addSubQuestion.addEventListener('click', addSubQuestionFunction);

function addQuestionFunction(){
    var fullMarks = document.getElementById("full_marks");
    var total = totalMarks();
    if(total>=fullMarks.value){
        alert("Exceeded Full Marks limit");
        }else {
        var totalQuestions = document.getElementById("totalQuestions");
        totalQuestions.value++;
        increment++;
        subincrement = 0;
    
        var string = 
        '<div class="form-group">' +
            '<div>' +
                '<label class="col-md-2 control-label" for="q'+ increment + '">' + increment + '. </label>' +
                '<div class="col-md-10">' +
                    '<textarea class="form-control" name="q'+ increment + '" id="q'+increment+'" rows="5" cols="70" required>q'+ increment + '</textarea>' +
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="form-group">'+
            '<div class="col-md-2"></div>'+
            '<div class="col-md-5">'+
                '<label class="col-md-6 control-label"  style="transform: translate(0%, -25%);" for="exampleFormControlFile1">Upload Image:</label>'+
                '<div class="col-md-6">'+
                    '<input type="file" class="form-control-file" id="exampleFormControlFile1">'+
                '</div>'+
            '</div>'+
            '<div class="col-md-5" >'+
                '<label class="col-md-6 control-label" style="transform: translate(0%, -20%);" for="mark">Mark:</label>'+
                '<div class="col-md-6">'+
                    '<input type="number" id="m'+increment+'" name="m'+increment+'" min="1" max="20" value ="1"></input>'+
                '</div>'+
            '</div>'+
    '</div>' +
    '<input type="hidden" name="totalSubQuestions'+increment+'" id="totalSubQuestions'+increment+'" value="0"></input>';
                    questionHtml.insertAdjacentHTML('beforeend', string);
    }
   
      };

function addSubQuestionFunction(){
    var fullMarks = document.getElementById("full_marks");
var total = totalMarks();
if(total>=fullMarks.value){
    alert("Exceeded Full Marks limit");
    }else {
        var totalSubQuestions = document.getElementById("totalSubQuestions"+increment);
        totalSubQuestions.value++;
    var string =
    '<div class="form-group">' +
        '<div>' +
            '<label class="col-md-2 control-label" for="q'+increment+array[subincrement]+'">(' + array[subincrement] + ')</label>' +
            '<div class="col-md-10">' +
                '<textarea class="form-control" name="q'+increment+array[subincrement]+'" id="q'+increment+array[subincrement]+'" rows="5" cols="70" required>q'+increment+array[subincrement]+'</textarea>' +
            '</div>'+
        '</div>'+
    '</div>'+
    '<div class="form-group">'+
        '<div class="col-md-2"></div>'+
        '<div class="col-md-5">'+
            '<label class="col-md-6 control-label"  style="transform: translate(0%, -25%);" for="exampleFormControlFile1">Upload Image:</label>'+
            '<div class="col-md-6">'+
                '<input type="file" class="form-control-file" id="exampleFormControlFile1">'+
            '</div>'+
        '</div>'+
        '<div class="col-md-5" >'+
            '<label class="col-md-6 control-label" style="transform: translate(0%, -20%);" for="mark">Mark:</label>'+
            '<div class="col-md-6">'+
                '<input type="number" id="m'+increment+array[subincrement]+'" name="m'+increment+array[subincrement]+'" min="1" max="20" value ="1"></input>'+
            '</div>'+
        '</div>'+
        '</div>';
        subincrement++;
        questionHtml.insertAdjacentHTML('beforeend', string);
    }
        };
    
            
    function totalMarks(){
    var total = 0;
    var totalQuestions = document.getElementById("totalQuestions");
    for(var i = 1; i <= totalQuestions.value; i++){
        var marks = document.getElementById("m"+i);
        total += parseInt(marks.value);

        var totalSubQuestions = document.getElementById("totalSubQuestions"+i);
        for(var j = 0; j < totalSubQuestions.value; j++){
            var subMarks = document.getElementById("m"+i+array[j]);
            total += parseInt(subMarks.value);
        };
    }
    
    return total;
}


var createButton = document.getElementById("create");
createButton.addEventListener('click', function(event){
    total = totalMarks();
    alert(total)
    var fullMarks = document.getElementById("full_marks");

    if(total != fullMarks.value){
        event.preventDefault();
        alert("Total Marks doesnot match Full marks");
    }
})
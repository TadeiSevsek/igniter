let menu = document.querySelector('.menu-icon');
let navbar = document.querySelector('.menu');
menu.onclick = () => {
    menu.classList.toggle('move');
    navbar.classList.toggle('activate'); //spremeni menu iz navadnih 3 črtic na x
} 
  function updateList(){

var input = document.getElementById('file-upload'); //to je relevantno pri addgames
var output = document.getElementById('filename');
  output.innerHTML='<span>';
  output.innerHTML+= input.files.item(0).name;
  output.innerHTML+='</span>';
}
function updateList2(){

  var input = document.getElementById('file-upload2'); //to je relevantno pri addgames
  var output = document.getElementById('filename2');
    output.innerHTML='<span>';
    output.innerHTML+= input.files.item(0).name;
    output.innerHTML+='</span>';
    console.log(input.files.item(0).name);
  }
function updateList1(){ //to je relevantno pri addgames

var input = document.getElementById('file-upload1');
var output = document.getElementById('filename1');
output.innerHTML='<span>';

    for(var i = 0;i<input.files.length;++i){

      output.innerHTML+= input.files.item(i).name+", ";
      }
    output.innerHTML+='</span';

}

